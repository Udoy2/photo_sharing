@extends('layouts.site')
@section('content')
@auth
@role('client')
<!-- barner -->
<section id="barner">
   <div class="container">
      <div class="row ">
         <div class="col-md-6 text-center pos-1  justify-content center m-auto">
            <p class="color-ligth">WEDDING BUSINESS</p>
            <h1 class="fs-58 mt-3 mb-5">{{$client->name}} </h1>
            {{-- <span> {{$client->created_at}} </span> --}}
            {{-- {{ $client->created_at->format('j-F-Y') }} --}}
            <a href="#gallary" class="view text-white">View Photo</a>
         </div>
      </div>
   </div>
</section>
<!-- barner end -->
<!-- gallary -->
<section id="gallary">
   <div class="sticky-header nav-down sticky" id="pics">
      <div class="py-3 px-4 ">
         <div class="row">
            <div class="col-lg-7 col-sm-4 ">
               <div class="t-md-center mb-sm-3  mx-0">
                  <h4 class="my-0 fs-18 ff-sb ls-56">Weddings &amp; Events</h4>
                  <small>Wedding Business</small>
               </div>
            </div>
            <div class="col-lg-5 col-sm-8">
               <div class="row align-items-center text-right">
                  <div class="col-2" style="border-right: 1px solid #d3d3d3;">
                     <img src="https://d1q9zt8mabqinx.cloudfront.net/share/icon/share-distribution-icon.svg" class="c-p mr-4 share-now" aria-hidden="true" data-toggle="modal" data-target="#shareModal">
                  </div>
                  <div class="col-5 text-right">
                     <p class="ff-sb  fs-14 ls-56 mb-0">
                     <strong> Selected:</strong> <span class="selected-photos"><span class="selected-count">0</span>/<span class="max-photos-count">{{$share->number_of_photo}}</span></span>
                     </p>
                  </div>
                  <div class="col-5">
                     @if ($share->status == 1)
                     <a href="{{route('share-link-review', ['project' =>  Request()->project , 'ulid' =>  Request()->ulid  ])}}">
                        <button type="button" class="btn btn-primary rounded-0 text-white">Review
                        &amp; Submit</button>
                     </a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <hr /> -->
      <div class="filter p-3 container-fluid">
         <div class="row">
            <div class="form-group form-inline w-100 pl-5 mb-0">
               <select id="select2" tabindex="-1"  class="select2-hidden-accessible form-control w-16" aria-hidden="true">
                  <option value="all">All Photos</option>
                  @isset($project->folders)
                    @foreach ($project->folders as $folder)
                        <option value="{{$folder->id}}">{{$folder->name}}</option>
                    @endforeach
                  @endisset
               </select>
               <a href="#" class="pl-4"><img src="{{asset('public/theme/img/download.svg')}}" alt=""></a>
            </div>
         </div>
      </div>
      <div class="text-center link ">

         @if ($share->status == 1)
            <h6 class="text-white p-1">Link expires in {{$expirein}} Days</h6>
         @else
            <h6 class="text-white p-1">This link is expire.</h6>
         @endif
      </div>
      <!-- image gallery -->
      @if ($share->status == 1)
          
      <div class="gallary-images">
         <div class="container-fluid">
            <div class="demo-gallery">
               <div id="lightgallery" class=" masonry-grid">
                  @isset($project->folders)
                  @foreach ($project->folders as $folder)
                  @foreach ($folder->photos as $photo)
                  <figure class="item" data-responsive="{{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}} 375, 
                     {{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}} 480, 
                     {{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}} 800" 
                     data-src="{{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}}" data-sub-html=" " data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                     <a href="" class="d-block">
                     <img class="" width="100%" src="{{asset('public/uploads/'.Str::lower($folder->project->name).'/'.Str::lower($folder->name).'/'.$photo->photo)}}" alt="Thumb-1">
                     </a>
                     <div class="heart">
                     <i class="far fa-heart f-18 heart-fill" data-val='{{$photo->serial_code}}' ></i>
                     </div>
                  </figure>
                  @endforeach
                  @endforeach
                  @endisset
               </div>
            </div>
         </div>
      </div>

      @endif
      <!-- image gallary 2 -->
   </div>
</section>
<!-- gallary end -->
@else
<h4 class="text-center" style="color: #fff">You are login as admin</h4>
@endrole
@else
<div id="reg-form" class="">
   <form action="{{action( 'PublicController@login_as_client' )}}" method="POST" class="pos">
      <div class="row">
         <div class="col-md-4 m-auto text-center">
            <p class="color-ligth">WEDDING BUSINESS</p>
            <h1>{{$client->name}}</h1>
            <p>{{ $client->created_at->format('j-F-Y') }}</p>
            @csrf
            <input type="hidden" name="project" value="{{ Request()->project }}">
            <input type="hidden" name="ulid" value="{{ Request()->ulid }}">
            {{-- <p id="date"></p> --}}
            <div class="form-group mt-4">
               <input type="text" name="name" class="form-control  rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your name">
            </div>
            <div class="form-group">
               <input type="email" name="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
               <input type="password" name="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="PIN">
            </div>
            <button type="submit" id="submit" class="btn btn-primary rounded-0">Login</button>
         </div>
      </div>
   </form>
</div>
@endauth
@endsection

@section('javascript')
<script>
    $(document).ready(function() {

        let proj = '{{$project->name}}'
        localStorage.setItem("project", proj)

        if (localStorage.getItem("selected_photos") !== null) {

            var checklocal = JSON.parse(localStorage.getItem("selected_photos"))

            $('.fa-heart').each(function () {
                    var temp = checklocal.indexOf($(this).attr('data-val'))
                    if (temp > -1) {
                    $(this).addClass( "fas color-red")
                    }
            })

        }

        if (localStorage.getItem("selected_photos") !== null) {
                var list = JSON.parse(localStorage.getItem("selected_photos"));
            }else{
                var list = [];
            }

            $(".selected-count").text(list.length)

        $(".heart-fill").click(function(event) {
            event.stopPropagation()

            var total_photo_allow = "{{$share->number_of_photo}}"
            // var total_photo_allow = 
            var photo = $(this).attr('data-val')

            if($(this).hasClass("fas color-red") == false){

                if(list.length >= total_photo_allow){
                    alert('Photo limit is exceed!')
                }else{
                    list.push(photo)
                    $(this).toggleClass("fas color-red")
                    $(".selected-count").text(list.length)
                }
                    
                
            }else{

                var index = list.indexOf(photo)
                if (index > -1) {
                    list.splice(index, 1)
                }
                $(this).toggleClass("fas color-red")
                $(".selected-count").text(list.length)

            }

            localStorage.setItem("selected_photos", JSON.stringify(list))
            localStorage.setItem("photo-selected", list.length)

        });

        $('#select2').on('change', function(){

            let id = $('#select2').val()

         
        })

    });
</script>
@if ($share->status == 0)
<script>
   Swal.fire(
      'Link Expire',
      'You have already submitted the photos for album',
      'warning'
      )
</script>
@endif
@endsection