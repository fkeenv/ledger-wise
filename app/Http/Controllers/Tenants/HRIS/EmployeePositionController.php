<?php

namespace App\Http\Controllers\Tenants\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Position;
use App\Repositories\HRIS\EmployeePositionRepository;
use App\Http\Requests\Tenants\HRIS\EmployeePositionRequest;

class EmployeePositionController extends Controller
{
    public function __construct(
        private EmployeePositionRepository $employeePositionRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->employeePositionRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeePositionRequest $request, Employee $employee)
    {
        $data = $request->validated();

        return $this->employeePositionRepository->create($employee, $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, Position $position)
    {
        return $this->employeePositionRepository->show($employee, $position);
    }
}
