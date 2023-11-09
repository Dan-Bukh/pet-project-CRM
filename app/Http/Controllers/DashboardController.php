<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sort' => ['string', 'max:10'],
        ]);

        $sorts = [
            'primary' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '>',
                //2023-09-25 19:26:56
            ],
            'warning' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '=',
                //2023-09-24 19:26:56
            ],
            'success' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '<',
                //2023-09-23 00:00:00
            ],
        ];

        if($request->has('sort')) {
            $sort = $validated['sort'];
            if(!Arr::exists($sorts, $sort)) {
                return abort(404);
            }
        } else {
            $sort = null;
        }

        $user = auth('web')->user();
        $customers = Customer::query()
        ->where('supplier_id', $user['id'])
        ->when($sort, function (Builder $query, $sort) use ($sorts) {
            $query->whereDate('time', $sorts[$sort][1], $sorts[$sort][0]);
        })
        ->oldest('time')
        ->paginate(9)
        ->appends(['sort' => $sort]);

        foreach($customers as $customer) {
            $customer['time'] = new Carbon($customer['time']);
        }
        $time_now = Carbon::now();

        return view('dashboard.index', compact('user', 'customers', 'time_now'));
    }

    public function edit($id) 
    {
        $customer = Customer::query()->where('id', $id)->get();

        return view('dashboard.edit', compact('customer'));
    }
    public function update(Request $request, $id) 
    {
        $validated = $request->validate([
            'customer_name' => ['required' ,'string', 'max:50'],
            'email' => ['required' ,'string', 'email', 'max:50'],
            'number' => ['required' ,'string', 'max:15'],
            'comment' => ['required' ,'string', 'max:100'],
            'time' => ['required' ,'string', 'date_format:"Y-m-d H:i:s"', 'max:50'],
        ]);
        if(validate_fio($validated['customer_name'])) {
            //return redirect(route('dashboard.edit', $id))->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
            return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']);
        };
        
        Customer::query()->where('id', $id)->update([
            'customer_name' => $validated['customer_name'],
            'email' => $validated['email'],
            'number' => $validated['number'],
            'comment' => $validated['comment'],
            'time' => $validated['time'],
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($id) 
    {
        Customer::query()->where('id', $id)->delete();
        return redirect()->route('dashboard');
    }
}
