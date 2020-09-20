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
        <div class="card-header info-card-header ">
          <h3>New Product</h3>
        </div>
        <div class="card-body">
          @error('success')
          <div class="alert alert-success">
            <h4>{{$message}}</h4>
          </div>
          @enderror
          <form action="{{route('newproduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="md-form ">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
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
              <textarea name="description" id="description" rows="3" class="md-textarea form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
              @error('description')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror

            </div>

            <div class="md-form ">
              <label for="instruction">Instruction</label>
              <textarea name="instruction" id="instruction" cols="30" class="md-textarea form-control @error('instruction') is-invalid @enderror" value="{{ old('instruction') }}"></textarea>
              @error('instruction')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror

            </div>

            <div class="md-form ">
              <label for="Specification">Specification</label>
              <textarea name="specification" id="Specification" cols="30" class="md-textarea form-control" value="{{ old('specification') }}"></textarea>
            </div>

            <div class="md-form">
              <label for="price">Price</label>
              <input type="number" name="price" id="price" min="1" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
              @error('price')
              <span class="error-feedback" role="alert">
                {{ $message }}
              </span>
              @enderror
            </div>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFilethumbnail">Thumbnail</span>
              </div>
              <div class="custom-file">
                <input type="file" accept="image/*" class="custom-file-input @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail') }}" id="thumbnail" aria-describedby="inputGroupFilethumbnail">
                <label class="custom-file-label" for="thumbnail">Choose file</label>
              </div>&nbsp;
              <a data-toggle="tooltip" title="Thumbnail will be used to feature product">
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
              </a>
            </div>
            @error('thumbnail')
            <span class="error-feedback" role="alert">
              {{ $message }}
            </span>
            @enderror
            <br>


            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFiledetailimages">Product Images</span>
              </div>
              <div class="custom-file">
                <input type="file" accept="image/*" class="custom-file-input @error('detailimages') is-invalid @enderror" name="detailimages[]" value="{{ old('detailimages') }}" id="detailimages" multiple>
                <label class="custom-file-label" for="detailimages">Choose file</label>
              </div>&nbsp;
              <a data-toggle="tooltip" title="Product Pictures are detail pictures of product for customer to have best better view">
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
              </a>
            </div>

            @error('detailimages')
            <span class="error-feedback" role="alert">
              {{ $message }}
            </span>
            @enderror


            <div class="md-form ">
              <input type="submit" name="submit" class="btn btn-raised btn-primary w-100" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection