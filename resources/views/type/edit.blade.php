@extends('layout.app')

@section('title', "Edit")
@section('headingTitle', "Edit Type")

@section("content") 
<a href="{{ route("params.type.index") }}" class="btn btn-secondary">See All Type</a>
<form action="{{ route('params.type.update', $params_data->typeID) }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="typeId" class="form-label">Type ID:</label>
    <strong>{{ $params_data->typeID }}</strong>
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name', $params_data->name) }}">
    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection