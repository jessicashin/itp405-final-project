<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $id;
    protected $street;
    protected $city;
    protected $state_id;
    protected $zip;

    protected $fillable = [
        'street',
        'city',
        'state_id',
        'zip'
    ];

    public function state() {
        return $this->belongsTo('App\Models\Lookup\State');
    }

}
