<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parent2 extends Model
{
    protected $fillable = [
        'student_id',
        'relationship_id',
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

    public function relationship() {
        return $this->belongsTo('App\Models\Lookup\RelationshipType');
    }
    public function title() {
        return $this->belongsTo('App\Models\Lookup\Title');
    }
    public function address() {
        return $this->belongsTo('App\Models\Address');
    }
}
