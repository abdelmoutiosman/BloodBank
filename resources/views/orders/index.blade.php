@extends('layouts.app')
@inject('model', 'App\Models\Order')
@section('content')
    @section('page_title')
        {{__('messages.Orders')}}
    @endsection
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('messages.List Of Orders')}}</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                @include('flash::message')
                <div class="filter">
                    {!! Form::open([
                                'action'=>'OrderController@index',
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'GET',
                                ])!!}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::number('id',request()->input('id'),[
                                    'class'=>'form-control',
                                    'placeholder' =>__('messages.Order Number')
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-flat bg-navy btn-block"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                @if(count($records))                                 
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-info">
                                    <th class="text-center">{{__('messages.Order ID')}}</th>
                                    <th class="text-center">{{__('messages.Client Name')}}</th>
                                    <th class="text-center">{{__('messages.Hospital_name')}}</th>
                                    <th class="text-center">{{__('messages.Delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)                              
                                 <tr id="removable{{$record->id}}">
                                    <td class="text-center"><a href="{{url(route('order.show',$record->id))}}" class="btn btn-sm btn-info">{{$record->id}}</a></td>
                                    <td class="text-center">{{$record->client->name}}</td>
                                    <td class="text-center">{{$record->hospital_name}}</td>
                                    <td class="text-center">
                                        {!! Form::model($model,[
                                                'action'=>['OrderController@destroy',$record->id],
                                                'method'=>'delete'
                                            ]) !!}                                          
                                            <button id="{{$record->id}}" data-token="{{ csrf_token() }}"
                                                data-route="{{URL::route('order.destroy',$record->id)}}"
                                                type="button" class="destroy btn btn-danger"><i
                                                class="fa fa-trash-o"></i> {{__('messages.Delete')}}</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$records->appends(request()->query())->links()}}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{__('messages.NoData')}}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
