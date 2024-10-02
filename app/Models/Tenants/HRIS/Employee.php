<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'mobile_number',
        'birth_date',
    ];

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }
}
