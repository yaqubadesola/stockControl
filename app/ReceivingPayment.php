<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingPayment extends Model
{
    protected $fillable = ['supplier_id','receiving_id','payment','user_id','payment_type','comments'];
}
