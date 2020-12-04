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

        {{-- <a href="{{route('reviews.create')}}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New review</a> --}}


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">reviews </h6>
              
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Review</th>
                      <th>CSV</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Review</th>
                        <th>CSV</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>

                    @isset($reviews)
                        @if (count($reviews) > 0)
                            @foreach ($reviews as $review)
                            <tr class="text-center">
                            <td>{{$review->id}}</td>
                              <td class="text-capitalize">{{$review->client->name}}</td>
                              <td>@empty($review->review)
                                  No review is given
                                  @else
                                  {{$review->review}}
                                @endempty</td>
                              {{-- <td>{{$review->photos}}</td> --}}
                              <td><a href="{{ route('export-csv', $review->id) }}">Download CSV</a></td>
                              <td>
                              <a href="{{route('reviews.show', $review->id)}}" class="btn btn-sm btn-circle btn-success"><i class="fa fa-eye"></i></a>
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