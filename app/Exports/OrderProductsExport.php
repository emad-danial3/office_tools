<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class OrderProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private  $semester_id;

    public function __construct($semester_id)
    {
        $this->semester_id = $semester_id;
    }
    public function collection()
    {
        $semesterProducts = DB::table('orders')
                ->leftJoin('order_product', 'orders.id', '=', 'order_product.order_id')
                ->leftJoin('category_products', 'order_product.product_id', '=', 'category_products.id')
                ->where('orders.semester_id', $this->semester_id)
                ->where('orders.status', 'approve')
                ->groupBy('order_product.product_id')
                ->select('order_product.product_id','category_products.title',DB::raw("sum(quantity) AS  total_count"))
                ->get();
        return $semesterProducts;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["product_id", "title", "total_count"];
    }
}
