<?php

namespace App\Repositories;

use App\Models\Tenants\HRIS\Department;

class DepartmentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Department $department
    ) {
        //
    }

    public function get()
    {
        return $this->department->get();
    }

    public function create(array $data)
    {
        return $this->department->create($data);
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function update(array $data, Department $department)
    {
        return tap($department)->update($data);
    }

    public function delete(Department $department)
    {
        return tap($department)->delete();
    }
}
