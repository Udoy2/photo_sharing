@extends('layouts.app')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card shadow mb-4">
<div class="card-header py-3">
    <div class="float-right">
        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Photos</a>
    </div>
    <h6 class="m-0 font-weight-bold "><span class="text-primary">{{$folder->project->name}} </span> / {{$folder->name}}</h6>
</div>
<div class="card-body">

<div class="row">

    @isset($folder->photos)
        @if (count($folder->photos) > 0)
            
        @foreach ($folder->photos as $photo)
        <div class="text-center" style="margin:10px">
            <a href="#">
            <img src="{{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}}"  width="100px" height="100px" alt="">
                <div> {{Str::limit($photo->name,10,'...')}} </div> <br>
                <form action="{{action('PhotoController@destroy', $photo->id)}}" method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-circle btn-sm" ><i class="fa fa-trash"></i></button>

                </form>
            </a>
        </div>

    @endforeach

        @else

            <p>No file available</p>

        @endif
    @endisset


</div>

</div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Upload Photos to this folder</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">

            <form action="{{action ( 'PhotoController@store' ) }}"  enctype="multipart/form-data" class="dropzone" id="image-upload" >
                @csrf
            </form>

        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
        <a href="{{route('folders.show', $folder->id)}}"  class="btn btn-success btn-sm" >Update</a>
          {{-- <button type="button" >Close</button> --}}
        </div>
  
      </div>
    </div>
  </div>

@endsection

@section('javascript')
<script src="{{asset('public/lib/dropzone.min.js')}}"></script>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize         :       2,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        params: {
        'project_id' : {{$folder->project->id}}, // Your gallery Id
        'folder_id' : {{$folder->id}} // Your gallery Id
    }
    };
</script>
@endsection



