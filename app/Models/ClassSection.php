<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    protected $fillable = [
        'code',
        'name',
        'exam',
        'instructor_id',
        'room_id',
        'start_time',
        'end_time',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday'
    ];

    public function course() {
        return $this->belongsTo('App\Models\Course');
    }

    public function instructor() {
        return $this->belongsTo('App\Models\Instructor');
    }

    public function room() {
        return $this->belongsTo('App\Models\Room');
    }

}
