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
</script>
@endsection
@section('content')

        <a href="{{route('projects.create')}}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New Project</a>

            <br>
            <br>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Projects </h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    @isset($projects)
                        @if (count($projects) > 0)
                            @foreach ($projects as $project)
                            <tr class="text-center">
                            <td>{{$project->id}}</td>
                              <td>{{$project->name}}</td>
                              <td>{{ $project->created_at->format(' j-F-Y') }}</td>
                              <td>
                              <a href="{{route('projects.show', $project->id)}}" class="btn btn-sm btn-circle btn-success"><i class="fa fa-eye"></i></a>
                              </td>
                            </tr>
                            @endforeach
                        @endif
                    @endisset
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>


    
@endsection
