@extends('seller.layouts.app')

@section('sellercontent')
<style>
  .error-feedback {
    color: red;
    font-family: 'Segoe UI', 'Calibri', 'Trebuchet MS', sans-serif;
    font-style: italic;
    font-size: 14px;
  }
</style>
<div class="container ">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <h3 class="card-header info-card-header">
          Update Product
        </h3>
        <div class="card-body">
          <form action="{{route('edititem',$product->id)}}" method="post">
          @method('put')  
          @csrf
            <div class="md-form ">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="{{ $product->title }}">
              <div>
                @error('title')
                <span class="error-feedback" role="alert">
                  {{ $message }}
                </span>
                @enderror
              </div>
            </div>

            <div class="md-form ">
              <label for="description">Description</label>
              <textarea name="description" id="description" rows="3" class="md-textarea form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" placeholder="{{ $product->description }}"></textarea>
              @error('description')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror

            </div>

            <div class="md-form ">
              <label for="instruction">Instruction</label>
              <textarea name="instruction" id="instruction" cols="30" class="md-textarea form-control @error('instruction') is-invalid @enderror" value="{{ old('instruction') }}" placeholder="{{ $product->instruction }}"></textarea>
              @error('instruction')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror

            </div>

            <div class="md-form ">
              <label for="Specification">Specification</label>
              <textarea name="specification" id="Specification" cols="30" class="md-textarea form-control" value="{{ old('specification') }}" placeholder="{{ $product->specification }}"></textarea>
            </div>

            <div class="md-form">
              <label for="price">Price</label>
              <input type="number" name="price" id="price" min="1" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="{{ $product->price }}">
              @error('price')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>
            
              <input type="submit" name="submit" class="btn button-rounded primary-gradient" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection