@extends('master')
@section("report","aktif")
@section("judul", "Transaction Reports")
@section("style")
    <style>
        .midtxt{
            text-align:center;
        }
        table{
            border:1px solid #ddd;
        }
        th, td{
            border-left:1px solid;
        }
        @page{
            margin:0;
            size:400mm 400mm;
        }

        @media print{
            * {
                visibility:hidden;
            }
            #report-print, #report-print *{
                visibility : visible;
                -webkit-print-color-adjust: exact !important;
            }
            #report-print{
                position:absolute;
                left : -200;
                top: 0;
                width:1350px;
            }
        }
    </style>
@endsection
@section("konten")
<div class="col-md-12">
    <div class="card" id="report-print">
        <div class="card-header card-header-danger">
            <h4 class="card-title mt-0" style="display:inline">Reports</h4>
            <p class="card-category">List of transaction report</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>
                        No
                    </th>
                    <th>
                        ID Invoice
                    </th>
                    <th>Product Name</th>
                    <th colspan="2" style="text-align:center;">Price</th>
                    <th colspan="2" style="text-align:center;">Quantity</th>
                    <th>Discount</th>
                    <th>Add. Discount</th>
                    <th>Total Discount</th>
                    <th>Total Price</th>
                    <th>Cash</th>
                    <th>Change</th>
                    <th>Date</th>
                    <th>Time</th>
                </thead>
                <tbody>
                    <?php $i = 0 ;?>
                    @foreach($report as $r)
                        <?php $index1 = 0; $index2 =0; $rowspan=0;?>
                        @for ($index = 0; $index < count($name); $index++)
                            @if($name[$index]["id_invoice"] == $r->id_invoice)
                                <?php $index1 = $index?>
                                @for($new_index = $index1; $new_index < count($name); $new_index++)
                                    @if($name[$new_index]["id_invoice"] != $r->id_invoice)
                                        <?php $index2 = $new_index?>
                                        @break
                                    @endif
                                @endfor
                                @break
                            @endif
                        @endfor
                        @if($index1 == count($name) - 1 && $index2 == 0)
                            <?php $rowspan = 1;?>
                        @elseif($index1 == 0 && $index2 == 0)
                            <?php $rowspan = count($name)?>
                        @elseif($index2 == 0 && $index1 > $index2)
                            <?php $rowspan = count($name) - $index1?>
                        @else
                            <?php $rowspan = $index2 - $index1;?>
                        @endif
                        @if($i < count($name))
                        <tr>
                            <tr>
                                <td rowspan="{{$rowspan}}">{{$loop->iteration}}</td>
                                <td rowspan="{{$rowspan}}">{{$r->id_invoice}}</td>
                                <td class="midtxt">{{$name[$i]["name"]}}</td>
                                <td style="text-align:center;">@IndoCurrency($price[$i]["price"])</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->price)</td>
                                <td class="midtxt">{{$quantity[$i]["quantity"]}}</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">{{$r->quantity}}</td>
                                <td class="midtxt">@IndoCurrency($discount[$i]["discount"])</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->add_discount)</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->discount + $r->add_discount)</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->price * $r->quantity - ($r->discount + $r->add_discount))</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->cash)</td>
                                <td rowspan="{{$rowspan}}" class="midtxt">@IndoCurrency($r->change_cash)</td>
                                <td rowspan="{{$rowspan}}">{{$r->date}}</td>
                                <td rowspan="{{$rowspan}}">{{$r->time}}</td>
                            </tr>
                        </tr>
                        @endif
                        @for ($i+=1;$i < count($name);$i++)
                            @if($name[$i]["id_invoice"] == $r->id_invoice)
                                <tr>
                                    <td class="midtxt">{{$name[$i]["name"]}}</td>
                                    <td class="midtxt">@IndoCurrency($price[$i]["price"])</td>
                                    <td class="midtxt">@IndoCurrency($quantity[$i]["quantity"])</td>
                                    <td class="midtxt">{{$discount[$i]["discount"]}}</td>
                                </tr>
                            @else
                                @break
                            @endif
                        @endfor
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
    <button type="button" class="btn btn-primary" id="report-print-btn" style="margin-left:12px;"><i class="material-icons">print</i> Print</button>
@endsection

@section("script")
        <script>
            $("#report-print-btn").on("click",function(){
                window.print();
            });
        </script>
@endsection

