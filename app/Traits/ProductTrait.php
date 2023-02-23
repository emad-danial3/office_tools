<?php

namespace App\Traits;

use App\Models\Product;

use Illuminate\Support\Facades\DB;

trait ProductTrait
{
    public function createNewProduct($request)
    {
        DB::beginTransaction();

        $cat_Product = new Product();
        $cat_Product->category_id=$request['category_id'];
        $cat_Product->status=$request['status'];
        $cat_Product->title=$request['title'];
        $cat_Product->save();

        DB::commit();
        $Product = Product::find($cat_Product->id);
        return $Product;
    }

    public function editProduct($request)
    {
        DB::beginTransaction();
        $Product = Product::findOrFail($request['product_id']);
        $Product->category_id=$request['category_id'];
        $Product->status=$request['status'];
        $Product->title=$request['title'];
        $Product->save();

        DB::commit();
        $Product = Product::find($Product->id);
        return $Product;
    }
}
