<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'start_date',
        'end_date'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function course() {
        return $this->hasMany('App\Models\Course');
    }
}
