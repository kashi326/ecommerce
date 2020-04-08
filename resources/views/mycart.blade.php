@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h2>My Cart <i class="fa fa-cart-arrow-down"></i></h2>
    </div>

    <div class="card-body">
      @if($errors->any())
      <div class="alert alert-danger">
        <h4>{{$errors->first()}}</h4>
      </div>
      @endif
      <div class="alert" id="itemRemovedResponse"></div>
      <div class="row justify-content-center">
        <div class="col-8">
          <input type="text" class="form-control w-25 pull-right mb-2" id="filterItem" placeholder="Search...">
          <table class="table table-striped table-condensed table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="itemTable">
              <form id="ItemRemovalForm">
                @csrf
                @foreach($itemincart as $value)
                <tr>
                  <th>{{ $value->itemDetail->title }}</th>
                  <th>{{$value->itemDetail->price }}</th>
                  <th class="w-25"><input type="number" value="{{$value->quantity}}" class="form-control" min="1"
                      max="5"></th>
                  <th class="w-25"><button onclick="confirmDelete({{$value->itemid}})"
                      class="btn btn-small btn-danger">Remove</button></th>
                </tr>
                @endforeach
              </form>
            </tbody>
          </table>
          <a href="{{ route('payment') }}" class="btn btn-medium btn-primary pull-right">Confirm Order</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete" class="modal fade"
  style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        <h4 id="myModalLabel" class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body" id="model_body">
        Are you sure, you want delete this item permanently?
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-primary" type="button" id="removeItem">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
var id = '';

function confirmDelete(localId) {
  $('#delete').modal('show');
  id = localId;
}
$(document).ready(function() {
      $("#filterItem").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#itemTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
      $('#removeItem').click(function(e) {
          e.preventDefault();
          $('#delete').modal('hide');
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
              type: "POST",
              url: '/removeItem',
              dataType: 'json',
              data: {
                'id': id
              },
              success: function(response) {
                $('#itemRemovedResponse').addClass('alert-success');
                $('#itemRemovedResponse').html('Item Removed from Cart successfully');
                $('#itemTable').empty();
                var tableRow = $('#itemTable');
                $('#itemCount').html(response.count);
                $.each(response.data, function(i, item) {
                  var button = $('<button onclick="confirmDelete("'+item.itemid+') class = "btn btn-small btn-danger" value="Remove"/>')
                      tableRow.append('<tr><td>' + item.itemDetail.title + '</td><td>' + item.itemDetail.price +
                        '</td><td class="w-25"><input type="number" value="'+item.quantity+'" class="form-control" min="1" max="5">' 
                        + '</td><td class = "w-25" ><button onclick="confirmDelete('+item.itemid+')"  class = "btn btn-small btn-danger">Remove</button> </td > < /tr>');
                      });
                  },
                  error: function(response) {
                    $('#itemRemovedResponse').addClass('alert-danger');
                    $('#itemRemovedResponse').html('Something went wrong. Please try again!!');
                  }
              });
          });
      });
</script>
@endsection