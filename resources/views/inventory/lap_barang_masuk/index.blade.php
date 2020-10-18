@extends('master')
@section('inventory','aktif')
@section('judul',"Income Items Report")
@section('income',"active")

@section('konten')
<div class="col-md-9" style="margin:0 auto;">
        <div class="card card-plain">
        <div class="card-header card-header-warning">
            <h4 class="card-title mt-0">Income Items Report</h4>
            <p class="card-category">List of report</p>
        </div>
        <h5 style="margin-bottom:0px; margin-top:10px;margin-left:5px;" id="find">Find by :
            <div class="btn-group" style="margin-left:10px;">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)">All</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)">Date</a>
                    <a class="dropdown-item" href="javascript:void(0)">Time</a>
                    <a class="dropdown-item" href="javascript:void(0)">Date & Time</a>
                </div>
            </div>
        </h5>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
                <thead class="">
                <th>
                    No
                </th>
                <th>
                    Barcode
                </th>
                <th>
                    Name
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Date
                </th>
                <th>Time</th>
                <th>
                    Via
                </th>
                </thead>
                <tbody>
                    @foreach($income as $i)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->barcode}}</td>
                        <td>{{$i->name}}</td>
                        <td>{{$i->quantity}}</td>
                        <td>{{$i->date}}</td>
                        <td>{{$i->time}}</td>
                        <td>{{$i->via}}</td>
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
            $('.dropdown-item').on('click',function(){
                $(this).parent().prev().text($(this).text());
                if ($(this).text() == "Date"){
                    $('.find-content').remove();
                    $(`<div class="find-content"><h5 style="display:inline">From Date :</h5><input type="date" name="" id="" style="margin-left:5px;" value="{{$date}}"><h5 style="display:inline;margin-left:10px;">To :</h5><input type="date" name="" id="" style="margin-left:5px;" value="{{$date2}}"></div><button class="btn btn-primary find-content" style="width:120px;height:40px;margin-top:10px;padding-left:20px;" type="button"><i class="material-icons">search</i>Search</button>`).insertAfter("#find");
                } else if ($(this).text() == "Time"){
                    $('.find-content').remove();
                    $(`<div class="find-content"><h5 style="display:inline;">From Time :</h5><input type="time" value="{{$time}}" style="margin-left:5px;"><h5 style="display:inline;margin-left:10px;">To :</h5><input type="time" value="{{$time2}}" style="margin-left:5px;"></div><button class="btn btn-primary find-content" style="width:120px;height:40px;margin-top:10px;padding-left:20px;" type="button"><i class="material-icons">search</i>Search</button>`).insertAfter('#find');
                } else if ($(this).text() == "Date & Time"){
                    $('.find-content').remove();
                    $(`<div class="find-content"><h5 style="display:inline">From Date :</h5><input type="date" name="" id="" style="margin-left:5px;" value="{{$date}}"><h5 style="display:inline;margin-left:10px;">To :</h5><input type="date" name="" id="" style="margin-left:5px;" value="{{$date2}}"></div><div class="find-content" style="margin-top:10px;"><h5 style="display:inline;">From Time :</h5><input type="time" value="{{$time}}" style="margin-left:5px;"><h5 style="display:inline;margin-left:10px;">To :</h5><input type="time" value="{{$time2}}" style="margin-left:5px;"></div><button class="btn btn-primary find-content" style="width:120px;height:40px;margin-top:10px;padding-left:20px;" type="button"><i class="material-icons">search</i>Search</button>`).insertAfter("#find");
                } else{
                    $('.find-content').remove();
                    $.ajax({
                        url : "{{route('inventory.income-item.alldata')}}",
                        method :"POST",
                        data : {"_token" : "{{csrf_token()}}"},
                        success : function(data){
                            var content = "";
                            $(data).each(function(i){
                                content += `<tr><td>`+(i + 1)+`</td><td>`+ this.barcode + `</td><td>`+this.name+`</td><td>`+this.quantity+`</td><td>`+this.date+`</td><td>`+this.time+`</td><td>`+this.via+`</td></tr>`;
                            });
                            $('table.table').children('tbody').html(content);
                        }
                    })
                }
            });
            $(".card-plain").on("click",'button.find-content',function(){
                var find_text = $("#find").children(".btn-group").children("button").text();
                if (find_text == "Date"){
                    $.ajax({
                        url : "{{route('inventory.income-item.date')}}",
                        method : "POST",
                        data : {"_token" : "{{csrf_token()}}",
                            "from_date" : $('div.find-content').children('input[type=date]').eq(0).val(),
                            "to_date" : $('div.find-content').children('input[type=date]').eq(1).val()
                        },
                        success : function(data){
                            var content = "";
                            $(data).each(function(i){
                                content += `<tr><td>`+(i + 1)+`</td><td>`+ this.barcode + `</td><td>`+this.name+`</td><td>`+this.quantity+`</td><td>`+this.date+`</td><td>`+this.time+`</td><td>`+this.via+`</td></tr>`;
                            });
                            $('table.table').children('tbody').html(content);
                        }
                    });
                } else if (find_text == "Time") {
                    $.ajax({
                        url : "{{route('inventory.income-item.time')}}",
                        method : "POST",
                        data : {"_token" : "{{csrf_token()}}",
                            "from_time" : $('div.find-content').children('input[type=time]').eq(0).val(),
                            "to_time" : $('div.find-content').children('input[type=time]').eq(1).val(),
                        },
                        success : function(data){
                            var content = "";
                            $(data).each(function(i){
                                content += `<tr><td>`+(i + 1)+`</td><td>`+ this.barcode + `</td><td>`+this.name+`</td><td>`+this.quantity+`</td><td>`+this.date+`</td><td>`+this.time+`</td><td>`+this.via+`</td></tr>`;
                            });
                            $('table.table').children('tbody').html(content);
                        }
                    });
                } else if (find_text == "Date & Time"){
                    $.ajax({
                        url : "{{route('inventory.income-item.datetime')}}",
                        method : "POST",
                        data : {"_token" : "{{csrf_token()}}",
                            "from_date" : $('div.find-content').children('input[type=date]').eq(0).val(),
                            "to_date" : $('div.find-content').children('input[type=date]').eq(1).val(),
                            "from_time" : $('div.find-content').children('input[type=time]').eq(0).val(),
                            "to_time" : $('div.find-content').children('input[type=time]').eq(1).val()
                        },
                        success : function(data){
                            var content = "";
                            $(data).each(function(i){
                                content += `<tr><td>`+(i + 1)+`</td><td>`+ this.barcode + `</td><td>`+this.name+`</td><td>`+this.quantity+`</td><td>`+this.date+`</td><td>`+this.time+`</td><td>`+this.via+`</td></tr>`;
                            });
                            $('table.table').children('tbody').html(content);
                        }
                    })
                }
            })
        });
    </script>
@endsection
