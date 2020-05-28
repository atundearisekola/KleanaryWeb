@extends('admin-lte::layouts.main')

@if (auth()->guard('admin')->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->guard('admin')->user()->email) . '?d=mm')
@section('user-name', auth()->guard('admin')->user()->name)
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
    <a href="{{ route('adminregister') }}">
      <i class="fa fa-home"></i>
      <span>Register new admin</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('pickerregister') }}">
      <i class="fa fa-home"></i>
      <span>Register new Picker</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('requestedlaundry') }}">
      <i class="fa fa-home"></i>
      <span>Requested Laundry</span>
    </a>
  </li>
  <li class="">
    <a href="{{ route('branchform') }}">
      <i class="fa fa-home"></i>
      <span>Add  Branch</span>
    </a>
  </li>
</ul>
 <script type="text/javascript" src={{URL::to("js/main/main.js")}}></script>
@endsection
