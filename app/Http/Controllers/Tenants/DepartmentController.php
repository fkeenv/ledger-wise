<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenants\Department;
use App\Http\Controllers\Controller;
use App\Repositories\DepartmentRepository;
use App\Http\Requests\Tenants\DepartmentRequest;

class DepartmentController extends Controller
{
    public function __construct(
        private DepartmentRepository $departmentRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->departmentRepository->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        return $this->departmentRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return $this->departmentRepository->show($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        return $this->departmentRepository->update($data, $department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        return $this->departmentRepository->delete($department);
    }
}
