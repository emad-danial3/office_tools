<!DOCTYPE html>
<html lang="en">
<head>
    <title> Survey Web Site</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class=" text-center">
    <img src="{{asset('/uploads/ATR.jpg')}}" alt="000000" class="img-thumbnail"
         width="50%" height="200px!important">
</div>

<div class="jumbotron text-center" style="width: 50%;margin: auto;margin-top: 20px;margin-bottom: 20px;">
    <h3 class="box-title">{{$model->name}}</h3>
</div>

<div class="container">
    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-8">

            @if(isset($errorMessageDuration))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $errorMessageDuration }}
                </div>
            @endif


            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('checkUserEmail')}}">
                @csrf

                <label><span style="color: #2576d9">Sign With Company Account</span></label>
                <div class="form-group">
                    <label for="email">Email <span style="color: #d93025"> * </span></label>
                    <input type="email" id="email" name="email" class="form-control" required
                           placeholder="Please Enter Your Email">
                </div>

                <div class="form-group">
                    @inject('departments', 'App\Models\Department')
                    @if($departments->where('id','>', 0)->where('status', '1')->count() != 0)
                        <div class="form-group">

                            <label for="department_id">{{trans('admin.department_id')}} <span
                                    style="color: #d93025"> * </span></label>


                            <select class="form-control form-select form-select-lg mb-3 select2" id="department_id"
                                    required
                                    name="department_id">
                                <option value="">{{trans('admin.department_id')}}</option>
                                @foreach($departments->where('id','>', 0)->where('status', '1')->get() as $department)
                                    <option style="padding: 10px 20px;margin-top: 10px"
                                            value="{{$department->id}}">
                                        {{$department->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Next</button>
            </form>
                <br>
                <br>
                <br>
                <br>
            <div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<footer class="bg-light text-center text-lg-start" >
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright:
        <a class="text-dark" href="/">ATR</a>
    </div>
    <!-- Copyright -->
</footer>
</body>
</html>

