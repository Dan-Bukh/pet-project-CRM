<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\DashboardCustomerService;

class DashboardController extends Controller
{
    public function index(IndexCustomerRequest $request, DashboardCustomerService $service)
    {
        $compact = $service->index($request);
        return view('dashboard.index', $compact);
    }

    public function edit($id) 
    {
        $customer = Customer::query()->where('id', $id)->get();
        return view('dashboard.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, $id, DashboardCustomerService $service) 
    {
        if(validate_fio($request['customer_name'])) { return back()->withErrors(['FIO' => 'В графе должно быть заполнено Ф.И.О']); };
        $service->update($request, $id);
        return redirect()->route('dashboard');
    }

    public function destroy($id) 
    {
        Customer::query()->where('id', $id)->delete();
        return redirect()->route('dashboard');
    }
}
