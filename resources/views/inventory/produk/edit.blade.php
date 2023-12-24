@extends('master')
@section('inventory','aktif')
@section('produk','active')
@section('judul','Product Master')

@section('konten')
<div class="container-fluid">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Edit The Product</h4>
                <p class="card-category">Edit some product that registered in your system</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.product.update',$product->id)}}">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="bmd-label-floating">Barcode</label>
                        <input type="text" class="form-control" name="barcode" value="{{$product->barcode}}" >
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Stock</label>
                        <input type="text" class="form-control" name="stock" value="{{$product->stock}}">
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Purchase Price</label>
                        <input type="text" class="form-control purchase" name="purchase_price" value="{{$product->purchase_price}}" style="margin-top:10px;">
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Selling Price</label>
                        <div>
                            <input class="form-control selling" type="text" style="display:inline;width:200px;padding-left:10px;" name="selling_price" value="{{$product->selling_price}}" readonly>
                        </div>
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Edit Product</button>
                <div class="clearfix"></div>
                </form>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.purchase').on('keyup',function(){
                var percent_profit = $('.selling-button').text().split("%")[0] / 100;
                var subtotal = $(this).val() * percent_profit;
                var total = +$(this).val() + subtotal;
                $(".selling").val(total);
            });
            $('.dropdown-item').on('click',function(){
                $(this).parent().prev().text($(this).text());
                var input_name = $(this).attr('class').split(" ")[1];
                $('input[name='+ input_name +']').attr("value",$(this).text());
            });
            $('.selling-button').next().children().on("click",function(){
                var percent_profit = $(this).text().split("%")[0] / 100;
                var subtotal = percent_profit * $('.purchase').val();
                var total = +$('.purchase').val() + subtotal;
                $('.selling').val(total);
            });
        });
    </script>
@endsection
