@extends('layouts.app')

@section('content')
@section('page_title')
    {{__('messages.Details of Order Number')}} {{$records->id}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('messages.details of order')}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <div class="print-area">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-info">
                                <th class="text-center">{{__('messages.Order ID')}}</th>
                                <th class="text-center">{{__('messages.Blood_Type')}}</th>
                                <th class="text-center">{{__('messages.Client Name')}}</th>
                                <th class="text-center">{{__('messages.Age')}}</th>
                                <th class="text-center">{{__('messages.Bags_Number')}}</th>
                                <th class="text-center">{{__('messages.Hospital_name')}}</th>
                                <th class="text-center">{{__('messages.Hospital_address')}}</th>
                                <th class="text-center">{{__('messages.Longitude')}}</th>
                                <th class="text-center">{{__('messages.Latitude')}}</th>
                                <th class="text-center">{{__('messages.Phone')}}</th>
                                <th class="text-center">{{__('messages.City_Name')}}</th>
                                <th class="text-center">{{__('messages.Notice')}}</th>
                                <th class="text-center">{{__('messages.Edit')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{$records->id}}</td>
                                <td class="text-center">{{$records->bloodType->name}}</td>
                                <td class="text-center">{{$records->client->name}}</td>
                                <td class="text-center">{{$records->age}}</td>
                                <td class="text-center">{{$records->bags_number}}</td>
                                <td class="text-center">{{$records->hospital_name}}</td>
                                <td class="text-center">{{$records->hospital_address}}</td>
                                <td class="text-center">{{$records->longitude}}</td>
                                <td class="text-center">{{$records->latitude}}</td>
                                <td class="text-center">{{$records->phone}}</td>
                                <td class="text-center">{{$records->city->name}}</td>
                                <td class="text-center">{{$records->notice}}</td>
                                <td class="text-center">
                                    <a href="{{url(route('order.edit',$records->id))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i> {{__('messages.Edit')}}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{url(route('order.index'))}}" class="btn btn-sm btn-primary">{{__('messages.Back')}} <i class="fa fa-backward"></i></a>
                <button class="btn btn-sm btn-success" id="print-btn">{{__('messages.Print')}} <i class="fa fa-print"></i></button>
            </div>
        </div>
    </div>
</section>
@push('print-order')
    <script>
        $(document).ready(function(){
            $(document).on('click','#print-btn',function () {
                $('.print-area').printThis();
                // window.print();
            });
        });
    </script>
@endpush
@endsection
