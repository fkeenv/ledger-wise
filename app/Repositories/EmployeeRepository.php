<?php

namespace App\Repositories;

use App\Models\Tenants\HRIS\Employee;

class EmployeeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Employee $employee
    ) {
    }

    public function get()
    {
        return $this->employee->get();
    }

    public function create(array $data)
    {
        return $this->employee->create($data);
    }

    public function show(Employee $employee)
    {
        return $employee;
    }

    public function update(Employee $employee, array $data)
    {
        return tap($employee)->update($data);
    }

    public function delete(Employee $employee)
    {
        return $employee->delete();
    }
}
