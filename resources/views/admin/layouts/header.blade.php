<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title>Dashboard | No-comission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- jsvectormap css -->
    <link href="/assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
   
    <!-- App rtl Css-->
    @if(session('lang')=='ar')
    <link href="/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
    @else 
     <!-- App ltr Css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    @endif
    <!-- custom Css-->
    <link href="/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/assets/css/vue-select.css">
    @stack('css')

</head>

<body dir="{{session('lang')=='ar'?'rtl':'ltr'}}">
<audio id="audio" muted="muted">
<source src="{{asset('audio/notify.mp3')}}">
<source src="{{asset('audio/notify.0gg')}}">
<source src="{{asset('audio/notify.wav')}}">

</audio>
    <!-- Begin page -->
    <div id="layout-wrapper">

      <div id="app">
   