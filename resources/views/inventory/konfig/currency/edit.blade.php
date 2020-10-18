@extends('master')
@section('inventory','aktif')
@section('judul',"Currency")
@section('currency',"active")

@section('konten')
<div class="col-md-7" style="margin:0 auto;">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit The Unit</h4>
                <p class="card-category">Edit the Unit into your system</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.config.unit.update',$unit->id)}}">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">Unit Name</label>
                        <input type="text" class="form-control" name="currency" value="{{$unit->name}}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Edit Unit</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
