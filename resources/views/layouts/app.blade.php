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
  <!-- scripts -->
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
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md sticky-top shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand animated fadeIn" href="{{ url('/') }}">
          <img src="{{asset('icons/e_logo.jpg')}}" alt="" height="25px" width="25px" style="border-radius: 45px">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">
                <img src="{{ asset('icons/home.svg') }}" height="20px" width="20px"/>
               Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset('icons/list.svg') }}"  alt="" height="20px" width="20px"/> Categories
              </a>
              <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a class="dropdown-item" href="#">category 1</a>
                <a class="dropdown-item" href="#">category 2</a>
                <a class="dropdown-item" href="#">category 3</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mycart') }}"><img src="{{ asset('icons/shopping-cart.svg') }}"  alt="" height="20px" width="20px"/> <span id="itemCount" class="badge badge-pill badge-default" id="itemCount">{{ session()->has('itemincart')?count(session()->get('itemincart')):0}}</span> My
                Cart</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="theme-switch-wrapper">
              <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="theme-toggle" hidden/>
              </label>
              <button id="switch"><img src="" id="switch-image" alt="" height="20px" width="20px"/></button>
            </div>
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
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} <img src="{{ asset('icons/logout.svg') }}"  alt="" height="20px" width="20px"/></i>
                </a>
                @if(Auth::user()->role == 2)
                <!-- role = 2 is admin -->
                <a class="dropdown-item" href="#">Admin Dashboard <img src="{{ asset('icons/dashboard.svg') }}"  alt="" height="20px" width="20px"/></i></a>
                @elseif(Auth::user()->role == 1)
                <!-- role = 1 is seller -->
                <a class="dropdown-item" href="{{route('sellerdashboard')}}">Seller Dashboard <img src="{{ asset('icons/dashboard.svg') }}"  alt="" height="20px" width="20px"/></a>
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

    <div id="main">
      @yield('content')
</div>
  </div>
</body>

</html>