<?php

namespace App\DataTables\Admin;

use App\Models\Category;
use App\Models\Product;
use Yajra\DataTables\Services\DataTable;


class ProductDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($contact){
                return date('d/m/Y H:i:s', strtotime($contact->created_at) );
            })->editColumn('status', function ($contact){
                return $contact->status == '1'?"Active":"Not Active";
            })
            ->editColumn('title', function($contact) {
                return $contact->title;
            })
            ->addColumn('action', 'admin.products.btn.action')
            ->addColumn('category', 'admin.products.btn.category')
            ->rawColumns([
                'action',
                'category'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AdminDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Product::query()->select('category_products.*')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[20, 50, 100, 200], [20, 50, 100, trans('datatable.show_all')]],
                'buttons' => [],
                'language' => datatable_lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID',
            ],[
                'name' => 'title',
                'data' => 'title',
                'title' => trans('datatable.title'),
                'orderable' => false,
            ],[
                'name' => 'category',
                'data' => 'category',
                'title' => trans('datatable.category'),
                'orderable' => false,
            ]
            , [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('datatable.status'),
            ],[
                'name' => 'action',
                'data' => 'action',
                'title' => trans('datatable.action'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,

            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Question_' . date('YmdHis');
    }
}

