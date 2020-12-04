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
        <form action="{{action('ProjectController@store')}}" method="POST">

            @csrf
            
            <div class="form-group">
                <label for="name">Project Name</label>
                <input type="text" name="name" required class="form-control" id="name" placeholder="Enter your Project name">
            </div>

            <div class="card-body" >
                <div class='repeater'>
                    <!-- Make sure the repeater list value is different from the first repeater  -->
                    <div data-repeater-list="group-b">
                      <div data-repeater-item>
                            <div class="form-group">
                                <br>
                                <label class="form-label"><strong>Folder</strong></label>
                                <input type="text" class="form-control" name="folder" id="" placeholder="Enter folder name">
                            </div>
                        <input data-repeater-delete type="button" class="btn btn-danger" value="Delete"/>
                      </div>
                    </div>
                    <br>
                    <input data-repeater-create type="button" class="btn btn-success" value="Add new Folder"/>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{asset('public/repeater/repeater.min.js')}}"></script>
      <script>
            function setFormValidation(id) {
              $(id).validate({
                highlight: function(element) {
                  $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                  $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
                },
                success: function(element) {
                  $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                  $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
                },
                errorPlacement: function(error, element) {
                  $(element).closest('.form-group').append(error);
                },
              });
            }
        
            $(document).ready(function() {
              setFormValidation('#InputForm');
            });



            $(document).ready(function () {
        $('.repeater').repeater({
            
            initEmpty: false,
            
            defaultValues: {
                'text-input': 'foo'
            },
            
            show: function () {
                $(this).slideDown();
            },
           
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            
            ready: function (setIndexes) {
            },
            
            isFirstItemUndeletable: true
        })
    });
</script>
@endsection