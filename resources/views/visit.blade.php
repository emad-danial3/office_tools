<!DOCTYPE html>
<html lang="en">
<head>
    <title> Office Tools Web Site</title>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .category_name {
            text-align: center;
            border-radius: 7px;
            background-color: rgb(123, 55, 10);
            color: rgba(255, 255, 255, 1);
            padding: 12px 24px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .user_name {
            max-width: 350px;
            width: 350px;
            overflow: hidden
        }

        .this_option {
            width: 20px;
            height: 20px;
        }

        .specific_input, .specific_input:focus {
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

        .table.table-bordered, .table.table-striped {
            direction: rtl;
        }

        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            width: 20%;
            height: 20%;
            z-index: 9999;
            display: none;
        }

        .container {
            border: 1px solid #e7e7e7;
            border-radius: 10px;
            padding-bottom: 10px;
        }
    </style>

</head>
<body>
<div class="loader">
    <img class="card-img-top cartimage"
         src="{{asset('test/Loading_icon.gif')}}" alt="Card image cap">
</div>
<div class="jumbotron text-center">
    <h3 class="box-title">{{$model->semester->name}}</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success text-center" role="alert" style="display: none">
                <h3> ???? ?????????? ?????????? ??????????</h3>
            </div>
            <div class="alert alert-danger text-center" role="alert" style="display: none">
                <h3> ???? ?????? ?????????? ??????????</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">

                        <section class="content">
                            <!-- Default box -->
                            <div class="box">
                                @if($model)
                                    <input type="hidden" value="{{$model->id}}" id="order_id">
                                    <table class="table table-striped" style="direction: ltr">
                                        <thead>
                                        <tr>
                                            <th scope="col">User NAME</th>
                                            <th scope="col">{{$model->LAST_NAME}}</th>
                                            <th scope="col">User EMAIL ADDRESS</th>
                                            <th scope="col">{{$model->EMAIL_ADDRESS}}</th>
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
                                                        <h3 class="text-center">?????????????? ???????? ?????????????? </h3>
                                                    </div>

                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <table class="table table-bordered" style="direction: rtl">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col" class="text-right">??????????</th>
                                                                <th scope="col" class="text-right">????????????</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($model->OrderProducts as $key=>$product)
                                                                @if(!empty($product)&&isset($product->product)&&count($product->product)>0)
                                                                    <tr>
                                                                        <th scope="row">{{$product->product[0]->id}}</th>
                                                                        <td class="text-right">{{$product->product[0]->title}}</td>
                                                                        <td class="text-right">{{$product->quantity}}</td>
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
                                            @if($model)
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8 row">
                                                        <div class="col-md-3">
                                                            <br>
                                                            <button type="button" class="btn btn-danger" id="rejectOrder">?????? ??????????
                                                            </button>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <br>
                                                            <button type="button" class="btn btn-success"
                                                                    id="approveOrder">???????????? ?????? ??????????
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </section>
                    </div>


                </div>

            </div>
        </div>

        <script type="text/javascript">

            var base_url = window.location.origin;

            $(document).ready(function () {
                $("#approveOrder").click(function () {
                    var orderID = $('#order_id').val();
                    let path = base_url + "/approveOrder";
                    var object = {
                        "order_id": orderID,
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
                            if (response.data) {
                                $(".alert-success").show();
                                window.scrollTo({left: 0, top: 0, behavior: 'smooth'});
                                setTimeout(function () {
                                    window.location.href = window.location.origin + '/success'
                                }, 3000);

                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                });
                $("#rejectOrder").click(function () {
                    var orderID = $('#order_id').val();
                    let path = base_url + "/rejectOrder";
                    var object = {
                        "order_id": orderID,
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
                            if (response.data) {
                                $(".alert-danger").show();
                                window.scrollTo({left: 0, top: 0, behavior: 'smooth'});
                                setTimeout(function () {
                                    window.location.href = window.location.origin + '/success'
                                }, 3000);

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

    </div>
</div>
<footer class="bg-light text-center text-lg-start mt-4">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        ?? 2022 Copyright:
        <a class="text-dark" href="/">ATR</a>
    </div>
    <!-- Copyright -->
</footer>
</body>
</html>

