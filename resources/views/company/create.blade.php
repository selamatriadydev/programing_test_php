@extends('layout.app')

@section('title', "Create")
@section('headingTitle', "Create Company")

@section("content") 
<a href="{{ route("params.client.index") }}" class="btn btn-secondary">See All Company</a>
<form action="{{ route('params.client.store') }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="companyId" class="form-label">Company ID:</label>
    <input type="text" class="form-control" id="companyId" placeholder="Enter Company ID" name="companyId" value="{{ old('companyId') }}">
    @error('companyId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">
    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ old('address') }}">
    @error('address') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection