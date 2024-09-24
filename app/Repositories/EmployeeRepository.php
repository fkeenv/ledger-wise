<?php

namespace App\Repositories;

use App\Models\Tenants\Employee;

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
}
