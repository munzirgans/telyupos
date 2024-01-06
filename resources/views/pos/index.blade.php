@extends('master')
@section("pos","aktif")
@section("judul", "Point of Sale")
@section("style")
    <style>
        @page {
            margin:0;
            size: 80mm 120mm;
        }
        @media print{
            * {
                visibility :hidden;
            }
            html,body {
                overflow:hidden;
                height:100%;
            }
            .print, .print * {
                visibility : visible;
            }
            .print {
                position: absolute;
                left:-10;
                top:-40;
                display:block;
                height:120mm;
            }
        }
    </style>
@endsection
@section('konten')
    <div style="margin-left:10px;margin-right:10px;">
        <div class="card card-plain">
            <div class="card-header card-header-success">
                <h4 class="card-title mt-0">Point of Sale TEL-U</h4>
                <p class="card-category">Point of Sale (POS)</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div style="margin:15px;">
                            <h4 style="font-weight:bold;">Profil Kasir</h4>
                            <h5 style="margin-top:20px;">Nama
                                <input type="text" class="form-control" style="float:right;width:200px;height:30px;padding-left:10px;" value="{{$name}}"readonly>
                            </h5>
                            <h5 style="margin-top:20px;">Tanggal
                                <input type="text" class="form-control" style="float:right;width:200px;height:30px;padding-left:10px;" value="{{$now}}"readonly>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div style="margin:15px;">
                            <h4 style="font-weight:bold;">Pilih Produk</h4>
                            <h5 style="margin-top:20px;">Barcode
                                <div style="float:right;">
                                    <input type="text" class="form-control" id="barcode" style="float:left;width:147px;height:30px;padding-left:10px;" readonly>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#productModal" style="width:50px;margin-top:0px;margin-left:2px;padding-bottom:9px;padding-left:0px;"><i class="material-icons" style="margin:-4px 17px;">search</i></button>
                                </div>
                            </h5>
                            <div class="modal fade bd-example-sm" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width:800px;">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="productModalLabel" style="font-weight:bold;">Add Products</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-header card-header-primary" style="margin-top:5px;">
                                            <h4 class="card-title mt-0">List of Products</h4>
                                            <p class="card-category">List of the registered products</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Barcode</th>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Stock</th>
                                                        <th>Actions</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($product as $p)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$p->barcode}}</td>
                                                            <td>{{$p->name}}</td>
                                                            <td style="text-align:right;">{{$p->selling_price}}</td>
                                                            <td>{{$p->stock}}</td>
                                                            <td>
                                                                <button  type="button" class="btn btn-info selectProduct" data-dismiss="modal" style="width:80px;height:30px;padding-left:5px;">
                                                                    <p style="margin-top:-5px;"><i class="material-icons">check</i> Select</p>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <h5 style="margin-top:20px;">Quantity
                                <input type="number" class="form-control" style="float:right;width:200px;height:30px;">
                            </h5>
                            <button id="addProduct" class="btn btn-success pull-right" style="width:150px;padding-left:20px;"><i class="material-icons">add</i> Add Product</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom:10px;">
                    <div class="card">
                        <div style="margin:15px;">
                            <h4 style="font-weight:bold;">Total Tagihan</h4>
                            <div style="text-align:right;">
                                <h2 style="font-weight:bold;" id="invoice">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header card-header-primary" style="margin-top:5px;">
                <h4 class="card-title mt-0">List of Items</h4>
                <p class="card-category">List of items to be purchased</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="listproduct">
                        <thead>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </thead>
                        <tbody id="product-value">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div style="margin:15px">
                            <h4 style="font-weight:bold;">Detail Harga</h4>
                            <h5 style="margin-top:20px;">Sub Total
                                <input type="text" class="form-control" style="float:right;width:200px;height:30px;padding-left:10px;" id="subtotal" readonly>
                            </h5>
                            <h5 style="margin-top:20px;">Discount
                                <input type="number" class="form-control" style="float:right;width:200px;height:30px;" id="discount">
                            </h5>
                            <h5 style="margin-top:20px;">Total
                                <input type="text" class="form-control" style="float:right;width:200px;height:30px;padding-left:10px;" id="total" readonly>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div style="margin:15px;">
                            <h4 style="font-weight:bold">Detail Cash</h4>
                            <h5 style="margin-top:20px;">Cash
                                <input type="number" class="form-control" style="float:right;width:200px;height:30px;" id="cash">
                            </h5>
                            <h5 style="margin-top:20px;">Kembalian
                                <input type="text" class="form-control" style="float:right;width:200px;height:30px;padding-left:10px" id="kembalian" readonly>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="margin-top:88px;">
                        <button class="btn btn-warning" style="width:100px;padding-left:20px;" id="reset"><i class="material-icons">refresh</i> Reset</button>
                        <button class="btn btn-success" style="width:200px;padding-left:23px;"id="payment"><i class="material-icons" style="margin-right:2px;">flight_takeoff</i> Payment Process</button>
                </div>
                <div class="modal fade bd-example-sm" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="max-width:300px;">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel" style="font-weight:bold;">Edit Products</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Barcode</h5>
                            <input type="text" class="form-control" readonly style="margin-top:-10px;padding-left:10px;">
                            <h5 style="margin-top:12px;">Product Name</h5>
                            <input type="text" class="form-control" style="margin-top:-10px;padding-left:10px;" readonly>
                            <h5 style="margin-top:12px;">Price</h5>
                            <input type="text" class="form-control" style="margin-top:-10px;padding-left:10px;" readonly>
                            <h5 style="margin-top:12px;">Quantity</h5>
                            <input type="number" class="form-control" style="margin-top:-10px;padding-left:10px;" id="qtyEditModal">
                            <h5 style="margin-top:12px;">Discount</h5>
                            <input type="text" class="form-control" style="margin-top:-10px;padding-left:10px;" readonly>
                            <h5 style="margin-top:12px;">Total</h5>
                            <input type="text" class="form-control" style="margin-top:-10px;padding-left:10px;" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" style="padding-left:20px;" id="updateModal"><i class="material-icons">check</i> Update</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="strukModal" tabindex="-1" role="dialog" aria-labelledby="strukModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <i class="material-icons text-success" style="font-size:32px;padding-top:5px;display:inline;margin-left:140px;">done_all</i>
                        <h5 class="modal-title text-success" id="strukModalLabel" style="font-weight:bold;font-size:30px;margin-left:-140px;">Success</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:0">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row" style="margin-left:100px;margin-right:100px;">
                            <h5 style="margin-right:5px;">Invoice</h5>
                        </div>
                        <div style="box-shadow: 3px 4px 21px 2px rgba(220,220,220,1);margin-left:50px;margin-right:50px;padding:10px;" class="print">
                            <div style="font-family:Merchant-Copy">
                                <div style="text-align:center;font-size:20px;text-transform:uppercase;margin-top:5px;">
                                    <p style="margin-bottom:0px;text-transform:none;">Point of Sale</p>
                                    <p style="margin-bottom:10px;">{{$store->name}}</p>
                                    <p style="margin-bottom:0px;">{{$store->address}}</p>
                                    <p style="margin-bottom:0px">{{$store->phone}}</p>
                                    <p style="margin-top:-5px;margin-bottom:0px;margin-left:-5px;">=============================================</p>
                                </div>
                                <div style="text-align:left;font-size:20px;margin-left:10px;margin-right:10px;">
                                    <p style="float:right;margin-bottom:0px;margin-right:5px;">{{$now." ".$time}}</p>
                                    <p style="margin-bottom:0px;">=============================================</p>
                                </div>
                                <div style="margin-left:25px;font-size:20px;">
                                    <div id="struk-val">
                                    </div>
                                    <p style="margin-left:-15px;margin-top:-15px;margin-bottom:0px;">---------------------------------------------</p>
                                    <div id="total-struk">
                                    </div>
                                    <p style="margin-left:-15px;margin-bottom:0px;">=============================================</p>
                                    <div class="row">
                                        <div style="width:165px;">
                                            <p style="margin-bottom:2px;">Kasir : Muhammad Munzir</p>
                                        </div>
                                        <p style="margin-left:25px;margin-bottom:2px;width:130px;text-align:right;">No : 081220304127</p>
                                    </div>
                                    <p style="margin-left:-15px;margin-bottom:5px;">---------------------------------------------</p>
                                    <p style="text-align:center;margin-left:-25px;margin-bottom:0px;">Terima Kasih</p>
                                    <p style="text-align:center;margin-left:-25px;margin-bottom:0px;">Telah Berbelanja Di Toko Kami</p>
                                    <div class="row" style="margin:0 auto;">
                                        <p>Saran & Kritik Hubungi Kami : 081220304127</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="print-btn"><i class="material-icons">print</i> Print</button>
                    </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        function rupiahFormat(bilangan){
            var	reverse = bilangan.toString().split('').reverse().join(''),
                ribuan 	= reverse.match(/\d{1,3}/g);
                ribuan	= ribuan.join(',').split('').reverse().join('');
            return ribuan;
        };
        function backtoint(number){
            var angka = number.replace(",","");
            return angka;
        }
        $(document).ready(function(){
            var total = 0;
            var content_len = 0;
            var observer = new MutationObserver(function(e){
                if($("#product-value").children("tr").length < content_len){
                    $("#product-value").children("tr").each(function(i){
                        i += 1;
                        $(this).children("td").eq(0).text(i);
                    });
                }
                var table_content = $("#product-value").children("tr");
                if (table_content.length > 1){
                    var total_temp = 0;
                    $(table_content).each(function(i){
                        total_temp += +$(this).children("td").eq(5).text();
                    });
                    total = total_temp;
                } else {
                    total = +$(table_content).eq(0).children("td").eq(5).text();
                }
                $("#invoice").text(rupiahFormat(total));
                $("#subtotal").val(total);
                $("#total").val(total);
                if ($("#kembalian").val() != ""){
                    $("#kembalian").val(rupiahFormat(+$("#total").val() - +$("#cash").val()));
                }
                content_len = $("#product-value").children("tr").length;
            });
            observer.observe($("#product-value").get(0),{childList:true,subtree:true});
            $("#cash").on("keyup",function(){
                if($(this).val() != ""){
                    $("#kembalian").val(rupiahFormat(+$("#total").val() - +$(this).val()));
                    if (+$("#total").val() > +$(this).val()){
                        $("#kembalian").val("-"+$("#kembalian").val());
                    }
                } else {
                    $("#kembalian").val("");
                }
            })
            $("#discount").on("keyup",function(){
                if($(this).val() != ""){
                    $("#invoice").text(rupiahFormat(total - +$(this).val()));
                    $("#total").val(total - +$(this).val());
                    if($("#kembalian").val() != ""){
                        $("#kembalian").val(rupiahFormat(+$("#total").val() - +$("#cash").val()));
                    }else {
                        $("#kembalian").val("");
                    }
                }else {
                    $("#invoice").text(rupiahFormat(total));
                    $("#total").val(total);
                }
            });
            $('.selectProduct').on("click",function(){
                var barcode = $(this).parents("tr").children("td").eq(1).text();
                $('#barcode').val(barcode);
            });
            $("#reset").on("click",function(){
                location.reload();
            });
            $("#product-value").on("click",".editProductModal",function(){
                var product = $(this).parent().parent().children("td");
                var barcode = $(product).eq(1).text();
                var name = $(product).eq(2).text();
                var price = $(product).eq(3).text();
                var qty = $(product).eq(4).text();
                var total = $(product).eq(5).text();
                var modalProduct = $('#editModal').find(".modal-body");
                var modalValue = $(modalProduct).children("input");
                $(modalValue).eq(0).val(barcode);
                $(modalValue).eq(1).val(name);
                $(modalValue).eq(2).val(price);
                $(modalValue).eq(3).val(qty);
                $(modalValue).eq(5).val(total);
            });
            $("#qtyEditModal").on("keyup",function(){
                if ($(this).val() != ""){
                    var input = $(this).parent().children("input");
                    $(input).eq(5).val((+$(input).eq(2).val() * +$(this).val() - +$(input).eq(4).val()));
                }
            });
            $("#updateModal").on("click",function(){
                var barcode = $(this).parent().prev().children("input").eq(0).val();
                var quantity = $(this).parent().prev().children("input").eq(3).val();
                var total = $(this).parent().prev().children("input").eq(5).val();
                $("#product-value").children("tr").each(function(i){
                    var tbarcode = $(this).children("td").eq(1);
                    if ($(tbarcode).text() == barcode){
                        $(this).children("td").eq(4).text(quantity);
                        $(this).children("td").eq(5).text(total);
                        return false;
                    }
                });
            });
            $("#product-value").on("click",".deleteProduct",function(){
                $(this).parent().parent().remove();
            });
            $("#payment").on("click",function(){
                var barcode_arr = [];
                var name_arr = [];
                var price_arr = [];
                var qty_arr = [];
                var discount_arr = [];
                var via = "Point of Sale";
                for (var i = 0; i < $("#product-value").children("tr").length; i++){
                    barcode_arr.push($("#product-value").children("tr").eq(i).children("td").eq(1).text())
                    name_arr.push($("#product-value").children("tr").eq(i).children("td").eq(2).text());
                    price_arr.push($("#product-value").children("tr").eq(i).children("td").eq(3).text());
                    qty_arr.push($("#product-value").children("tr").eq(i).children("td").eq(4).text());
                    discount_arr.push($("#product-value").children("tr").eq(i).children("td").eq(5).text());
                }
                $.ajax({
                    url : "{{route('report.store')}}",
                    method : "post",
                    data : {
                        "_token" : "{{csrf_token()}}",
                        "name" : name_arr,
                        "quantity" : qty_arr,
                        "price" : price_arr,
                        "discount" : discount_arr,
                        "add_discount" : $("#discount").val(),
                        "cash" : $("#cash").val(),
                        "kembalian" : $("#kembalian").val()
                    },
                });
                $.ajax({
                    url : "{{route('inventory.outgoing-item.store')}}",
                    method:"post",
                    data : {
                        "_token" : "{{csrf_token()}}",
                        "barcode" : barcode_arr,
                        "name" : name_arr,
                        "quantity" : qty_arr,
                        "via" : via
                    },
                    success : function(data){
                        console.log(data);
                    }
                });
                var content = '';
                var qty = 0;
                var discount = 0;
                $("#product-value").children("tr").each(function(i){
                    content += `<div class="row"><div style="width:175px;"><p>`+$(this).children("td").eq(2).text()+`</p></div><div style="width:30px;margin-left:0px;px;margin-right:5px;text-align:right;"><p>`+ $(this).children("td").eq(4).text() +`</p></div><div style="width:107px;text-align:right;"><p>`+`Rp. `+rupiahFormat(+$(this).children("td").eq(5).text())+`</p></div></div>`;
                    discount += +$(this).children("td").eq(5).text();
                    qty += +$(this).children("td").eq(4).text();
                });
                discount += +$("#discount").val();
                $("#total-struk").html(`<div class="row"><div style="width:175px;"><p style="margin-bottom:2px;">Total Discount</p></div><div style="width:110px;text-align:right;margin-left:32px;"><p style="margin-bottom:2px;">Rp. `+rupiahFormat(discount)+`</p></div></div><div class="row"><div style="width:175px;"><p style="margin-bottom:2px;">Total</p></div><div style="width:30px;margin-left:0px;px;margin-right:5px;text-align:right;"><p style="margin-bottom:2px;">`+qty+`</p></div><div style="width:107px;text-align:right;"><p style="margin-bottom:2px;">Rp. `+rupiahFormat($("#total").val())+`</p></div></div><div class="row"><div style="width:175px;"><p style="margin-bottom:2px;">Cash</p></div><div style="width:110px;text-align:right;margin-left:32px;"><p style="margin-bottom:2px;">Rp. `+rupiahFormat($("#cash").val())+`</p></div></div><div class="row"><div style="width:175px;"><p style="margin-bottom:2px;">Kembalian</p></div><div style="width:110px;text-align:right;margin-left:32px;"><p style="margin-bottom:2px;">Rp. `+rupiahFormat($("#kembalian").val())+`</p></div>`);
                $("#struk-val").html(content);
                $("#strukModal").modal("show");
            });
            $("#print-btn").on("click",function(){
                window.print();
            });
            $('#addProduct').on("click",function(){
                var qty = $(this).prev("h5").children("input");
                if ($(qty).val() == ""){
                    $(qty).val(1);
                }
                $.ajax({
                    url : "{{route('inventory.product.barcodedata')}}",
                    method: "POST",
                    data : {
                        "_token" : "{{csrf_token()}}",
                        "barcode" : $("#barcode").val(),
                    },
                    success : function(data){
                        var index = +$('#product-value').children("tr").last().children("td").first().text().trim();
                        if (index == ""){
                            index = 1;
                        } else {
                            index += 1;
                        }
                        $(data).each(function(i,value){
                            var content = $("#product-value").children("tr");
                            var product_index;
                            if (content.length > 0){
                                $(content).each(function(xx){
                                    if (value.barcode == $(this).children("td").eq(1).text().trim()){
                                        product_index = xx;
                                        return false;
                                    }
                                });
                                if (typeof product_index == "undefined"){
                                    console.log('tset1');
                                    $('#listproduct').append(`<tr><td>`+index+`</td><td>`+value.barcode+`</td><td>`+value.name+`</td><td>`+value.selling_price+`</td><td>`+qty.val()+`</td><td>`+(value.selling_price * qty.val())+`</td><td><a href="javascript:void(0)" class="editProductModal" data-toggle="modal" data-target="#editModal"><i class="material-icons" style="margin-right:5px;">edit</i></a><a class="deleteProduct" href="javascript:void(0)"><i class="material-icons" style="color:red;margin-left:5px;">delete</i></a></td></tr>`);
                                } else {
                                    console.log('test2')
                                    $(content).eq(product_index).children('td').eq(4).text(+$(content).eq(product_index).children('td').eq(4).text() + +$(qty).val());
                                    $(content).eq(product_index).children("td").eq(5).text(
                                        +$(content).eq(product_index).children("td").eq(3).text() * +$(content).eq(product_index).children("td").eq(4).text()
                                    );
                                }
                            } else{
                                console.log('test3')
                                $('#listproduct').append(`<tr><td>`+index+`</td><td>`+value.barcode+`</td><td>`+value.name+`</td><td>`+value.selling_price+`</td><td>`+qty.val()+`</td><td>`+(value.selling_price * qty.val())+`</td><td><a href="javascript:void(0)" class="editProductModal" data-toggle="modal" data-target="#editModal"><i class="material-icons" style="margin-right:5px;">edit</i></a><a class="deleteProduct" href="javascript:void(0)"><i class="material-icons" style="color:red;margin-left:5px;">delete</i></a></td></tr>`);
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
