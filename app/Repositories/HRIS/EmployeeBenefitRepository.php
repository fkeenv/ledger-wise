<?php

namespace App\Repositories\HRIS;

use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeBenefit;

class EmployeeBenefitRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private EmployeeBenefit $employeeBenefit
    ) {
    }

    public function get(Employee $employee)
    {
        return $employee->benefits;
    }

    public function create(Employee $employee, array $data)
    {
        $employee->benefits()->attach($data['employment_benefit_id'], [
            'employer_weight' => $data['employer_weight'],
            'employee_weight' => $data['employee_weight'],
            'data' => $data['meta'],
        ]);

        return $employee->benefits()->find($data['employment_benefit_id']);
    }

    public function delete(EmployeeBenefit $employeeBenefit)
    {
        return $employeeBenefit->delete();
    }

    private function toInt($value)
    {
        return $value * 100;
    }
}
