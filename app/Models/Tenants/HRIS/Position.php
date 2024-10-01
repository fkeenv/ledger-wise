<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'department_id',
        'name',
        'description',
    ];
}
