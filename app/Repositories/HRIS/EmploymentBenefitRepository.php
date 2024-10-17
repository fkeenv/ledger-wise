<?php

namespace App\Repositories\HRIS;

use Illuminate\Http\Request;
use App\Models\Tenants\HRIS\EmploymentBenefit;

class EmploymentBenefitRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected EmploymentBenefit $employmentBenefit
    ) {
    }

    public function get()
    {
        return $this->employmentBenefit->get();
    }

    public function create(Request $request)
    {
        return $this->employmentBenefit->create($request->all());
    }

    public function show(EmploymentBenefit $employmentBenefit)
    {
        return $employmentBenefit;
    }

    public function update(Request $request, EmploymentBenefit $employmentBenefit)
    {
        return tap($employmentBenefit)->update($request->all());
    }

    public function delete(EmploymentBenefit $employmentBenefit)
    {
        return tap($employmentBenefit)->delete();
    }
}
