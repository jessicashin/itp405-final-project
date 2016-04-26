<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
        'type_id',
        'amount',
        'due_date',
        'description',
        'delete_reason'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function type() {
        return $this->belongsTo('App\Models\BillingType');
    }

}
