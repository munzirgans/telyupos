@extends('master')
@section('inventory','aktif')
@section('judul',"Category")
@section('category',"active")

@section('konten')
<div class="col-md-7" style="margin:0 auto;">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add The Category</h4>
                <p class="card-category">Register the category into your system</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('inventory.config.category.store')}}">
                    {{csrf_field()}}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <label class="bmd-label-floating">Category Name</label>
                        <input type="text" class="form-control" name="category">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">Add Category</button>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
