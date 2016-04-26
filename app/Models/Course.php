<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code',
        'name',
        'tuition',
        'session_id',
        'start_date',
        'end_date',
        'capacity'
    ];

    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }

    public function enrollments() {
        return $this->hasMany('App\Models\Enrollment');
    }
}
