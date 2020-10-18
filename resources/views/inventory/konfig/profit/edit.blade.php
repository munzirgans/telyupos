@extends('master')
@section('inventory','aktif')
@section('judul',"Percent of Profit")
@section('profit',"active")
@section('konten')
<div class="col-md-7" style="margin:0 auto;">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit The Profit</h4>
                <p class="card-category">Edit the profit into your system</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.config.profit.update',$profit->id)}}">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">Profit Percent</label>
                        <input type="text" class="form-control" name="profit" value="{{$profit->name}}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Edit Profit</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
