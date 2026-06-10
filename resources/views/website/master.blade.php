<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>My Commarce - @yield('title')</title>
    @include('website.includes.style')
</head>

<body>
@include('website.includes.header')

@yield('body')



@include('website.includes.footer')


    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>


    @include('website.includes.script')
    <script src="{{ asset('website/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('website/assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('website/assets/js/glightbox.min.js') }}"></script>
<script src="{{ asset('website/assets/js/main.js') }}"></script>
</body>

</html>