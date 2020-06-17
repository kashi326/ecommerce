@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header info-card-header ">{{ __('Reset Password') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="md-form">
              <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="md-form">
              <label for="password" class="text-md-right">{{ __('Password') }}</label>

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>

            <div class="md-form">
              <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="md-form  row mb-0">
          <div class="col-md-6 offset-md-4">
            <input type="submit" class="btn btn-raised btn-primary" value="{{ __('Reset Password') }}"/>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection