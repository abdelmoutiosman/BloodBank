@extends('layouts.app')
@inject('bloodtypes', 'App\Models\BloodType')
@inject('clients', 'App\Models\Client')
@inject('cities', 'App\Models\City')
@section('content')
    @section('page_title')
       Edit Orders
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form TO Edit Orders</h3>
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
                        <label for="blood_type_id">blood_type_name</label>
                        {!! Form::select('blood_type_id',$bloodtypes->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="client_id">client_name</label>
                        {!! Form::select('client_id',$clients->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="age">age</label>
                        {!! Form::number('age',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="bags_number">bags_number</label>
                        {!! Form::number('bags_number',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="hospital_name">hospital_name</label>
                        {!! Form::text('hospital_name',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="hospital_address">hospital_address</label>
                        {!! Form::text('hospital_address',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="longitude">longitude</label>
                        {!! Form::number('longitude',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="latitude">latitude</label>
                        {!! Form::number('latitude',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        {!! Form::text('phone',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="city_id">city_name</label>
                        {!! Form::select('city_id',$cities->pluck('name','id'),null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="notice">notice</label>
                        {!! Form::text('notice',null,[
                            'class'=>'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit"><i class="fa fa-edit btn-xs"></i> Edit Order</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
