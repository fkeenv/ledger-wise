<?php

namespace App\Models\Tenants;

use App\Models\Tenants\HRIS\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'time_in',
        'time_out',
        'status',
    ];

    public function attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class);
    }
}
