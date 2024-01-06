@extends('master')
@section('inventory','aktif')
@section('judul',"Income Items Report")
@section('income',"active")

@section('konten')
<div class="col-md-9" style="margin:0 auto;">
        <div class="card card-plain">
        <div class="card-header card-header-warning">
            <h4 class="card-title mt-0">Income Items Report</h4>
            <p class="card-category">List of report</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
                <thead class="">
                <th>
                    No
                </th>
                <th>
                    Barcode
                </th>
                <th>
                    Name
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Date
                </th>
                <th>Time</th>
                <th>
                    Via
                </th>
                </thead>
                <tbody>
                    @foreach($income as $i)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->barcode}}</td>
                        <td>{{$i->name}}</td>
                        <td>{{$i->quantity}}</td>
                        <td>{{\Carbon\Carbon::parse($i->date)->format("d/m/Y")}}</td>
                        <td>{{\Carbon\Carbon::parse($i->time)->format("h:i:s")}}</td>
                        <td>{{$i->via}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection
