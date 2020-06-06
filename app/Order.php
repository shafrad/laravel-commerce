<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    protected $fillable = [
        'order_number', 'user_id', 'status', 'name', 'phone', 'address'
    ];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function carts()
    {
        return $this->hasMany('App\Cart', 'order_id', 'order_number');
    }
}
