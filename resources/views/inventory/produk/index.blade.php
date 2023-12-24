@extends('master')

@section('inventory','aktif')
@section('produk','active')
@section('judul','Product Master')

@section('konten')
    <div class="col-md-12">
        <div class="card card-plain">
        <div class="card-header card-header-warning">
            <h4 class="card-title mt-0" style="display:inline">Products</h4>
            <a href="{{route('inventory.product.add')}}" style="float:right;color:white;margin-top:12px;margin-right:7px;">
                <i class="material-icons" style="color:white;margin-right:5px;margin-bottom:3px">playlist_add</i>Add Product</a>
            <p class="card-category">List of products </p>
        </div>
        <div class="row justify-content-between">
            <div class="btn-group" style="margin-left:10px;" id="category">
            </div>
            </h5>
            <div class="justify-content-end" style="margin-top:25px;margin-right:20px;">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search..." id="search-form">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon" id="search-btn">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body" style="padding-top:0;">
            <div class="table-responsive">
            <table class="table table-hover">
                <thead class="">
                <th>
                    ID
                </th>
                <th>
                    Barcode
                </th>
                <th>
                    Product Name
                </th>
                <th>Stock</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Actions</th>
                </thead>
                <tbody id="table-val">
                    @foreach($product as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->barcode}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->stock}}</td>
                        <td>{{$p->purchase_price}}</td>
                        <td>{{$p->selling_price}}</td>
                        <td style="display:block;width:100px">
                            <a href="{{route('inventory.product.stock.add',$p->id)}}" style="color:#49a54d;"><i class="material-icons">add</i></a>
                            <a href="{{route('inventory.product.edit',$p->id)}}"><i class="material-icons" style="font-size:20px">edit</i></a>
                            <a href="{{route('inventory.product.delete',$p->id)}}" style="color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#category').children("div").children().on("click",function(){
                var content = "";
                $("#category").children("button").text($(this).text());
                if ($(this).text() != "All"){
                    $.ajax({
                        url : "{{route('inventory.product.data')}}",
                        method : "POST",
                        data :{"category":$(this).text(), "_token":"{{csrf_token()}}"},
                        success : function(data){
                            $(data).each(function(){
                                content += `<tr><td>`+this.id+`</td><td>`+this.barcode+`</td><td>`+this.name+`</td><td>`+this.category+`</td><td>`+this.stock+`</td><td>`+this.curr+`</td><td>`+this.purchase_price+`</td><td>`+this.selling_price+`</td><td>`+this.discount+`</td><td>`+this.unit+`</td><td style="display:block;width:100px"><a href="{{url("inventory/product/edit")}}/`+this.id+`" style="color:#49a54d;"><i class="material-icons">add</i></a><a href="{{url("inventory/product/stock/add")}}/`+this.id+`"><i class="material-icons" style="margin-left:4px;font-size:20px">edit</i></a><a href="{{url("inventory/product/delete")}}/`+this.id+`" style="margin-left:4px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a></td></tr>`;
                            })
                            $("#table-val").html(content);
                        }
                    });
                } else {
                    content = "";
                    $.ajax({
                        url : "{{route('inventory.product.alldata')}}",
                        method :"POST",
                        data : {"_token":"{{csrf_token()}}"},
                        success : function(data){
                            $(data).each(function(){
                                content += `<tr><td>`+this.id+`</td><td>`+this.barcode+`</td><td>`+this.name+`</td><td>`+this.category+`</td><td>`+this.stock+`</td><td>`+this.curr+`</td><td>`+this.purchase_price+`</td><td>`+this.selling_price+`</td><td>`+this.discount+`</td><td>`+this.unit+`</td><td style="display:block;width:100px"><a href="{{url("inventory/product/edit")}}/`+this.id+`" style="color:#49a54d;"><i class="material-icons">add</i></a><a href="{{url("inventory/product/stock/add")}}/`+this.id+`"><i class="material-icons" style="margin-left:4px;font-size:20px">edit</i></a><a href="{{url("inventory/product/delete")}}/`+this.id+`" style="margin-left:4px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a></td></tr>`;
                            });
                            $("#table-val").html(content);
                        }
                    })
                }
            });
            $("#search-btn").on("click",function(){
                $.ajax({
                    url : "{{route('inventory.product.search')}}",
                    method : "POST",
                    data : { '_token' : "{{csrf_token()}}",
                        "name" : $("#search-form").val(),
                    },
                    success : function(data){
                        var content = "";
                        $(data).each(function(){
                            content += `<tr><td>`+this.id+`</td><td>`+this.barcode+`</td><td>`+this.name+`</td><td>`+this.category+`</td><td>`+this.stock+`</td><td>`+this.curr+`</td><td>`+this.purchase_price+`</td><td>`+this.selling_price+`</td><td>`+this.discount+`</td><td>`+this.unit+`</td><td style="display:block;width:100px"><a href="{{url("inventory/product/edit")}}/`+this.id+`" style="color:#49a54d;"><i class="material-icons">add</i></a><a href="{{url("inventory/product/stock/add")}}/`+this.id+`"><i class="material-icons" style="margin-left:4px;font-size:20px">edit</i></a><a href="{{url("inventory/product/delete")}}/`+this.id+`" style="margin-left:4px;color:red;"><i class="material-icons" style="font-size:23px">delete_forever</i></a></td></tr>`;
                        });
                        $("#table-val").html(content);
                    }
                });
            });
        });
    </script>
@endsection
