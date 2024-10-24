<?php

namespace App\Repositories\HRIS;

use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeSetting;
use App\Http\Requests\Tenants\HRIS\EmployeeSettingRequest;

class EmployeeSettingRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private EmployeeSetting $employeeSetting
    ) {
    }

    public function get()
    {
        return $this->employeeSetting->get();
    }

    public function create(EmployeeSettingRequest $request, Employee $employee)
    {
        $data = $request->validated();

        return $employee->setting()->create($data);
    }

    public function show(EmployeeSetting $employeeSetting)
    {
        return $employeeSetting;
    }

    public function update(EmployeeSettingRequest $request, EmployeeSetting $employeeSetting)
    {
        $data = $request->validated();

        return tap($employeeSetting)->update($data);
    }

    public function delete(EmployeeSetting $employeeSetting)
    {
        return tap($employeeSetting)->delete();
    }
}
