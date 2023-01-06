@extends('layout.app')

@section('title', "List Product")
@section('headingTitle', "List Product")

@section("content") 
    <a href="{{ route("invoice.create") }}" class="btn btn-success">Add</a>
    <div class="row">
        <div class="col-md-12 mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>invoiceID</th>
                        <th>Subject</th>
                        <th>From</th>
                        <th>For</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Invoice Items</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoice_datas as $item)
                        <tr>
                            <td>{{ $item->invoiceID }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>{{ $item->rFrom->name }}</td>
                            <td>{{ $item->rFor->name }}</td>
                            <td class="text-right"> <strong>£{{ number_format($item->total, 2) }}</strong></td>
                            <td> <span class="badge bg-{{ $item->status=='Paid' ? 'success' : 'danger' }}">{{ $item->status }}</span> </td>
                            <td class="text-center">
                                <a href="{{ route('invoice_detail.index', $item->invoiceID) }}" class="btn btn-{{ $item->r_item_count ? 'info' : 'secondary' }}">{{ $item->r_item_count }}</a>
                            </td>
                            <td>
                                <a href="{{ route('invoice.edit', $item->invoiceID) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('invoice.delete', $item->invoiceID) }}" onclick="return confirm('Are you sure delete this data?')" class="btn btn-danger">Delete</a>
                                <a href="{{ route('invoice.show', $item->invoiceID) }}" class="btn btn-secondary">Detail</a>
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
                {{ $invoice_datas->links() }}
            </div>
        </div>
    </div>
@endsection