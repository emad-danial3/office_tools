@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.productEdit')}}
@endsection
@section('small_title')
    {{trans('admin.products')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.productEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\ProductController@productUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}


                        @inject('categories', 'App\Models\Category')
                        @if($categories->where('id','>', 0)->where('status', '1')->count() != 0)
                            <div class="form-group">
                                <label for="category_id">{{trans('admin.category_id')}} *</label>
                                <select class="form-control select2" id="category_id" required
                                        name="category_id">
                                    <option value="0">{{trans('admin.category_id')}}</option>
                                    @foreach($categories->where('id','>', 0)->where('status', '1')->get() as $category)
                                        <option
                                            value="{{$category->id}}" @if ($category->id ==  $model->category_id) selected @endif>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <div class="form-group">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('title', $model->title , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('admin.status')}}</label>

                            <select name="status" class="form-control">
                                <option {{old('status',$model->status)=="0"? 'selected':''}}  value="0">No Active</option>
                                <option {{old('status',$model->status)=="1"? 'selected':''}} value="1">Active</option>
                            </select>
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
