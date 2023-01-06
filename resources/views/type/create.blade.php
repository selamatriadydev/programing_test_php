@extends('layout.app')

@section('title', "Create")
@section('headingTitle', "Create Type")

@section("content") 
<a href="{{ route("params.type.index") }}" class="btn btn-secondary">See All Type</a>
<form action="{{ route('params.type.store') }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="typeId" class="form-label">Type ID:</label>
    <input type="text" class="form-control" id="typeId" placeholder="Enter Type ID" name="typeId" value="{{ old('typeId') }}">
    @error('typeId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection