<?php

namespace App\Http\Controllers\Tenants\HRIS;

use Illuminate\Http\Request;
use App\Models\Tenants\HRIS\Salary;
use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Repositories\HRIS\EmployeeSalaryRepository;

class EmployeeSalaryController extends Controller
{
    public function __construct(
        private EmployeeSalaryRepository $employeeSalaryRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Employee $employee)
    {
        return $this->employeeSalaryRepository->get($employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        return $this->employeeSalaryRepository->create($request, $employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, Salary $salary)
    {
        return $this->employeeSalaryRepository->show($employee, $salary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, Salary $salary)
    {
        return $this->employeeSalaryRepository->update($request, $employee, $salary);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Salary $salary)
    {
        return $this->employeeSalaryRepository->destroy($employee, $salary);
    }
}
