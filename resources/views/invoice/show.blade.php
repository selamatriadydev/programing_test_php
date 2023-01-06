@extends('layout.app')

@section('title', "Detail Invoice")
@section('headingTitle', "Detail Invoice")

@section("content") 
<div class="row">
    <div class="col-md-6">
        <a href="{{ route("invoice.index") }}" class="btn btn-secondary">See All Invoice</a>
    </div>
    <div class="col-md-6">
        <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
            <button type="button" class="btn btn-danger">PDF</button>
            <button type="button" class="btn btn-secondary">Print</button>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table">
            <tr>
                <td width="20%" style="border: none;">Invoice ID</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->invoiceID }}</td>
            </tr>
            <tr>
                <td style="border: none;">Issue Date</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->issueDate }}</td>
            </tr>
            <tr>
                <td style="border: none;">Due Date</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->dueDate }}</td>
            </tr>
            <tr>
                <td style="border: none;">Subject</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->subject }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-3 offset-3" >
        <table class="table">
            <tr>
                <td style="border: none;" width="30%">From</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->rFrom->name }}</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->rFrom->address }}</td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td style="border: none;" width="30%">To</td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->rFor->name }}</td>
            </tr>
            <tr>
                <td style="border: none;"></td>
                <td style="border: none;border-left: 1px solid black;">{{ $invoiceItem_datas->rFor->address }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Item Type</th>
                    <th>Description</th>
                    <th>Quality</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoiceItem_datas->rItem as $item)
                    <tr>
                        <td>{{ $item->rProduct->rType->name }}</td>
                        <td>{{ $item->rProduct->name }}</td>
                        <td style="text-align: right;">{{ $item->quality }}</td>
                        <td style="text-align: right;">£{{ number_format($item->price, 2) }}</td>
                        <td style="text-align: right;">£{{ $item->subtotal }}</td>
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
        <table class="table">
            <tbody>
                <tr style="text-align: right;">
                    <td style="border: none;">SubTotal</td>
                    <td style="border: none;"><strong>£{{ number_format($invoiceItem_datas->total, 2) }}</strong></td>
                </tr>
                <tr style="text-align: right;">
                    <td style="border: none;">Tax (10%)</td>
                    <td style="border: none;"><strong>£{{ number_format($invoiceItem_datas->tax, 2) }}</strong></td>
                </tr>
                <tr style="text-align: right;">
                    <td style="border: none;">Payments</td>
                    <td style="border: none;"><strong>-£{{ number_format($invoiceItem_datas->pay, 2) }}</strong>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr style="text-align: right;">
                    <td style="border: none;"><strong>Amount Due</strong></td>
                    <td style="border: none;"><strong>£{{ number_format($invoiceItem_datas->amount_due, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection