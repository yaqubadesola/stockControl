<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlexiblePosSetting extends Model
{
    protected $fillable = ['language', 'logo_path', 'fevicon_path', 'company_name', 'company_address', 'starting_balance'];
}
