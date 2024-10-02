<?php

namespace App\Repositories\HRIS;

use App\Models\Tenants\HRIS\Employee;
use App\Models\Tenants\HRIS\Position;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmployeePositionRepository
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
        return $this->employee->with('positions')->get();
    }

    public function create(Employee $employee, array $data)
    {
        $employee->positions()->sync($data['position_ids']);

        return $employee->with('positions')->first();
    }

    public function show(Employee $employee, Position $position)
    {
        return $employee->with(['positions' => function (BelongsToMany $query) use ($position) {
            $query->where('position_id', $position->id);
        }])->first();
    }
}
