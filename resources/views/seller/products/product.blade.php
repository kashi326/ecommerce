@extends('seller.layouts.app')

@section('sellercontent')
<style>
  div.card-body {
    padding: 0px 10px;
  }

  div.card {
    margin-top: 10px;
    padding: 0px 0px 10px 0px;
    box-shadow: 0 1em 1em -1em rgba(0, 0, 0, .25);
    transition: transform .5s;
    text-align: center;
  }

  div.card:hover {
    transform: translateY(-3px);
  }
</style>
<div class="container-fluid">
  @error('success')
  <div class="justify-content-center">
    <div class="w-50 alert alert-success">
      {{ $message }}
    </div>
  </div>
  @enderror
  <div class="card-columns">
    @foreach($products as $product)
    <div class="card border-info">
      <img class="card-img-top" src="{{ asset($product->thumbnail) }}" alt="{{ $product->title }}" height="200px" style="border-bottom:1px solid #33b5e5;">
      <div class="card-body" style="border-bottom:1px solid #33b5e5; padding: 0.625rem;">
        <h5 class="card-title">{{ $product->title }}</h5>
        <hr>
        <p class="card-text" style="display: inline;">{{ $product->price }}</p>
      </div>
      <div class="card-footer">
        <a href="{{ route('edititem', $product->id) }}" class="btn btn-primary btn-sm d-block">Edit</a>
        <a href="{{ route('removeitem', $product->id) }}" class="btn btn-danger btn-sm d-block">Remove</a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection