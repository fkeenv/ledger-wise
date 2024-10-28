<?php

namespace App\Models\Tenants\HRIS;

use App\Casts\AsJson;
use App\Casts\AsCurrency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'gross_salary',
        'net_salary',
        'tax_amount',
        'salary_rate',
        'total_days_worked',
        'total_minutes_late',
        'cut_off_start',
        'cut_off_end',
        'date_generated',
        'benefits',
    ];

    protected function casts(): array
    {
        return [
            'gross_salary' => AsCurrency::class,
            'net_salary' => AsCurrency::class,
            'tax_amount' => AsCurrency::class,
            'salary_rate' => AsCurrency::class,
            'benefits' => AsJson::class,
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
