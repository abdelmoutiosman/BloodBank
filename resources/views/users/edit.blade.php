@extends('layouts.app')
@section('content')
    @section('page_title')
        {{__('messages.Edit User')}}
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('messages.Form TO Edit User')}}</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('partials.validation_errors')
                {!! Form::model($model,[
                        'action'=>['UserController@update',$model->id],
                        'method'=>'put'
                    ]) !!}
                    <div class="form-group">
                        <label for="name">{{__('messages.Name')}}</label>
                        {!! Form::text('name',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('messages.Email')}}</label>
                        {!! Form::email('email',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="password">{{__('messages.Password')}}</label>
                        {!! Form::password('password',[
                            'class'=>'password1 form-control',
                        ]) !!}
                        <i class="show-pass1 fa fa-eye fa-1x"></i>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{__('messages.Password Confirmation')}}</label>
                        {!! Form::password('password_confirmation',[
                            'class'=>'password2 form-control',
                        ]) !!}
                        <i class="show-pass2 fa fa-eye fa-1x"></i>
                    </div>
                    <div class="form-group">
                        <label for="roles_list">{{__('messages.Roles list')}}</label>
                        {!! Form::select('roles_list[]',$roles,null,[
                            'class'=>'form-control',
                            'multiple'=>'multiple'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
    @push('showpassword')
        <script>
            $(document).ready(function(){
                $(".show-pass1").hover(function(){
                    $('.password1').attr('type','text');
                },function(){
                    $('.password1').attr('type','password');
                });
                $(".show-pass2").hover(function(){
                    $('.password2').attr('type','text');
                },function(){
                    $('.password2').attr('type','password');
                });
            });
        </script>
    @endpush
@endsection

