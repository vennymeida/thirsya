@extends('layouts.layoutAdmin')
@include('layouts.sidebarAdmin')
@include('layouts.navbarAdmin')
@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"> Table Pembeli</h4>
           
          </div>
            <div class="card-body">
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
                    
                    @foreach ($paginate as $pem)
                    <tr>
                    <td>{{ $pem ->id }}</td>
                    <td>{{ $pem ->username }}</td>
                    <td>{{ $pem ->name }}</td>
                    <td>{{ $pem ->email }}</td>
                    <td>{{ $pem ->password }}</td>
                    <td>
                      <form action="{{ route('pembeli.destroy',['pembeli'=>$pem->nama_pembeli]) }}" method="POST">
                      <a class="btn btn-primary btn-sm" href="{{ route('pembeli.edit',$trn->id) }}">Edit</a>
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{$pem->nama_barang}} akan dihapus?')">Delete</button>
                      </form> 
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              
                </div>
              </div>
            </div>
  </div>
  </div>
  </div>
  {{$paginate-> links()}}
@endsection