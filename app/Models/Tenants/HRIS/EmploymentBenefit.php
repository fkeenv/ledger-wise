<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmploymentBenefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sector',
        'type',
    ];
}
