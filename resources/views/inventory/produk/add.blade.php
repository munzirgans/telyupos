@extends('master')
@section('inventory','aktif')
@section('produk','active')
@section('judul','Product Master')

@section('konten')
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Add The Product</h4>
            <p class="card-category">Register some product into your system</p>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('inventory.product.store')}}">
                {{csrf_field()}}
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="bmd-label-floating">Barcode</label>
                    <input type="text" class="form-control" name="barcode">
                    </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="bmd-label-floating" style="display:block;">Category</label>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$category[0]->name}}
                        </button>
                        <div class="dropdown-menu">
                            @foreach($category as $c)
                                <a class="dropdown-item category" href="#">{{$c->name}}</a>
                            @endforeach
                        </div>
                        <input type="hidden" class="form-control" name="category">
                    </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Stock</label>
                    <input type="text" class="form-control" name="stock">
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating" style="display:block;">Currency</label>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$currency[0]->name}}</button>
                    <div class="dropdown-menu">
                        @foreach($currency as $c)
                            <a class="dropdown-item curr" href="#">{{$c->name}}</a>
                        @endforeach
                    </div>
                    <input type="hidden" class="form-control" name="curr">
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Purchase Price</label>
                    <input type="number" class="form-control purchase" name="purchase" style="margin-top:7px;">
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="bmd-label-floating">Selling Price</label>
                        <div>
                            <input class="form-control selling" type="text" style="display:inline;width:200px;padding-left:10px;" name="selling" readonly>
                            <button type="button" class="btn btn-primary dropdown-toggle selling-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$profit[0]->name."%"}}</button>
                            <div class="dropdown-menu">
                                @foreach($profit as $p)
                                    <a class="dropdown-item" href="#">{{$p->name.'%'}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Discount</label>
                    <input type="number" class="form-control" name="discount" style="margin-top:7px;">
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating" style="display:block;">Unit</label>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$unit[0]->name}}
                    </button>
                    <div class="dropdown-menu">
                        @foreach($unit as $u)
                            <a class="dropdown-item unit" href="#">{{$u->name}}</a>
                        @endforeach
                    </div>
                    <input type="hidden" class="form-control" name="unit">
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Add Product</button>
            <div class="clearfix"></div>
            </form>
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
            var decision = "";
            $('.dropdown-menu').slice(1).children(".dropdown-item").each(function(i){
                if ($(this).attr('class').split(" ").length == 2){
                    var name_attr = $(this).attr('class').split(" ")[1];
                    if (decision != name_attr){
                        $("input[name="+name_attr+"]:hidden").attr('value',$(this).text());
                    }
                    decision = name_attr;
                }
            });
        })
    </script>
@endsection
