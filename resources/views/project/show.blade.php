@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="float-right">
            <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Folder</a>
        </div>
        <h6 class="m-0 font-weight-bold "><span class="text-primary">Project Name:</span> {{$project->name}}</h6>
    </div>
    <div class="card-body">
        
        @isset($project->folders )
            @if (count($project->folders) > 0)
            <div class="row">
                @foreach ($project->folders as $folder)
                    <div class="text-center" style="width:100px">
                        <a href="{{route('folders.show', $folder->id)}}">
                            <img src="{{asset('public/images/folder.png')}}" width="50px" height="50px" alt="">
                            <div> {{$folder->name}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            @else
            <p>No folder created <a href="#" class="btn btn-sm btn-success">Add Folder</a></p>
            @endif
        @endisset

    </div>

</div>

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add new Folder</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">

        <form action="{{action('FolderController@store')}}" method="POST">

                @csrf

            <input type="hidden" name="project_id" value="{{$project->id}}">

            <div class="form-group">
                <label for="name">Folder Name</label>
                <input type="text" name="folder" required class="form-control" id="name" placeholder="Enter your Folder name">
            </div>

            <button type="submit" class="btn btn-primary">Add</button>


            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
@endsection