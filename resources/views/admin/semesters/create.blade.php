@extends('admin.layouts.app')
@inject('model', 'App\Models\Semester')
@section('page_title')
    {{trans('admin.semesterCreate')}}
@endsection
@section('small_title')
    {{trans('admin.semesters')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.semesterCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\SemesterController@semesterStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}

                        <div class="form-group col-md-12">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', null , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date">{{trans('admin.from_date')}}</label>
                            {!! Form::date('from_date', null , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="to_date">{{trans('admin.to_date')}}</label>
                            {!! Form::date('to_date', null , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                       <div class="form-group col-md-12">

                           <div class="form-group">
                               <label for="status">{{trans('admin.status')}}</label>

                               <select name="status" class="form-control">
                                   <option {{old('status',$model->status)=="1"? 'selected':''}} value="1">Active</option>
                                   <option {{old('status',$model->status)=="0"? 'selected':''}}  value="0">No Active</option>

                               </select>
                           </div>
                       </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{trans('admin.submit')}} </button>
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
