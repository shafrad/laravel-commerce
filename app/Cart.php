<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    //
    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_number', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
