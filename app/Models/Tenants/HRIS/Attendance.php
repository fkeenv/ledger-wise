<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'attendance_type',
        'date',
    ];

    public function records(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
