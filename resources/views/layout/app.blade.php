<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title', "Home")</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset("bootstrap-5/css/bootstrap.min.css") }}">
  <script src="{{ asset("bootstrap-5/js/bootstrap.bundle.min.js") }}"></script>
  <style>
    body {
      background-color: #c0c0c0;
    }
  </style>
</head>
<body>

<div class="p-5 bg-primary text-white text-center">
  <h1>PROGRAMMING TEST PHP INVOICE</h1>
  <p>Selamat Riady</p> 
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('api') ? 'active' : '' }}" href="{{ route('data_api') }}">Request API</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('invoice/*') ? 'active' : '' }}" href="{{ route('invoice.index') }}">Invoice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('params/product/*') ? 'active' : '' }}" href="{{ route('params.product.index') }}">Params Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('params/type/*') ? 'active' : '' }}" href="{{ route('params.type.index') }}">Params Type Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('params/client/*') ? 'active' : '' }}" href="{{ route('params.client.index') }}">Params Client</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('params/company/*') ? 'active' : '' }}" href="{{ route('params.company.index') }}">Params Company</a>
        </li>
      </ul>
    </div>
  </nav>

<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success">{!! session('success') !!} </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">{!! session('warning') !!} </div>
    @endif
    @if (session('danger'))
      <div class="alert alert-danger">{!! session('danger') !!} </div>
  @endif
    <div class="card">
        <div class="card-header">@yield('headingTitle')</div>
        <div class="card-body">@yield('content')</div> 
      </div>
    
</div>

<script src="{{ asset("bootstrap-5/js/bootstrap.min.js") }}"></script>
</body>
</html>

