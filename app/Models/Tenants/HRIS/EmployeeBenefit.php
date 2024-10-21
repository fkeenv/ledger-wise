<?php

namespace App\Models\Tenants\HRIS;

use App\Casts\ConvertJson;
use App\Casts\ConvertToHundredths;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeBenefit extends Pivot
{
    use HasFactory;

    protected $table = 'employee_benefits';

    protected $fillable = [
        'employee_id',
        'benefit_ids',
        'employer_weight',
        'employee_weight',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'employer_weight' => ConvertToHundredths::class,
            'employee_weight' => ConvertToHundredths::class,
            'data' => ConvertJson::class,
        ];
    }
}
