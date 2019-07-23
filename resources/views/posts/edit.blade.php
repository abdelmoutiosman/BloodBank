@extends('layouts.app')
@inject('category', 'App\Models\Category')
@section('content')
    @section('page_title')
       Edit Post
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form TO Edit Post</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">                          
                {!! Form::model($model,[
                        'action'=>['PostController@update',$model->id],
                        'method'=>'put',
                        'files'=>'true'
                    ]) !!}
                    <div class="form-group">
                        <label for="title">Title</label>
                        {!! Form::text('title',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        {!! Form::text('body',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        {!! Form::file('image',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="category_id">category_id</label>
                        {!! Form::select('category_id',$category->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> Edit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
