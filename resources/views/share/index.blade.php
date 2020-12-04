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

        <a href="{{route('shares.create')}}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New share</a>

            <br>
            <br>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">shares </h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Link</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    @isset($shares)
                        @if (count($shares) > 0)
                            @foreach ($shares as $share)
                            <tr class="text-center">
                            <td>{{$share->id}}</td>
                              <td class="text-capitalize">{{$share->client->name}}</td>
                              <td>{{$share->project->name}}</td>
                              <td>
                                  <a href="{{$share->link}}" target="_blank">{{$share->link}}</a>
                              </td>
                                @if ($share->reviewed == 0)
                                  <td><span class="badge badge-success">submited</span> </td>
                                @else
                                  <td><span class="badge badge-danger">selected</span> </td>
                                @endif
                              <td>
                              <a href="#" class="btn btn-sm btn-circle btn-primary" data-toggle="modal" data-target="#target_{{$share->id}}" ><i class="fa fa-paper-plane"></i></a>
                              {{-- <a href="{{route('shares.show', $share->id)}}" class="btn btn-sm btn-circle btn-success"><i class="fa fa-eye"></i></a> --}}
                              </td>
                            </tr>

                            <div class="modal fade" id="target_{{$share->id}}" tabindex="-1" role="dialog" aria-labelledby="target_{{$share->id}}Label" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="target_{{$share->id}}Label">Email Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">

                                      <h6>Project Name: {{$share->project->name}}</h6>

                                      <ul>
                                        <li><strong>Name: </strong>{{$share->client->name}}</li>
                                        <li><strong>Email:</strong> {{$share->client->email}}</li>
                                        <li><strong>Password:</strong> ********</li>
                                        <li><strong>Link: </strong>{{$share->link}}</li>
                                      </ul>

                                      <hr>

                                      <a href="#" class="btn btn-primary btn-sm" ><i class="fa fa-paper-plane"></i> Send by Email</a>
                                      <a href="#" class="btn btn-success btn-sm" ><i class="fa fa-whatsapp"></i> Send by Whatsapp</a>

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>



                            @endforeach
                        @endif
                    @endisset
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    
@endsection