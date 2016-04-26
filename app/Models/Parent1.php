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

    public function title() {
        return $this->belongsTo('App\Models\Lookup\Title');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address');
    }
}
