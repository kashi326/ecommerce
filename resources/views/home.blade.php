@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="card-columns">
    @foreach($items as $item)
      <div class="card itemcard" id="card">
        <div class="cascade">
          <img class="card-img-top" src="{{ $item->thumbnail }}" alt="{{ $item->title }}" style="height:200px; width:100%;object-fit:cover;">
        </div>
        <div class="card-body" style="padding: 0.625rem;">
          <h5 class="card-title">{{ $item->title }}</h5>
          <hr>
          <p class="card-text">{{ $item->description }}</p>
          <p class="card-text" style="display: inline; text-align:center">{{ $item->price }}</p>
        </div>
        <div class="card-footer" id="card-footer">
          <a href="/buy/{{ $item->id }}" class="btn btn-primary btn-sm w-100">Buy</a>
        </div>
      </div>
    @endforeach
  </div>
</div>
  <div class="row">
    <div class="col-12 text-center">
      {{ $items->links() }}
    </div>
  </div>
</div>
@endsection