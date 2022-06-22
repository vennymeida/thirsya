@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Table User</h4>
            <form class="form" method="get" action="{{route('searchUser')}}">
              <div class="form-group w-100 mb-3">
                  <input type="text" name="searchUser" class="form-control w-80 d-inline" id="searchUser" placeholder="Search User...">
              </div>
          </form>
          </div>
            <div class="card-body">
            <a class="btn btn-danger btn-sm" href="{{ route('pembeli.index') }}">Refresh</a>
            <a class="btn btn-warning btn-sm" href="{{ route('pembeli.create') }}">Tambah</a> 

            @foreach($role as $item)
                <a href="{{ route('list.role', $item->id)}}" class="btn btn-primary btn-sm">{{$item->name}}</a>
            @endforeach
              <div class="table-responsive">
                <table class="table">
                  <thead class="text-primary">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th width="250px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($users as $pem)
                    <tr>
                    <td>{{ $pem ->id }}</td>
                    <td>{{ $pem ->username }}</td>
                    <td>{{ $pem ->name }}</td>
                    <td>{{ $pem ->email }}</td>
                    <td>{{ $pem ->password }}</td>
                    <td>
                      <!-- <form action="{{ route('pembeli.destroy',['pembeli'=>$pem->username]) }}" method="POST"> -->
                      <a class="btn btn-primary btn-sm" href="{{ route('pembeli.edit',$pem->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$pem->username}} akan dihapus?')">Delete</button>
                      <!-- </form>  -->
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              
                </div>
              </div>
            </div>
  </div>

  {{$paginate-> links()}}
@endsection