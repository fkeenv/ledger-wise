<?php

namespace App\Http\Controllers\Tenants\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeSetting;
use App\Repositories\HRIS\EmployeeSettingRepository;
use App\Http\Requests\Tenants\HRIS\EmployeeSettingRequest;

class EmployeeSettingController extends Controller
{
    public function __construct(
        private EmployeeSettingRepository $employeeSettingRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->employeeSettingRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeSettingRequest $request, Employee $employee)
    {
        return $this->employeeSettingRepository->create($request, $employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, EmployeeSetting $employeeSetting)
    {
        return $this->employeeSettingRepository->show($employeeSetting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeSettingRequest $request, Employee $employee, EmployeeSetting $employeeSetting)
    {
        return $this->employeeSettingRepository->update($request, $employeeSetting);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, EmployeeSetting $employeeSetting)
    {
        return $this->employeeSettingRepository->delete($employeeSetting);
    }
}
