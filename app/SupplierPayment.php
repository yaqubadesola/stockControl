<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    protected $fillable = ['supplier_id','payment','user_id','payment_type','comments'];
}
