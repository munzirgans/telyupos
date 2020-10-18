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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Name of Agency</label>
                                        <input type="text" class="form-control" name="name" value="{{$store->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="{{$store->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{$store->postal_code}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$store->address}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <div class="form-group">
                                            <textarea name="description" rows="4" class="form-control">{{$store->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Edit Information</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                        <div class="card-avatar" style="margin:50px auto 30px;box-shadow: 0px 1px 46px -10px rgba(194,194,194,1);">
                            <img src="{{asset('img/'.$store->photo)}}" id="image-profile">
                        </div>
                        <h4 style="padding-left:70px;padding-right:70px;margin-bottom:20px;">Change Your Store Profile Picture</h4>
                        <div class="row">
                            <label class="btn btn-primary" style="margin:0 auto;margin-bottom:30px;">
                                <input id="file-profile" type="file" style="display:none;" name="photo">Select Image
                            </label>
                            <button type="button"class="btn btn-primary" id="cancel-profile" style="margin-left:auto;margin-right:auto;margin-bottom:30px;back;background-image:linear-gradient(60deg, rgb(239, 83, 80), rgb(229, 57, 53));display:none;"><i class="material-icons">cancel</i> Cancel</button>
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
            $('#cancel-profile').click(function(){
                $('#image-profile').attr('src','{{asset("img/".$store->photo)}}');
                $(this).css('display','none');
                $('#file-profile').parent().css('display','block');
            });
        })
    </script>
@endsection
