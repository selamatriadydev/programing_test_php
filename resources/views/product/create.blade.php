@extends('layout.app')

@section('title', "Create")
@section('headingTitle', "Create Product")

@section("content") 
<a href="{{ route("params.product.index") }}" class="btn btn-secondary">See All Product</a>
<form action="{{ route('params.product.store') }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="productId" class="form-label">Product ID:</label>
    <input type="text" class="form-control" id="productId" placeholder="Enter Product ID" name="productId" value="{{ old('productId') }}">
    @error('productId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="typeId" class="form-label">Type:</label>
    <select name="typeId" id="typeId" class="form-control">
      <option value="">Select Type</option>
      @foreach ($type_datas as $key=>$item)
      <option value="{{ $key }}" {{ old('typeId') == $key ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
    </select>
    @error('typeId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Price:</label>
    <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price" value="{{ old('price') }}">
    @error('price') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection