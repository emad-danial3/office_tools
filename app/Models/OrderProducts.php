<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{

    public $table="order_product";
    public $timestamps = true;
    protected $fillable = [
        'order_id', 'quantity','product_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Orders','id','order_id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product','id','product_id');
    }

}
