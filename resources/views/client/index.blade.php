@extends('layouts.app')
@section('css')
<link href="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('javascript')
<script src="{{asset('public/sbadmin2/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('public/sbadmin2/js/demo/datatables-demo.js')}}"></script>
<script>
  $(document).ready(function(){
    $('#dataTable').DataTable( {
      "bDestroy": true,
        "order": [[ 0, "desc" ]]
    } );
  })

  const getPass = (id) =>{
    let token = id
    Swal.fire('Password is: '+token)
  }

</script>
@endsection

@section('content')

<a href="{{route('clients.create')}}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New Client</a> <br>

@if (session('success'))
<br><br>
<div class="row">
  <div class="col-md-12">
     <div class="alert alert-success">
      {{ session('success') }}
     </div>
  </div>
</div>
@endif

<br>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Avatar</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Avatar</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @isset($users)
                @if (count($users) > 0)
                @foreach ($users as $user)
                <tr>
                <td>{{$user->id}}</td>
                  <td class="text-center">
                  <img src="{{asset('public/avatars/'.$user->avatar)}}" width="50px" height="50px" alt="">
                  </td>
                  <td class="text-capitalize">{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                <td class="text-center">******** <a href="#" onclick="getPass({{$user->token}})"> <span class="fa fa-eye"></span></a></td>
                  <td>
                      <a href="{{route('clients.edit', $user->id)}}" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit"></i></a>
                      <a href="#" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                @else
                    <p>No clients updated</p>
                @endif
            @endisset

            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection