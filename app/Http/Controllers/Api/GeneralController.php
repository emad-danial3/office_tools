<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\Messages;
use App\Models\Semester;

use App\Models\Setting;
use App\Models\Tokens;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Department;
use App\Models\OrderProducts;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use DB;

class GeneralController extends Controller
{
    public function getOneSemester(Request $request)
    {
        $model = Semester::where('from_date', '<', Carbon::now())->where('to_date', '>', Carbon::now())->first();
        return view('welcome', compact('model'));
    }

    public function checkUserEmail(Request $request)
    {
        $email = $request->input('email');
        $department_id = $request->input('department_id');

        try {
            $client = new \GuzzleHttp\Client();
            $data = [
                'validemail' => '1',
                'email' => $email,
            ];
            $response = $client->request('POST', 'http://oso.akhnatontrade.com/api/survey_api.php', ['form_params' => $data, 'verify' => false])->getBody()->getContents();
            Log::info($response);
            $user = json_decode($response, true);
        } catch (\Exception $e) {
            $catch = $e->getMessage();
            Log::error('check User Email :: ' . $email . ' ERROR::' . $e->getMessage());
            $user = json_decode($catch, true);
        }
        $model = Semester::where('from_date', '<', Carbon::now())->where('to_date', '>', Carbon::now())->first();
        $getOrder = Orders::where('semester_id', $model->id)->where('EMAIL_ADDRESS', $email)->first();
        if (!$getOrder) {
            if ((isset($user['status']) && $user['status'] == 200) && $model) {
                return $this->getProducts($model, $email, $user['data']['LAST_NAME'], $user['data']['EMPLOYEE_ID'], $department_id);
            } else {
                return view('welcome', [
                    'errorMessageDuration' => $user ? $user['message'] : "error in server",
                    'model' => $model,
                ]);
            }
        } else {
            return view('welcome', [
                'errorMessageDuration' => 'You make this survey before thank you',
                'model' => $model,
            ]);
        }

    }

    public function getProducts($model, $EMAIL, $LAST_NAME, $EMPLOYEE_ID, $department_id)
    {
        $products = Product::where('category_id', 1)->where('status', '1')->get();
        return view('products', compact('model', 'products', 'EMAIL', 'LAST_NAME', 'EMPLOYEE_ID', 'department_id'));
    }

    public function saveOrderOfficeToles(Request $request)
    {

        $alldata = $request->all();
        $LAST_NAME = $alldata['LAST_NAME'];
        $EMPLOYEE_ID = $alldata['EMPLOYEE_ID'];
        $EMAIL_ADDRESS = $alldata['EMAIL_ADDRESS'];
        $semester_id = $alldata['semester_id'];
        $department_id = $alldata['department_id'];
        $model = Semester::where('from_date', '<', Carbon::now())->where('to_date', '>', Carbon::now())->first();

        if ($LAST_NAME && $EMPLOYEE_ID && $EMAIL_ADDRESS && $EMPLOYEE_ID && $semester_id && $department_id) {
            $Order = new Orders();
            $Order->LAST_NAME = $LAST_NAME;
            $Order->EMPLOYEE_ID = $EMPLOYEE_ID;
            $Order->EMAIL_ADDRESS = $EMAIL_ADDRESS;
            $Order->semester_id = $semester_id;
            $Order->department_id = $department_id;
            $Order->save();
            if ($Order) {
                $orderhash = md5($Order->id);
                $Order->hash_code = $orderhash;
                $Order->save();
                foreach ($alldata['items'] as $key => $value) {
                    $order_product = new OrderProducts();
                    $order_product->order_id = $Order->id;
                    $order_product->product_id = $value['id'];
                    $order_product->quantity = $value['quantity'];
                    $order_product->save();
                }
                $this->sendMailToManager($department_id, $model->name, $alldata['items'], $orderhash);
                $response = [
                    'status' => 200,
                    'message' => "Order Create success",
                    'data' => $model
                ];
                return response()->json($response);
            }
        } else {
            $response = [
                'status' => 400,
                'message' => "error No order Create",
                'data' => null
            ];
            return response()->json($response);
        }
    }


    public function visitOrder(Request $request, $hash)
    {
        $model = Orders::where('hash_code', $hash)->with('semester')->with('department')->with(['OrderProducts' => function ($query) {
            $query->with('product');
        }])->first();
        if (!empty($model)) {
            return view('visit', compact('model'));
        }
        return true;
    }

    public function approveOrder(Request $request)
    {
        $alldata = $request->all();
        $getOrder = Orders::where('id', $alldata['order_id'])->first();
        if (!empty($getOrder)) {
            $getOrder->update([
                'status' => 'approve'
            ]);
            $response = [
                'status' => 200,
                'message' => "Order updated success",
                'data' => $getOrder
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 400,
                'message' => "error No update Order",
                'data' => null
            ];
            return response()->json($response);
        }

    }

    public function rejectOrder(Request $request)
    {
        $alldata = $request->all();
        $getOrder = Orders::where('id', $alldata['order_id'])->first();
        if (!empty($getOrder)) {
            $getOrder->update([
                'status' => 'reject'
            ]);
            $response = [
                'status' => 200,
                'message' => "Order updated success",
                'data' => $getOrder
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 400,
                'message' => "error No update Order",
                'data' => null
            ];
            return response()->json($response);
        }

    }
    
    public function testsend()
    {
        $data = array([
            'id' => 1,
            'name' => 'name product',
            'quantity' => 3
        ], ['id' => 2,
            'name' => 'name product 22',
            'quantity' => 4]);
        $this->sendMailToManager(5, "طلبية شهر فبراير", $data, 'sddfksibifgkkjr');

    }

    public function sendMailToManager($department_id, $semester_title, $products, $hash_code)
    {

        $managerEmail = Department::find($department_id); // get manager name and manager email
        if (!empty($managerEmail['manager_email']) && !empty($managerEmail['manager_name'])) {
            $emailData['subject'] = "Office Tools Order";
            $emailData['manager_name'] = $managerEmail['manager_name'];
            $emailData['title'] = 'طلب طلبية ادوات مكتبية';
            $emailData['title2'] = $semester_title;
            $emailData['hash_code'] = $hash_code;
            $emailData['body'] = $products;
            Mail::to($managerEmail['manager_email'])->send(new NotificationEmail($emailData));
            if (count(Mail::failures()) > 0) {
                return false;
            }
        }
        return true;
    }
}
