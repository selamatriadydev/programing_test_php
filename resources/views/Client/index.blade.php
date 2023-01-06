@extends('layout.app')

@section('title', "List Client")
@section('headingTitle', "List Client")

@section("content") 
    <a href="{{ route("params.client.create") }}" class="btn btn-success">Add</a>
    <div class="row">
        <div class="col-md-12 mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($params_datas as $item)
                        <tr>
                            <td>{{ $item->clientID }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                <a href="{{ route('params.client.edit', $item->clientID) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('params.client.delete', $item->clientID) }}" onclick="return confirm('Are you sure delete this data?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Sorry! Result is not found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-4 offset-md-8">
            <div class="float-right">
                {{ $params_datas->links() }}
            </div>
        </div>
    </div>
@endsection