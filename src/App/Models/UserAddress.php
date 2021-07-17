<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table    = 'users_addresses';
    protected $fillable = [
        'zipcode',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country',
    ];

    /**
     * Mutators
     */

    public function setZipcodeAttribute($value)
    {
        $value = str_replace('-', '', trim($value));

        $this->attributes['zipcode'] = $value;
    }
}
