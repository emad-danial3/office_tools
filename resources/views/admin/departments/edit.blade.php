@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.departmentEdit')}}
@endsection
@section('small_title')
    {{trans('admin.departments')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.departmentEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\DepartmentController@departmentUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}


                        <div class="form-group">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', $model->name , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('admin.status')}}</label>

                            <select name="status" class="form-control">
                                <option {{old('status',$model->status)=="0"? 'selected':''}}  value="0">No Active</option>
                                <option {{old('status',$model->status)=="1"? 'selected':''}} value="1">Active</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="manager_name">{{trans('admin.manager_name')}}</label>
                            {!! Form::text('manager_name', $model->manager_name , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="manager_email">{{trans('admin.manager_email')}}</label>
                            {!! Form::text('manager_email', $model->manager_email , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>



                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
                        </div>

                        {!! Form::close() !!}
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
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
