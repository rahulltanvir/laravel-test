<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>My Commarce - @yield('title')</title>
    @include('website.includes.style')

    <style>
        .search-box{

display:flex;
border:1px solid #ddd;
height:45px;
border-radius:5px;
overflow:hidden;

}


.search-box input{

width:100%;
border:0;
padding:0 15px;

}


.search-box button{

width:60px;
background:#ff6600;
color:white;
border:0;

}



.header-action{

display:flex;
align-items:center;
justify-content:flex-end;
gap:25px;

}



.hotline{

display:flex;
align-items:center;
gap:10px;

}


.hotline i{

font-size:25px;
color:#ff6600;

}



.account a{

display:flex;
align-items:center;
gap:5px;

color:#333;

}



.cart-icon{

position:relative;
font-size:25px;

}



.cart-icon span{

position:absolute;
top:-10px;
right:-10px;

background:#ff6600;

color:white;

width:20px;
height:20px;

border-radius:50%;

font-size:12px;

text-align:center;

}
    </style>
</head>

<body>
@include('website.includes.header')

@yield('body')



@include('website.includes.footer')


    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>


    @include('website.includes.script')
    
</body>

</html>