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
        .category_name{
            text-align: center;
            border-radius: 7px;
            background-color: rgb(123, 55, 10);
            color: rgba(255, 255, 255, 1);
            padding: 12px 24px;
        }
        .card{
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .user_name{
            max-width: 350px;
            width: 350px;
            overflow: hidden
        }
        .this_option{
            width: 20px;
            height: 20px;
        }
        .specific_input,.specific_input:focus{
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

.table.table-bordered,.table.table-striped{
    direction: rtl;
}
        .loader{
            position: fixed;
            left: 50%;
            top: 50%;
            width: 20%;
            height: 20%;
            z-index: 9999;
            display: none;
        }
    </style>

</head>
<body>
<div class="loader">
    <img class="card-img-top cartimage"
         src="{{asset('test/Loading_icon.gif')}}" alt="Card image cap">
</div>
<div class="jumbotron text-center">
    <h3 class="box-title">{{$model->name}}</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success text-center" role="alert" style="display: none">
                <h3>  ???? ?????????? ?????????? ??????????</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        @if($products)
                                <div id="add-blog-post-form">

                                    @if($model)
                                        <input type="hidden"  name="LAST_NAME" id="LAST_NAME" value="{{$LAST_NAME}}">
                                        <input type="hidden"  name="EMPLOYEE_ID" id="EMPLOYEE_ID" value="{{$EMPLOYEE_ID}}">
                                        <input type="hidden"  name="EMAIL_ADDRESS" id="EMAIL_ADDRESS" value="{{$EMAIL}}">
                                        <input type="hidden"  name="semester_id" id="semester_id" value="{{$model->id}}">
                                        <input type="hidden"  name="department_id" id="department_id" value="{{$department_id}}">
                                    @endif

                                    @if($products)
                                            <h4></h4>
                                        <div class="row">
                                            <div class="col-md-12 card">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr><th scope="col" class="text-center" colspan="4">?????? ???????????? ?????????? ?????? ?????????? ?????? ?????????????? ???????? ?????? ?????????? ?????? </th></tr>
                                                    <tr>
                                                        <th scope="col" class="text-center">#</th>
                                                        <th scope="col" class="text-center">??????????</th>
                                                        <th scope="col" class="text-center">????????????</th>
                                                        <th scope="col" class="text-center">????????</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($products as $product)
                                                    <tr>
                                                        <th scope="row" class="text-center">{{$product->id}}</th>
                                                        <td class="text-center">{{$product->title}}</td>
                                                        <td class="text-center">
                                                            <input type="number" min="0"
                                                                   value="0"
                                                                   class="border border-primary rounded text-center w-50"
                                                                   id="quantityProduct{{$product->id}}">
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button"
                                                                    class="btn btn-info addToCartButton"
                                                                    id="{{$product->id}}"
                                                                    product_name="{{$product->title}}">
                                                                ??????????
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    @endif

                                    <div class="row" id="orderContainer">
                                            <div class="col-md-12">
                                                <div class="md-form">
                                                    <h3 style="text-align: right;">??????????</h3>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col" class="text-center">#</th>
                                                                    <th scope="col" class="text-center">??????????</th>
                                                                    <th scope="col" class="text-center">????????????</th>
                                                                    <th scope="col" class="text-center">??????</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="cartProductContainer">
                                                                <tr id="nodata">
                                                                    <th scope="row" colspan="6" class="text-center">
                                                                        No Data
                                                                    </th>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 ">
                                            <br>
                                            <br>
                                            <button type="button" disabled class="btn btn-primary" id="save_button"  onclick="saveOrderButton()">?????????? ??????????</button>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
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


        </div>

    </div>
</div>
<script type="text/javascript">

    var cartProducts = [];
    var base_url = window.location.origin;
    $(document).ready(function () {
        $(".addToCartButton").click(function () {
            console.log("fdfdfd 11");
            var productId = $(this).attr('id');
            var productName = $(this).attr('product_name');
            var productQuantity = $('#quantityProduct' + productId).val();
            var el_exist_inarray = cartProducts.find((e) => e.id == productId);
            if(productQuantity > 0){
                if(el_exist_inarray){
                    var mainobj = {
                        'id': productId,
                        'name': productName,
                        'quantity': parseInt(parseInt(el_exist_inarray['quantity'])+parseInt(productQuantity))
                    }
                    removeFromCart(productId)
                }else {
                    var mainobj = {
                        'id': productId,
                        'name': productName,
                        'quantity': productQuantity
                    }
                }

                $("#nodata").hide();
                cartProducts.push(mainobj);
                $('#quantityProduct' + productId).val(0);
                $('#save_button').removeAttr('disabled');
                $("#cartProductContainer").append(
                    ' <tr id="productparent'+productId+'"> <th scope="row" class="text-center"> ' + cartProducts.length + ' </th><td class="text-center"> ' + productName + ' </td><td class="text-center">' + mainobj['quantity'] + '</td><td class="text-center"><button type="button" onclick="removeFromCart('+productId+')" style="border: 0px;color: red;">X</button></td></tr>'
                );
                window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: 'smooth' })
            }
        });


    });

    function removeFromCart(produt_id) {
        const indexOfObject = cartProducts.findIndex(object => {
            return object.id == produt_id;
        });
        cartProducts.splice(indexOfObject, 1);
        $("#productparent"+produt_id).hide();
        if(cartProducts.length < 1){
            $("#nodata").show();
        }
    }
    function saveOrderButton() {


        $('.loader').show();
            var LAST_NAME = $('#LAST_NAME').val();
            var EMPLOYEE_ID = $('#EMPLOYEE_ID').val();
            var EMAIL_ADDRESS = $('#EMAIL_ADDRESS').val();
            var semester_id = $('#semester_id').val();
            var department_id = $('#department_id').val();

        let path = base_url + "/saveOrderOfficeToles";


        var ff={
            "LAST_NAME":LAST_NAME ,
            "EMPLOYEE_ID":EMPLOYEE_ID ,
            "EMAIL_ADDRESS":EMAIL_ADDRESS ,
            "semester_id":semester_id ,
            "department_id":department_id ,
            "items":cartProducts
        }

        $.ajax({
            url: path,
            type: 'POST',
            cache: false,
            data: JSON.stringify(ff),
            contentType: "application/json; charset=utf-8",
            traditional: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            success: function (response) {
                if (response.data) {
                    $('.loader').hide();
                    $('#save_button').prop('disabled', true);
                    $("#cartProductContainer").html('');
                    $("#cartProductContainer").append(
                        ' <tr id="nodata"> <th scope="row" colspan="6" class="text-center"> No Data </th></tr>'
                    );
                    $(".alert-success").show();
                    cartProducts=[];
                    window.scrollTo({ left: 0, top: 0, behavior: 'smooth' });
                    setTimeout( function(){ window.location.href =window.location.origin+'/success' }   , 3000);

                }
            },
            error: function (response) {
                console.log(response)
                alert('error');
            }
        });
    }



</script>
</body>
</html>

