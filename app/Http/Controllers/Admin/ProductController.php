<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductDatatable;
use App\Http\Requests\productCreate;
use App\Http\Requests\productEdit;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\ProductTrait;



class ProductController extends Controller
{
    use ProductTrait;

    /**
     * Display a listing of the resource.
     *
     * @param ProductDatatable $product
     * @return void
     */
    public function products(ProductDatatable $product)
    {
        return $product->render('admin.products.index');
    }

    public function productCreate()
    {
        return view('admin.products.create');
    }

    public function productStore(productCreate $request)
    {
        $this->createNewProduct($request->all());
        flash()->success(trans('admin.createMessageSuccess'));
        return redirect(route('admin.products'));
    }

    public function productEdit($id)
    {
        $model = Product::findOrFail($id);
        return view('admin.products.edit', compact('model' ));
    }

    public function productUpdate(productEdit $request, $id)
    {
        $request['product_id'] = $id;
        $this->editProduct($request->all());
        flash()->success(trans('admin.editMessageSuccess'));
        return redirect(route('admin.products'));
    }


    public function productDelete($id)
    {

        $delete = Product::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = trans('company.delete_success');
        } else {
            $success = true;
            $message = trans('company.delete_error');
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}
