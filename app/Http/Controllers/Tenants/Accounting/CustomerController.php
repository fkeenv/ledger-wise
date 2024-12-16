<?php

namespace App\Http\Controllers\Tenants\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Accounting\Customer;
use App\Http\Requests\Tenants\Accounting\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::paginate(self::DEFAULT_PAGINATION);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        return Customer::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        return tap($customer)->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        return tap($customer)->delete();
    }
}
