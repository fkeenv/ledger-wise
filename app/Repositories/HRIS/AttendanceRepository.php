<?php

namespace App\Repositories\HRIS;

use Illuminate\Support\Facades\DB;
use App\Models\Tenants\HRIS\Attendance;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Tenants\HRIS\AttendanceRequest;

class AttendanceRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private Attendance $attendance
    ) {
        //
    }

    public function get()
    {
        return $this->attendance->get();
    }

    public function create(AttendanceRequest $request, Model $model)
    {
        return $this->createAttendance($request, $model);
    }

    public function show(Attendance $attendance)
    {
        return $attendance;
    }

    public function update(array $request, Attendance $attendance)
    {
        return tap($attendance)->update($request);
    }

    public function delete(Attendance $attendance)
    {
        return tap($attendance)->delete();
    }

    private function createAttendance(AttendanceRequest $request, Model $model)
    {
        return DB::transaction(function () use ($request, $model) {
            $attendance = $this->attendance->create([
                'attendance_id' => $model->id,
                'attendance_type' => get_class($model),
                'date' => now(),
            ]);

            $attendance->records()->create([
                'time' => $request->get('time'),
                'type' => $request->get('type'),
            ]);
        });
    }
}
