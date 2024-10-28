<?php

namespace App\Http\Controllers\Tenants\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Attendance;
use App\Repositories\HRIS\AttendanceRepository;
use App\Http\Requests\Tenants\HRIS\AttendanceRequest;

class EmployeeAttendanceController extends Controller
{
    public function __construct(
        private AttendanceRepository $attendanceRepository
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        return $this->attendanceRepository->get($employee);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request, Employee $employee)
    {
        return $this->attendanceRepository->create($request, $employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, Attendance $attendance)
    {
        return $this->attendanceRepository->show($attendance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, Employee $employee, Attendance $attendance)
    {
        return $this->attendanceRepository->update($request, $attendance);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, Attendance $attendance)
    {
        return $this->attendanceRepository->delete($attendance);
    }
}
