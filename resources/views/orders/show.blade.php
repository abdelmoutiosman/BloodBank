@extends('layouts.app')

@section('content')
@section('page_title')
    Details of Order Number {{$records->id}}
@endsection
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">details of order</h3>
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
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-info">
                            <th class="text-center">Order ID</th>
                            <th class="text-center">Blood_Type_Name</th>
                            <th class="text-center">Client_Name</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Bags_Number</th>
                            <th class="text-center">Hospital_name</th>
                            <th class="text-center">Hospital_address</th>
                            <th class="text-center">Longitude</th>
                            <th class="text-center">Latitude</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">City_Name</th>
                            <th class="text-center">Notice</th>
                            <th class="text-center">Edit</th>
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
                                <a href="{{url(route('order.edit',$records->id))}}" class="btn btn-success"><i class="fa fa-edit btn-xs"></i>
                                    Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{url(route('order.index'))}}" class="btn btn-sm btn-primary">Back <<</a>
                <a href="" class="btn btn-sm btn-success" id="printall">Print <<</a>
            </div>
        </div>
    </div>
</section>
@push('print')
    <script>
        $("#printall").click(function(){
            window.print();
        });
    </script>
@endpush
@endsection
