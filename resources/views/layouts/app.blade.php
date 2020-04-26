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

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  .dropdown:hover>.dropdown-menu {
    display: block;
  }

  .card,
  .card-header {
    border-color: gray;
  }

  .table-bordered,
  .table-bordered td,
  .table-bordered th {
    border: 1px solid #083c67;
    border-bottom-color: black;
  }
  </style>

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-dark shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"> <i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="categoryDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-list"></i> Categories
              </a>
              <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item" href="#">category 1</a>
                <a class="dropdown-item" href="#">category 2</a>
                <a class="dropdown-item" href="#">category 3</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mycart') }}"><i class="fa fa-shopping-cart"></i> <span id="itemCount"
                  class="badge badge-pill badge-default"
                  id="itemCount">{{ session()->has('itemincart')?count(session()->get('itemincart')):0}}</span> My
                Cart</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} <i class="fa fa-sign-out"></i>
                </a>
                @if(Auth::user()->role == 2)
                <a class="dropdown-item" href="#">Admin Dashboard <i class="fa fa-dashboard"></i></a>
                @elseif(Auth::user()->role == 1)
                <a class="dropdown-item" href="{{route('sellerdashboard')}}">Seller Dashboard <i class="fa fa-dashboard"></i></a>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>