@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.orderShow')}}
@endsection
@section('small_title')
    {{trans('admin.orders')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            @if($model)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">User NAME</th>
                        <th scope="col">{{$model->LAST_NAME}}</th>
                        <th scope="col">User EMAIL ADDRESS</th>
                        <th scope="col">{{$model->EMAIL_ADDRESS}}</th>
                    </tr>

                    <tr>
                        <th scope="col">User EMPLOYEE ID</th>
                        <th scope="col">{{$model->EMPLOYEE_ID}}</th>
                        <th scope="col">Semester Title</th>
                        <th scope="col">{{$model->semester->name}}</th>
                    </tr>

                    <tr>
                        <th scope="col">Department Title</th>
                        <th scope="col">{{$model->department->name}}</th>
                        <th scope="col">Order Status</th>
                        @if($model->status == 'pending')
                            <th scope="col" class="text-primary h4">Pending</th>
                        @endif
                        @if($model->status == 'approve')
                            <th scope="col" class="text-success h4">Manger Approve</th>
                        @endif
                        @if($model->status == 'reject')
                            <th scope="col" class="text-danger h4"> Manger Reject</th>
                        @endif
                    </tr>
                    <tr>
                        <th scope="col">Date Added</th>
                        <th scope="col">{{$model->created_at}}</th>
                    </tr>

                    </thead>
                </table>
            @endif
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        @if(isset($model->OrderProducts)&&count($model->OrderProducts)>0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center">الطلبات التي اختارها المستخدم</h3>
                                </div>

                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" style="direction: rtl">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" class="text-right">الصنف</th>
                                            <th scope="col" class="text-right">الكمية</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($model->OrderProducts as $key=>$product)
                                            @if(!empty($product)&&isset($product->product)&&count($product->product)>0)
                                                <tr>
                                                    <th scope="row">{{$product->product[0]->id}}</th>
                                                    <td>{{$product->product[0]->title}}</td>
                                                    <td>{{$product->quantity}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="box-title">No Data</h3>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="box-body">
                        @if(isset($semesterProducts)&&count($semesterProducts)>0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-center"><span
                                            style="color: blue"> مجموع الطلبات الكلي فى  :  </span> {{$model->semester->name}}
                                        <span style="color: blue">   &nbsp; والتى وافق عليها المديرين</span></h3>
                                </div>

                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" style="direction: rtl">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col" class="text-right">الصنف</th>
                                            <th scope="col" class="text-right">الكمية الكلية</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($semesterProducts as $key=>$product)
                                            @if(!empty($product))
                                                <tr>
                                                    <th scope="row">{{$product->product_id}}</th>
                                                    <td>{{$product->title}}</td>
                                                    <td>{{$product->total_count}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>

                        @endif

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 ">
                            <br>
                            <table class="table table-striped" style="direction: rtl">
                                <thead>
                                @if($model)
                                    <tr>
                                        <th scope="col" class="text-right">عدد الادارات التي طلبت وتم موافقة المدير</th>
                                        <th scope="col"
                                            class="text-right">{{$orderDepartmentsCount ?$orderDepartmentsCount:0}}</th>
                                    </tr>
                                @else
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 ">
                                            <h3 class="box-title">No Data</h3>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                @endif

                                </thead>
                            </table>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 ">
                            @if($model)


                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('/printPDF')}}">
                                    @csrf

                                    <input type="hidden" id="semester_id" name="semester_id" value="{{$model->semester_id}}">

                                    <button type="submit" class="btn btn-success">Print Excel</button>
                                    <br>
                                    <br>
                                    <br>
                                </form>



{{--                                <input type="hidden" id="semester_id" value="{{$model->semester_id}}">--}}
{{--                                <button type="button" class="btn btn-success"--}}
{{--                                        id="printPDF">Print--}}
{{--                                </button>--}}
                            @endif
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        var base_url = window.location.origin;
        $(document).ready(function () {
            $('.select2').select2();
            $("#printPDF").click(function () {
                var semester_id = $('#semester_id').val();
                let path = base_url + "/admin/order/printPDF";
                var object = {
                    "semester_id": semester_id,
                }
                $.ajax({
                    url: path,
                    type: 'POST',
                    cache: false,
                    data: JSON.stringify(object),
                    contentType: "application/json; charset=utf-8",
                    traditional: true,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    success: function (response) {
                        if (response) {
                           console.log(response)
                        }
                    },
                    error: function (response) {
                        console.log(response)
                        alert('error');
                    }
                });
            });
        });
    </script>
@endpush
