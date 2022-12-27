@extends('layouts.master')
@section('content')
<transition>
    <router-view :key="$route.path"></router-view>
</transition>
@endsection