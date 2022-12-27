<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>NoComission</title>

<!-- Fav Icon -->
<link rel="icon" href="/assets2/images/favicon.svg" type="image/x-icon">

<!-- Google Fonts -->
{{-- <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet"> --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">
<!-- Stylesheets -->
<link href="/assets2/css/font-awesome-all.css" rel="stylesheet">

<link href="/assets2/css/bootstrap.css" rel="stylesheet">

<link href="/assets2/css/animate.css" rel="stylesheet">
<link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="/assets2/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
<link href="/assets2/css/style.css" rel="stylesheet">
<link href="/assets2/css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="/assets2/css/vue-select.css">
@if(session('lang')=='ar')
<link href="/assets2/css/rtl.css" rel="stylesheet">
@endif
</head>


<!-- page wrapper -->
<body class="{{session('lang')=='ar'?'rtl':'ltr'}}">

    <div class="boxed_wrapper" id="app">
  <audio id="audio">
  <source src="/audio/notify.mp3">
  <source src="/audio/notify.ogg">
  <source src="/audio/notify.wav">
  </audio>

        <!-- preloader -->
        {{-- <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close"><i class="ri-close-line"></i></div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="N" class="letters-loading">
                                N
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                            o
                            </span>
                            <span data-text-preloader="C" class="letters-loading">
                                C
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                            <span data-text-preloader="m" class="letters-loading">
                                m
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                            <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                            <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                            <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                        </div>
                    </div>  
                </div>
            </div>
        </div> --}}
        <!-- preloader end -->
