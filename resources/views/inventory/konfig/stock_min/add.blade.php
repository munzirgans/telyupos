@extends('master')
@section('inventory','aktif')
@section('judul',"Stock Minimum & PPN")
@section('stock',"active")

@section('konten')
<div class="col-md-7" style="margin:0 auto;">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add The Minimum Stock</h4>
                <p class="card-category">Register the minimum stock into your system</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.config.stock.store')}}">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">Minimum Stock</label>
                        <input type="text" class="form-control" name="stock">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Add Minimum Stock</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
