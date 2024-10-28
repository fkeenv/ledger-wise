<?php

namespace App\Models\Tenants\HRIS;

use App\Casts\AsJson;
use App\Casts\AsCurrency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'salary',
        'salary_type',
        'tax',
        'employment_type',
        'start_date',
        'regular_date',
        'resign_date',
        'can_overtime',
        'is_active',
        'data',
        'created_at',
        'updated_at',
    ];

    public function casts(): array
    {
        return [
            'salary' => AsCurrency::class,
            'data' => AsJson::class,
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
