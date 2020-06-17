<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/favicon/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{ asset('storage/favicon/site.webmanifest')}}">
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('js/custom.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom_style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">

  <style>
    .dropdown:hover>.dropdown-menu {
      display: block;
    }

    .active {
      line-height: normal;
    }

    .form-control:focus {
      box-shadow: none;
      outline: none;
    }

    .table-bordered,
    .table-bordered td,
    .table-bordered th {
      border: 1px solid #083c67;
      border-bottom-color: black;
    }

    body {
      font-family: "Lato", sans-serif;
    }

    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 16px;
      color: white;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:not(:first-child) {
      border-bottom: 1px solid dimgray;
    }

    .sidenav a:hover {
      color: gray;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 2px;
      font-size: 36px;
      margin-left: 50px;
    }

    #main {
      transition: margin-left .5s;
      padding: 16px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }
  </style>

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md sticky-top shadow-sm mb-3">
      <div class="container-fluid">
        <i class="fa fa-list" onclick="openNav()" style="color:white;font-size:1.5rem;margin-right:1%;cursor:pointer;"></i>
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="theme-switch-wrapper">
              <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="theme-toggle" hidden />
              </label>
              <button id="switch"><img src="" id="switch-image" alt="" height="20px" width="20px" /></button>
            </div>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}<img src="{{ asset('icons/logout.svg') }}" alt="" height="20px" width="20px" /></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div id="mySidenav" class="sidenav bg-dark text-white hidden" style="margin-top:2rem; color:white !important;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#"><img src="https://img.icons8.com/clouds/30/000000/dashboard.png" />Dashboard</a>
    <a href="{{ route('product') }}"><img src="https://img.icons8.com/bubbles/30/000000/product.png" />My Products</a>
    <a href="{{ route('addproduct') }}"><img src="https://img.icons8.com/plasticine/30/000000/new-product.png" />Add Product</a>
    <a href="#"><img src="https://img.icons8.com/bubbles/30/000000/purchase-order.png" />Orders</a>
    <a href="{{ route('sellerprofile') }}"><img src="https://img.icons8.com/bubbles/30/000000/edit-user.png" />Profile</a>
  </div>

  <div id="main">
    @yield('sellercontent')
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    }
    var public_path = "{{ public_path('public') }}";
  </script>
</body>

</html>