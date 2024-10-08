<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenants\AttendanceRecord;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    public function records(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
