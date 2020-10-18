@extends('master')
@section('inventory','aktif')
@section('judul',"Stock Minimum & PPN")
@section('stock',"active")
@section('konten')
<div class="row" style="justify-content:center;">
    <div class="col-md-5">
            <div class="card card-plain">
            <div class="card-header card-header-warning">
                <h4 class="card-title mt-0" style="display:inline">Minimum Stock</h4>
                <a href="{{route('inventory.config.stock.add')}}" style="float:right;color:white;margin-top:12px;margin-right:7px;">
                    <i class="material-icons" style="color:white;margin-right:5px;margin-bottom:3px">add_circle</i>Add Min. Stock</a>
                <p class="card-category">List of Minimum Stock</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="">
                    <th>
                        ID
                    </th>
                    <th>
                        Minimum Stock
                    </th>
                    <th>
                        Actions
                    </th>
                    </thead>
                    <tbody>
                        @foreach($stock as $s)
                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->name}}</td>
                                <td>
                                  <a href="{{route('inventory.config.stock.edit',$s->id)}}"><i class="material-icons" style="font-size:20px">edit</i></a>
                                  <a href="{{route('inventory.config.stock.delete',$s->id)}}" style="margin-left:10px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
            <div class="card card-plain">
            <div class="card-header card-header-warning">
                <h4 class="card-title mt-0" style="display:inline">PPN</h4>
                <a href="{{route('inventory.config.ppn.add')}}" style="float:right;color:white;margin-top:12px;margin-right:7px;">
                    <i class="material-icons" style="color:white;margin-right:5px;margin-bottom:3px">add_circle</i>Add PPN</a>
                <p class="card-category">List of PPN</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="">
                    <th>
                        ID
                    </th>
                    <th>
                        PPN
                    </th>
                    <th>
                        Actions
                    </th>
                    </thead>
                    <tbody>
                        @foreach($ppn as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->name.'%'}}</td>
                                <td>
                                    <a href="{{route('inventory.config.ppn.edit',$p->id)}}"><i class="material-icons" style="font-size:20px">edit</i></a>
                                    <a href="{{route('inventory.config.ppn.delete',$p->id)}}" style="margin-left:10px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
