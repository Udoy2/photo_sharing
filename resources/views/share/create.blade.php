@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="card-body">
    <form action="{{ action('ShareController@store') }}" method="POST">

            @csrf
            
            <div class="form-group">
                <label for="share_type">Select your type of share</label>
                <select name="share_type" id="share_type" class="form-control">
                    <option hidden selected disabled value="">Select a type</option>
                    <option value="album-selection">Share for album selection</option>
                    <option value="view">Share for view</option>
                </select>
            </div>

            <div class="form-group" id="client" style="display: none">
                <label for="client_id">Select a Client</label>
                <select name="client_id" id="client_id" class="form-control">
                <option hidden selected disabled value="">Select a client</option>
                @isset($clients)
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                @endisset
                </select>
            </div>


            <div class="form-group">
                <label for="project_id">Select Project which you want to share in the link</label>
                <select name="project_id" id="project_id" class="form-control">
                    <option hidden selected disabled value="">Select a project</option>
                    @isset($projects)
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="form-group" id="expire" style="display: none">
                <label for="expire_date">Link Expire date</label>
                <input type="date" name="expire_date" id="expire_date" class="form-control">
            </div>

            <div class="form-group" id="number_of_photo" style="display: none">
                <label for="number_of_photo">Add number of photos allow client to select</label>
                <input type="number" name="number_of_photo" id="number_of_photo" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Generate a link</button>
        </form>
    </div>
</div>


@endsection
@section('javascript')
<script>
    $(document).ready(function(){
        $('#share_type').on('change', function(){
            let val = $(this).val()
            if(val == 'album-selection'){
                $('#client').show()
                $('#expire').show()
                $('#number_of_photo').show()
            }else{
                $('#client').hide()
                $('#expire').hide()
                $('#number_of_photo').hide()
            }
        })
    })
</script>
@endsection
