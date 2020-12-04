<!DOCTYPE html>
<html lang="en">

<head>
    <title>PhotoSharing</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('public/theme/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/theme/css/media.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('public/theme/css/bootstrap.css')}}">
    <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8b6502498a.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

<body>

    @yield('content')

</body>
<script src="{{asset('public/theme/js/jquery.js')}}"></script>
<script src="{{asset('public/theme/js/bootstrap.js')}}"></script>
<script src="{{asset('public/theme/js/scroll.js')}}"></script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
<script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
<script>
    lightGallery(document.getElementById('lightgallery'));
</script>
@yield('javascript')

</html>