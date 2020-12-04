@extends('layouts.site')
@section('content')

<div style="background-color: #fff; height:650px">

    <div id="box" style="margin-left:30%;  width:500px">

        <form action="" style="padding-top: 150px">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Email</label>
                <input type="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">Password</label>
                <input type="name" class="form-control">
            </div>

        </form>

    </div>

</div>


<h1>Photo Gallary</h1>

<div class="demo-gallery">
    <ul id="lightgallery" class="list-unstyled row">

        
        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{asset('public/gallary/img/1-375.jpg')}} 375, {{asset('public/gallary/img/1-480.jpg')}} 480, {{asset('public/gallary/img/1.jpg')}} 800" data-src="{{asset('public/gallary/img/1-1600.jpg')}}" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
            <a href="">
            <img class="img-responsive" src="{{asset('public/gallary/img/thumb-1.jpg')}}" alt="Thumb-1">
            </a>
        </li>

        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{asset('public/gallary/img/2-375.jpg')}} 375, {{asset('public/gallary/img/2-480.jpg')}} 480, {{asset('public/gallary/img/2.jpg')}} 800" data-src="{{asset('public/gallary/img/2-1600.jpg')}}" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
            <a href="">
                <img class="img-responsive" src="{{asset('public/gallary/img/thumb-2.jpg')}}" alt="Thumb-2">
            </a>
        </li>
        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{asset('public/gallary/img/13-375.jpg')}} 375, {{asset('public/gallary/img/13-480.jpg')}} 480, {{asset('public/gallary/img/13.jpg')}} 800" data-src="{{asset('public/gallary/img/13-1600.jpg')}}" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
            <a href="">
                <img class="img-responsive" src="{{asset('public/gallary/img/thumb-13.jpg')}}" alt="Thumb-3">
            </a>
        </li>
        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="{{asset('public/gallary/img/4-375.jpg')}} 375, {{asset('public/gallary/img/4-480.jpg')}} 480, {{asset('public/gallary/img/4.jpg')}} 800" data-src="{{asset('public/gallary/img/4-1600.jpg')}}" data-sub-html="<h4>Bowness Bay</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>" data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
            <a href="">
                <img class="img-responsive" src="{{asset('public/gallary/img/thumb-4.jpg')}}" alt="Thumb-4">
            </a>
        </li>
    </ul>
</div>

@endsection