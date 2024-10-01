<?php

namespace App\Http\Controllers\Tenants\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Repositories\EmployeeRepository;
use App\Http\Requests\Tenants\HRIS\EmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->employeeRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        return $this->employeeRepository->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return $this->employeeRepository->show($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        return $this->employeeRepository->update($employee, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        return tap($employee)->delete();
    }
}
