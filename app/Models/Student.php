<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'mname',
        'gender',
        'birthdate',
        'grade',
        'school_id',
        'cphone',
        'email',
        'birth_country',
        'date_to_us',
        'first_language_id',
        'ethnicity_id',
        'parent1_relationship_id'
    ];

    public function name() {
        if ($this->mname != nullOrEmptyString()) {
            return $this->fname . ' ' . $this->mname . ' ' . $this->lname;
        } else {
            return $this->fname . ' ' . $this->lname;
        }
    }

    public function gender() {
        if (strcasecmp($this->gender, 'M') == 0) {
            return 'Male';
        }
        else {
            return 'Female';
        }
    }

    public function parent1() {
        return $this->belongsTo('App\Models\Parent1');
    }
    public function parent1Relationship() {
        return $this->belongsTo('App\Models\Lookup\RelationshipType');
    }
    public function parent2() {
        return $this->hasOne('App\Models\Parent2');
    }
    public function school() {
        return $this->belongsTo('App\Models\Lookup\School');
    }
    public function firstLanguage() {
        return $this->belongsTo('App\Models\Lookup\FirstLanguage');
    }
    public function ethnicity() {
        return $this->belongsTo('App\Models\Lookup\Ethnicity');
    }
    public function billings() {
        return $this->hasMany('App\Models\Billing');
    }
    public function enrollments() {
        return $this->hasMany('App\Models\Enrollment');
    }

}
