<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'type_id',
        'amount',
        'tracking',
        'description',
        'delete_reason'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function type() {
        return $this->belongsTo('App\Models\PaymentType');
    }

}
