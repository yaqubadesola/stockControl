<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function inventory()
    {
        return $this->hasMany('App\Inventory')->orderBy('id', 'DESC');
    }

    public function receivingtemp()
    {
        return $this->hasMany('App\ReceivingTemp')->orderBy('id', 'DESC');
    }

    public function receivingitem()
    {
        return $this->hasMany('App\ReceivingItem')->orderBy('id', 'DESC');
    }

    public function saletemp()
    {
        return $this->hasMany('App\SaleTemp')->orderBy('id', 'DESC');
    }

    public function saleitem()
    {
        return $this->hasMany('App\SaleItem')->orderBy('id', 'DESC');
    }
}
