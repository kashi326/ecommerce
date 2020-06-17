@extends('layouts.app')

@section('content')
<style>
  div {
    font-family: courier;
  }
</style>
<div class="container-fluid" style="font-family:'Times New Roman', Times, serif">
  <div id="item-carousel" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      @foreach($item->file_location as $it)
      <li data-target="item-carousel" data-slide-to="{{ $it->id }}" class="{{ $loop->first? 'active':'' }}"></li>
      @endforeach
    </ul>

    <div class="carousel-inner">
      @foreach($item->file_location as $it)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <img src="{{ asset($it->file_location) }}" alt="..." style="width: 100%; height:500px;">

      </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#item-carousel" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#item-carousel" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  <hr>
  <div class="row">
    <div class="col-12">
      <div class="jumbotron" style="padding: 5px;">
        <h4>{{$item->title}}</h4>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="jumbotron" id="product-detail" style="padding: 5px 30px 15px 15px;">
        <div class="alert alert-success" role="alert" id="successAlert" style="display: none;"></div>
        <div class="row">
          <div class="col-md-6 col-12">
            <h4>Price: <i style="font-size: 16px;">{{$item->price}}</i></h4>
          </div>
          <div class="col-md-6 col-12">
            <form id="cartForm" style="display:flex;">
              @csrf
              <div class="col-6">
                <div class="md-form" style="margin-top:0px;">
                  <input type="number" id="quantity" min="1" max="5" class="form-control" value="1">
                  <input type="text" id="itemID" value="{{$item->id}}" hidden>
                  <input type="text" id="userID" value="{{$item->user->id}}" hidden>
                </div>
              </div>
              <input type="submit" id="submit" class="btn btn-small btn-info " />
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="jumbotron" id="product-detail" style="padding: 5px 30px 15px 15px;">
        <h4>Product Details of {{$item->title}}</h4>
        <p style="font-size: medium; text-align:justify">&nbsp;{{$item->description}}</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="jumbotron" id="product-specification" style="padding: 5px 30px 15px 15px;">
        <h4>Specification of {{ $item->title }}</h4>
        <p>{{ $item->specification }}</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="jumbotron" id="product-instruction" style="padding: 5px 30px 15px 15px;">
        <h4>Instruction for {{$item->title}}</h4>
        <p style="font-size: medium; text-align:justify">&nbsp;{{$item->instruction}}</p>
      </div>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(function() {
    jQuery('#cartForm').submit(function(e) {
      e.preventDefault();

      var quantity = $('#quantity').val();
      var itemId = $('#itemID').val();
      var userId = $('#userID').val();
      $.ajax({
        type: "POST",
        url: '/add',
        data: {
          quantity: quantity,
          itemID: itemId,
          userID: userId,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
          $('#successAlert').css({
            'display': 'block'
          });
          if (response.status == 'failed') {
            $('#successAlert').removeClass('alert-success');
            $('#successAlert').addClass('alert-warning');
            $('#successAlert').html(response.message);
          } else {
            $('#successAlert').html(response.message);
            $('#itemCount').html(response.count);
          }
        },
        error: function(data, textStatus, errorThrown) {
          $('#successAlert').removeClass('alert-success');
          $('#successAlert').addClass('alert-danger');
          $('#successAlert').css({
            'display': 'block'
          });
          $('#successAlert').html('Something Went wrong');
          console.log(errorThrown);
        },
      });
    });
  });
</script>
@endsection