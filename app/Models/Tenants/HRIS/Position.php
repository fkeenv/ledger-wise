<?php

namespace App\Models\Tenants\HRIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'department_id',
        'name',
        'description',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
