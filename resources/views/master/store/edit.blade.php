@extends('master')

@section('master','aktif')
@section('store','active')
@section('judul','Store Information')

@section('konten')
    <div class="container-fluid">
        <form action="{{route('store.update')}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Store Description</h4>
                            <p class="card-category">Edit your store Information</p>
                        </div>
                        <div class="card-body">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Name of Agency</label>
                                        <input type="text" class="form-control" name="name" value="{{$store->name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{$store->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$store->address}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Edit Information</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('input#file-profile:hidden')[0].addEventListener('click',function(e){
                e.stopPropagation();
            },false);
        })
    </script>
@endsection
