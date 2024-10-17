<?php

namespace App\Http\Controllers\Tenants\HRIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\EmploymentBenefit;
use App\Repositories\HRIS\EmploymentBenefitRepository;

class EmploymentBenefitController extends Controller
{
    public function __construct(
        private EmploymentBenefitRepository $employmentBenefitRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->employmentBenefitRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->employmentBenefitRepository->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploymentBenefit $employmentBenefit)
    {
        return $this->employmentBenefitRepository->show($employmentBenefit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmploymentBenefit $employmentBenefit)
    {
        return $this->employmentBenefitRepository->update($request, $employmentBenefit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentBenefit $employmentBenefit)
    {
        return $this->employmentBenefitRepository->delete($employmentBenefit);
    }
}
