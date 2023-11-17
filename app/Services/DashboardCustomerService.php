<?php

namespace App\Services;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class DashboardCustomerService 
{ 
    public function index($request)
    {
        $sorts = [
            'primary' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '>',
                //2000-00-25 00:00:00
            ],
            'warning' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '=',
                //2000-00-24 00:00:00
            ],
            'success' => [
                0 => Carbon::now()->format('Y.m.d'),
                1 => '<',
                //2000-00-23 00:00:00
            ],
        ];

        if($request->has('sort')) {
            $sort = $request['sort'];
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
        return compact('user', 'customers', 'time_now');
    }

    public function update($request, $id) : void
    {
        Customer::query()->where('id', $id)->update([
            'customer_name' => $request['customer_name'],
            'email' => $request['email'],
            'number' => $request['number'],
            'comment' => $request['comment'],
            'time' => $request['time'],
        ]);
    }
}