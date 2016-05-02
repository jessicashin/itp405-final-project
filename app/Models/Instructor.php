<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'fname',
        'lname',
        'phone'
    ];

    public function name() {
        return $this->fname . ' ' . $this->lname;
    }

    public function classSections() {
        return $this->hasMany('App\Models\ClassSection');
    }
}
