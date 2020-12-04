@extends('layouts.app')
@section('content')
@section('javascript')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#avatar-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#avatar-img").change(function(){
        readURL(this);
    });
</script>
@endsection
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
        <form action="{{action('ClientController@store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" required class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="name">Email address</label>
                <input type="email" name="email" required class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" name="password" required class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <img src="{{asset('public/images/avatar.png')}}" id="avatar-img-tag" width="200px" /> <br>
                <label  class="btn btn-info rounded-pill ml-3 mt-2" for="avatar-img">Avatar</label>
                <input type="file"required  class="form-control" name="avatar" id="avatar-img" style="display: none !important;">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection