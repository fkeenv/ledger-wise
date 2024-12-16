<?php

namespace App\Models\Tenants\Accounting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile',
        'notes',
        'is_active',
        'is_taxable',
    ];
}
