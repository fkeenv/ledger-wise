<?php

namespace App\Models\Tenants\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'type',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
