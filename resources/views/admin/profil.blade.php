@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
              <img src="../assets/img/damir-bosnjak.jpg" alt="...">
          </div>
            <div class="card-body">
              <div class="author">
                <a href="#">
                  <img class="avatar border-gray" src="../assets/img/logo-small.png" alt="...">
                    <h5 class="profile-username text-center">{{Auth::user()->name}}</h5>
                    <p class="text-muted text-center">Admin</p>
                </a>
              </div>
            </div>
          </div>
        </div>  
        
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form method="post" action="{{ route('profil.update') }}">@method('patch') @csrf
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Company (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="WaroenkQu">
                      </div>
                    </div>
                      <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="Username" value="{{Auth::user()->name}}">
                        </div>
                      </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                      </div>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" placeholder="Company" value="{{Auth::user()->username}}">
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Password" value="{{Auth::user()->password}}">
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
  </div>
@endsection