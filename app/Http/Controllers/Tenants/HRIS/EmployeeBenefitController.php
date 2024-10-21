<?php

namespace App\Http\Controllers\Tenants\HRIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\EmployeeBenefit;
use App\Repositories\HRIS\EmployeeBenefitRepository;

class EmployeeBenefitController extends Controller
{
    public function __construct(
        private EmployeeBenefitRepository $employeeBenefitRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        return $this->employeeBenefitRepository->get($employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        return $this->employeeBenefitRepository->create($employee, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Employee $employee, EmployeeBenefit $employeeBenefit)
    {
        return $this->employeeBenefitRepository->delete($employeeBenefit);
    }
}
