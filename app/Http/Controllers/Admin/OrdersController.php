<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OrdersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\User;
use App\Models\Semester;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Mpdf\HTMLParserMode;
use DB;

use App\Exports\OrderProductsExport;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param OrdersDatatable $user
     * @return void
     */
    public function orders(OrdersDatatable $user)
    {
        return $user->render('admin.orders.index');
    }


    public function orderShow($id)
    {
        $model = Orders::where('id', $id)->with('semester')->with('department')->with(['OrderProducts' => function ($query) {
            $query->with('product');
        }])->first();
        if ($model) {
            $orderDepartmentsCount = Orders::where('semester_id', $model->semester_id)->where('status', 'approve')->count();
            $semesterProducts = DB::table('orders')
                ->leftJoin('order_product', 'orders.id', '=', 'order_product.order_id')
                ->leftJoin('category_products', 'order_product.product_id', '=', 'category_products.id')
                ->where('orders.semester_id', $model->semester_id)
                ->where('orders.status', 'approve')
                ->groupBy('order_product.product_id')
                ->select('order_product.product_id', 'category_products.title', DB::raw("sum(quantity) AS  total_count"))
                ->get();

            return view('admin.orders.show', compact('model', 'orderDepartmentsCount', 'semesterProducts'));
        } else {
            return view('admin.orders.show', [
                'errorMessageDuration' => 'no Data',
                'model' => null,
            ]);
        }
    }

    public function printPDF(Request $request)
    {
        $semester_id = $request->input('semester_id');
        $orderDepartmentsCount = Orders::where('semester_id', $semester_id)->where('status', 'approve')->count();
        $model = Semester::where('id', $semester_id)->first();
        $semesterProducts = DB::table('orders')
            ->leftJoin('order_product', 'orders.id', '=', 'order_product.order_id')
            ->leftJoin('category_products', 'order_product.product_id', '=', 'category_products.id')
            ->where('orders.semester_id', $semester_id)
            ->where('orders.status', 'approve')
            ->groupBy('order_product.product_id')
            ->select('order_product.product_id', 'category_products.title', DB::raw("sum(quantity) AS  total_count"))
            ->get();


        $data = [
            'orderDepartmentsCount' => $orderDepartmentsCount,
            'model' => $model,
            'semesterProducts' => $semesterProducts,
        ];
        return Excel::download(new OrderProductsExport($semester_id), 'products.xlsx');
//        $pdf = PDF::loadView('myPDF', $data);
//        return $pdf->stream('each_print.pdf');
//        return $pdf->download('itsolutionstuff.pdf');
//        $mpdf = new Mpdf();
//
//
//    $mpdf->WriteHTML('<h1>dffdfdfd</h1>');
//        $mpdf->Output('MyPDF.pdf', 'D');
//        return "done";

    }


//
//    public function printPDF(Request $request)
//    {
//            $semester_id = $request->input('semester_id');
//            $orderDepartmentsCount=Orders::where('semester_id', $semester_id)->where('status','approve')->count();
//            $model = Semester::where('id',$semester_id)->first();
//            $semesterProducts = DB::table('orders')
//                ->leftJoin('order_product', 'orders.id', '=', 'order_product.order_id')
//                ->leftJoin('category_products', 'order_product.product_id', '=', 'category_products.id')
//                ->where('orders.semester_id', $semester_id)
//                ->where('orders.status', 'approve')
//                ->groupBy('order_product.product_id')
//                ->select('order_product.product_id','category_products.title',DB::raw("sum(quantity) AS  total_count"))
//                ->get();
//
//        $documentFileName = "semester_report.pdf";
//
//
////        $mpdf = new Mpdf();
////        $mpdf->WriteHTML(view('pdf'));
////        $mpdf->Output('Invoice_1.pdf',\Mpdf\Output\Destination::DOWNLOAD);
////        // $mpdf->Output('files/Invoice'.$input['membership_id'].'.pdf', Destination::FILE);
//        // die();
//
////        return response()->download('Invoice_1.pdf');
//
//
//        // Create the mPDF document
//  $mPDF = new \Mpdf\Mpdf();
//
//        // Set some header informations for output
//
////        $mPDF->WriteHTML(view('files.pdf', compact('model')));
//$mPDF->WriteHTML('<h1>emad emad</h1>');
////            $document->Output();
////        $document->OutputFile(public_path('files/download.pdf'));
////        $document->OutputHttpInline();
////        $document->Output(public_path('files/download.pdf'), 'D');
////        $document->OutputHttpDownload('download.pdf');
////        return response($document->Output($documentFileName, "D"),200)->header('Content-Type','application/pdf');
////        $mPDF->Output($documentFileName, 'D');
////            return view('admin.orders.show', compact('model','orderDepartmentsCount','semesterProducts'));
//
//
////        $mpdf = new Mpdf();
////        // $stylesheet = file_get_contents('files/style.css');
////        // $mpdf->WriteHTML($stylesheet,HTMLParserMode::HEADER_CSS);
////        $mpdf->WriteHTML(view('myInvoicePDF'));
////        $mpdf->Output('MyPDF.pdf', 'D');
////        return "done";
//
//
//        $data = [
//            'orderDepartmentsCount' => $orderDepartmentsCount,
//            'model' => $model,
//            'semesterProducts' => $semesterProducts,
//        ];
//
//        $pdf = PDF::loadView('myPDF', $data);
//
//        return $pdf->download('itsolutionstuff.pdf');
//
//    }
//

    public function reportDelete($id)
    {
        $delete = UsersSurveys::where('id', $id)->delete();

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
