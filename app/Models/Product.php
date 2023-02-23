<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $table="category_products";
    public $timestamps = true;
    protected $fillable = [
        'category_id', 'title','status'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

}
