@extends('admin-lte::layouts.main')

@if (auth()->guard('branchadmin')->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->guard('branchadmin')->user()->email) . '?d=mm')
@section('user-name', auth()->guard('branchadmin')->user()->name)
@endif

@section('breadcrumbs')
@include('admin-lte::layouts.content-wrapper.breadcrumbs', [
  'breadcrumbs' => [
    (object) [ 'title' => 'Home', 'url' => route('home') ]
  ]
])
@endsection

@section('sidebar-menu')
<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATOR</li>
  <li class="active">
    <a href="{{ route('home') }}">
      <i class="fa fa-home"></i>
      <span>Home</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('tobepickedlaundry') }}">
      <i class="fa fa-home"></i>
      <span>New Laundries</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('pickedlaundry') }}">
      <i class="fa fa-home"></i>
      <span>Picked Laundry</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('deliverylaundry') }}">
      <i class="fa fa-home"></i>
      <span>Delivered Laundry</span>
    </a>
  </li>
 
</ul>
 <script type="text/javascript" src={{URL::to("js/main/main.js")}}></script>
@endsection
