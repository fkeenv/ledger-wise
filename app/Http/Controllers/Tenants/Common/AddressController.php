<?php

namespace App\Http\Controllers\Tenants\Common;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Common\Address;
use App\Http\Requests\Tenants\Common\AddressRequest;

class AddressController extends Controller
{
    protected $model;
    protected $map = [
        'users' => 'App\Models\Tenants\User',
        'employees' => 'App\Models\Tenants\HRIS\Employee',
        'customers' => 'App\Models\Tenants\Accounting\Customer',
    ];

    public function __construct()
    {
        $this->model = $this->map[request()->route()->parameter('model')];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new $this->model())->find(request()->route()->parameter('id'))->addresses;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        return (new $this->model())->findOrFail(request()->route()->parameter('id'))->addresses()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $model, int $id, Address $address)
    {
        return $address;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $model, int $id, Address $address)
    {
        return tap($address)->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $model, int $id, Address $address)
    {
        return tap($address)->delete();
    }
}
