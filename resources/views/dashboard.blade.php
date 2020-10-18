@extends('master')

@section('dashboard', 'active')
@section('judul', 'Dashboard')
@section("konten")
    <div class="container-fluid">
        <div class="row" style="justify-content:center;">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Total Produk</h4>
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight:bold;text-align:center;">{{$product}} Produk</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Total Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight:bold;text-align:center;">{{$report}} Transaksi</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content:center;">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Total Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight:bold;text-align:center;">{{$income}} Barang</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Total Barang Keluar</h4>
                    </div>
                    <div class="card-body">
                        <h2 style="font-weight:bold;text-align:center;">{{$outgoing}} Barang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
