<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parent1 extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'title_id',
        'hphone',
        'cphone',
        'wphone',
        'address_id',
        'email',
        'progress_report'
    ];

    public function name() {
        if ($this->title != null) {
            return $this->title->name . ' ' . $this->fname . ' ' . $this->lname;
        } else {
            return $this->fname . ' ' . $this->lname;
        }
    }

    public function progressReport() {
        if ($this->progress_report == 1) {
            return 'yes';
        } else { return 'no'; }
    }

    public function students() {
        return $this->hasMany('App\Models\Student');
    }
    public function title() {
        return $this->belongsTo('App\Models\Lookup\Title');
    }
    public function address() {
        return $this->belongsTo('App\Models\Address');
    }
}
