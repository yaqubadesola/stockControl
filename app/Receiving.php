<?php namespace App;

use App\ReceivingItem;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public static function receiving_detailed($receiving_id)
    {
        $receivingitems = ReceivingItem::where('receiving_id', $receiving_id)->get();
        return $receivingitems;
    }
}
