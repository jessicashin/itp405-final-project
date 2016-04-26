<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'phone'
    ];

    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }
}
