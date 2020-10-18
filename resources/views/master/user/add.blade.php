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
                  <h4 class="card-title">Add User</h4>
                  <p class="card-category">Add user to your system</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{route('user.store')}}">
                      {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label class="bmd-label-floating">Full Name</label>
                            <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" name="email">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" class="form-control" name="phone">
                        </div>
                      </div>
                      <div class="col-md-11">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" name="address">
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
                              Admin
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Admin</a>
                              <a class="dropdown-item" href="#">Cashier</a>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="level" value="Admin" class="level-submit">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Add User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
