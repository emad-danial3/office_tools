<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $table="categories";
    public $timestamps = true;
    protected $fillable = [
        'img', 'name','status',
    ];

    
    public function products()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}
