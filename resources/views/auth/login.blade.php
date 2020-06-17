@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" >
        <div class="card-header info-card-header ">{{ __('Login') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="md-form">
              <label for="email">{{ __('E-Mail Address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="md-form">
              <label for="password">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-check form-inline">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" value=" old('remember') ? 'checked' : '' }}">
              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>

            <div class="md-form pull-right">
              <button type="submit" class="btn btn-raised btn-primary">
                {{ __('Login') }}
              </button>

              @if (Route::has('password.request'))
              <a class="btn btn-raised btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
              @endif
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection