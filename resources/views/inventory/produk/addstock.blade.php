@extends('master')
@section('inventory','aktif')
@section('judul',"Product Master")
@section('produk',"active")

@section('konten')
<div class="col-md-7" style="margin:0 auto;">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add Stock</h4>
                <p class="card-category">Add stock of one of your products</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.product.stock.update',$product->id)}}">
                    {{csrf_field()}}
                <div class="row">
                    <h5 style="margin-left:17px;margin-top:5px;">Previous Stock : {{$product->stock}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">The amount of stock to be added</label>
                        <input type="number" class="form-control" name="stock">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Add Stock</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
