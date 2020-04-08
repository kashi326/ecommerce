<html>

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">E-Commerce</a>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-light">0</span> My Cart</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-md-auto">
      @if(!session()->has('user'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login <i class="fa fa-user" aria-hidden="true"></i></a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Log out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
      </li>
      @endif
    </ul>
  </nav>
  <br>