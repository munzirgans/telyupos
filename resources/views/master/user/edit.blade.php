@extends('master')

@section('master','aktif')
@section('users_data','active')
@section('judul','Users')

@section('konten')
<div class="container-fluid">
        <!-- <div class="row"> -->
            <!-- <div class="col-md-10"> -->
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit User</h4>
                  <p class="card-category">Edit your user data</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{route('user.update', $user->id)}}">
                      {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="bmd-label-floating">Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" name="email" value="{{$user->email}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                        </div>
                      </div>
                      <div class="col-md-11">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" name="address" value="{{$user->address}}">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="text" class="form-control" name="password">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="text" class="form-control" name="confirm-password">
                        </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                            <label class="bmd-label-floating">Level</label>
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle level-button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{$user->level}}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Admin</a>
                              <a class="dropdown-item" href="#">Cashier</a>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="level" value="{{$user->level}}" class="level-submit">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Edit User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
