<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code',
        'name',
        'tuition',
        'course_session_id',
        'start_date',
        'end_date',
        'capacity'
    ];

    public function courseSession() {
        return $this->belongsTo('App\Models\Lookup\CourseSession');
    }
    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }
    public function enrollments() {
        return $this->hasMany('App\Models\Enrollment');
    }
}
