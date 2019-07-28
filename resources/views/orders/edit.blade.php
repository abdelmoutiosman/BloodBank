@extends('layouts.app')
@inject('bloodtypes', 'App\Models\BloodType')
@inject('clients', 'App\Models\Client')
@inject('cities', 'App\Models\City')
@section('content')
    @section('page_title')
        {{__('messages.Edit Order')}}
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('messages.Form TO Edit Order')}}</h3>
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
                        'action'=>['OrderController@update',$model->id],
                        'method'=>'put'
                    ]) !!}
                    <div class="form-group">
                        <label for="blood_type_id">{{__('messages.Blood_Type')}}</label>
                        {!! Form::select('blood_type_id',$bloodtypes->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="client_id">{{__('messages.Client Name')}}</label>
                        {!! Form::select('client_id',$clients->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="age">{{__('messages.Age')}}</label>
                        {!! Form::number('age',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="bags_number">{{__('messages.Bags_Number')}}</label>
                        {!! Form::number('bags_number',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="hospital_name">{{__('messages.Hospital_name')}}</label>
                        {!! Form::text('hospital_name',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="hospital_address">{{__('messages.Hospital_address')}}</label>
                        {!! Form::text('hospital_address',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="longitude">{{__('messages.Longitude')}}</label>
                        {!! Form::number('longitude',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="latitude">{{__('messages.Latitude')}}</label>
                        {!! Form::number('latitude',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('messages.Phone')}}</label>
                        {!! Form::text('phone',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="city_id">{{__('messages.City_Name')}}</label>
                        {!! Form::select('city_id',$cities->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="notice">{{__('messages.Notice')}}</label>
                        {!! Form::text('notice',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit Order')}}</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
