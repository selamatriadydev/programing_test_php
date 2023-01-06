@extends('layout.app')

@section('title', "Request API")
@section('headingTitle', "Request API")

@section("content") 
<table class="table table-striped">
    <thead>
        <tr>
            <th>URL</th>
            <th>Method</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>http://localhost:8000/api/invoice</td>
            <td>GET</td>
        </tr>
        <tr>
            <td>http://localhost:8000/api/invoice/{idInvoice}</td>
            <td>GET</td>
        </tr>
    </tbody>
</table>
@endsection