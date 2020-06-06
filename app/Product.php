<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'price'
    ];

    use SoftDeletes;
    protected $dates =['deleted_at'];

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }
}
