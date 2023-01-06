@extends('layout.app')

@section('title', "Create")
@section('headingTitle', "Create Product")

@section("content") 
<a href="{{ route("invoice.index") }}" class="btn btn-secondary">See All Invoice</a>
<form action="{{ route('invoice.store') }}" method="POST">
  @csrf
  <div class="mb-3 mt-3">
    <label for="invoiceId" class="form-label">Invoice ID:</label>
    <input type="text" class="form-control" id="invoiceId" placeholder="Enter invoice ID" name="invoiceId" value="{{ old('invoiceId') }}">
    @error('invoiceId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="subject" class="form-label">Subject:</label>
    <input type="text" class="form-control" id="subject" placeholder="Enter Subject" name="subject" value="{{ old('subject') }}">
    @error('subject') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="fromId" class="form-label">From:</label>
    <select class="form-control" name="fromId" id="fromId">
      <option value=""> Select From</option>
      @foreach ($company_datas as $key=>$item)
          <option value="{{ $key }}" {{ old('fromId') == $key ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
    </select>
    @error('fromId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="forId" class="form-label">To:</label>
    <select class="form-control" name="forId" id="forId">
      <option value=""> Select To</option>
      @foreach ($client_datas as $key=>$item)
          <option value="{{ $key }}" {{ old('forId') == $key ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
    </select>
    @error('forId') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <div class="mb-3">
    <label for="dueDate" class="form-label">Due Date:</label>
    <input type="date" class="form-control" id="dueDate" placeholder="Enter Due Date" name="dueDate" value="{{ old('dueDate') }}">
    @error('dueDate') <span class="text-danger">{{ $message }}</span>@enderror
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection