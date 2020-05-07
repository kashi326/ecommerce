@extends('layouts.app')

@section('content')
<div class="container mt-3">
  <form id="paymentForm">
    @csrf
    <input type="text" value="creditCard" name="paymentMethod" id="paymentMethod" hidden>
    <div class="card">
      <div class="card-header">
        <h2>Payment</h2>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#CreditCard">Credit Card <i class="fa fa-credit-card"></i> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#COD">Cash on Delivery</a>
          </li>
        </ul>

        <div class="tab-content">
          <div id="CreditCard" class="container tab-pane active"><br>
            <div class="row justify-content-center">
              <div class="col-12 col-md-5">
                <div class="form-group">
                  <label for="" class="bmd-label-floating">Name on Card</label>
                  <input type="text" class="form-control" id="nameOnCard" name="nameOnCard">
                  <div id="nameOnCardError"></div>
                </div>
                <div class="form-group">
                  <label for="">Card Number</label>
                  <input type="number" class="form-control" id="cardNumber" name="cardNumber">
                  <div id="cardNumberError"></div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="">CVC</label>
                      <input type="text" class="form-control" id="cvc" name="cvc">
                      <div id="cvcError"></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="">Expiration</label>
                      <input type="text" class="form-control" placeholder="MM" id="cardExpMonth" name="cardExpMonth">
                      <div id="cardExpMonthError"></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <input type="text" class="form-control" placeholder="YYYY" id="cardExpYear" name="cardExpYear">
                      <div id="cardExpYearError"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-raised btn-secondary w-100">Total:Rs {{$total}}</button>
                </div>
              </div>
            </div>
          </div>
          <div id="COD" class="container tab-pane fade"><br>
            <div class="row  justify-content-center">
              <div class="col-md-6">
                <h5>Cash on Delivery
                  <i class="fa fa-check-circle pull-right" aria-hidden="true"></i></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-header">
        <h4>Shipment Detail</h4>
      </div>
      <div class="card-body">
        <div class="row  justify-content-center">
          <div class="col-md-8">
            <div class="form-group form-inline">
              <label for="">Customer Name</label>
              <input type="text" name="customerName" class="form-control w-75 ml-auto" id="customerName"
                value="{{ $user->name }}">
              <div id="customerNameError"></div>
            </div>
            <div class="form-group form-inline">
              <label for="">Email</label>
              <input type="text" name="customerEmail" class="form-control w-75 ml-auto" id="customerEmail"
                value="{{ $user->email }}">
              <div id="customerEmailError"></div>
            </div>
            <div class="form-group form-inline">
              <label for="">Shipment Address</label>
              <input type="text" name="customerShipmentAddress" class="form-control w-75 ml-auto" id="customerAddress"
                value="{{ $user->address }}">
              <div id="customerShipmentAddressError"></div>
            </div>
            <div class="form-group form-inline">
              <label for="">Contact Info</label>
              <input type="text" name="customerContact" class="form-control w-75 ml-auto" id="customerContact"
                value="{{ $user->contact }}">
              <div id="customerContactError"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-header">
        <h4>Product Detail</h4>
      </div>
      <div class="card-body">
        <div class="row justify-content-center">
          <div class="col-8">
            <table class="table table-striped table-condensed">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total per Item</th>
                </tr>
              </thead>
              <tbody id="itemTable">
                <form>
                  @foreach($data as $value)
                  <tr>
                    <th>{{ $value->itemDetail->title }}</th>
                    <th>{{$value->itemDetail->price }}</th>
                    <th class="w-25"><input type="number" value="{{ $value->quantity }}"
                        class="form-control form-control-sm" min="1" max="5" disabled></th>
                    <th>{{ $value->quantity * $value->itemDetail->price }}</th>
                  </tr>
                  @endforeach
                </form>
              </tbody>
            </table>
            <button type="submit" class="btn btn-raised btn-small btn-primary pull-right" id="checkout" value="submit">Check Out</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
$(document).ready(function() {
  $(".nav-tabs a").click(function() {
    $(this).tab('show');
    if ($('#paymentMethod').val() == 'creditCard') {
      $('#paymentMethod').val('COD');
    } else {
      $('#paymentMethod').val('creditCard');
    }
  });
  $('#checkout').click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '/checkout',
      dataType: 'json',
      data: $('#paymentForm').serialize(),
      success: function(response) {
        
      },
      error: function(data, textStatus, errorThrown) {
        var resp = data.responseJSON;
        var errors = resp.errors;
        for (var x in errors) {
          $('input[name="' + x + '"]').addClass('alert').addClass('alert-danger');
          $('#' + x + 'Error').css({
            'color': 'red'
          });
          $('#' + x + 'Error').html(errors[x]);
        }
      }
    });
  });
});
</script>
@endsection