@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @foreach($items as $item)
    <div class="col-lg-2 col-md-3 col-4" style="margin-bottom: 5px;">
      <div class="card">
        <img class="card-img-top" src="{{$item->feature_image}}" alt="{{$item->title}}">
        <div class="card-body" style="padding: 0.625rem;">
          <h5 class="card-title">{{$item->title}}</h5><hr>
          <p class="card-text" style="display: inline;">{{$item->price}}</p>
          <a href="/buy/{{$item->id}}" class="btn btn-primary btn-small pull-right" style="display: inline;">Buy</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-12 text-center">
      {{$items->links()}}
    </div>
  </div>
</div>
@endsection