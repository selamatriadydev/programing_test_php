@extends('layout.app')

@section('title', "Edit")
@section('headingTitle', "Edit Company")

@section("content") 
<a href="{{ route("params.client.index") }}" class="btn btn-secondary">See All Company</a>
<form action="{{ route('params.client.update', $params_data->clientID) }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="clientId" class="form-label">Company ID:</label>
    <strong>{{ $params_data->companyID }}</strong>
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name', $params_data->name) }}">
    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ old('email', $params_data->email) }}">
    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ old('address', $params_data->address) }}">
    @error('address') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection