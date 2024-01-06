@extends('master')

@section('master','aktif')
@section('store','active')
@section('judul','Store Information')

@section('konten')
    <div class="col-md-10" style="text-align:center;margin:0 auto;">
        <div class="card card-profile">
        <div class="card-body">
            <h6 class="card-category text-gray">Store Description</h6>
            <table class="table-description">
                <tr>
                    <th class="card-title">Nama Instansi</th>
                    <td class="card-description">{{$store->name}}</td>
                </tr>
                <tr>
                    <th class="card-title">No. Telp</th>
                    <td class="card-description">{{$store->phone}}</td>
                </tr>
                <tr>
                    <th class="card-title">Alamat</th>
                    <td class="card-description">{{$store->address}}</td>
                </tr>
            </table>
            <a href="{{route('store.edit')}}" class="btn btn-primary btn-round" style="margin-bottom:10px;">Edit</a>
        </div>
        </div>
    </div>
@endsection
