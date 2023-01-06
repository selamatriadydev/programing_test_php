@extends('layout.app')

@section('title', "List Item")
@section('headingTitle', "List Item")

@section("content") 
<a href="{{ route("invoice.index") }}" class="btn btn-secondary">See All Invoice</a>
<div class="row">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoiceItem_datas->rItem as $item)
                    @if (isset($itemId) && $item->itemID === $itemId)
                        <form action="{{ route('invoice_detail.update', [$invoiceID, $itemId]) }}" method="POST">
                            @csrf
                            <tr>
                                <td colspan="2">
                                    <select class="form-control" name="productId" id="productId">
                                        <option value=""> Select Product</option>
                                        @foreach ($product_datas as $key=>$product)
                                            <option value="{{ $key }}" {{ old('productId', $item->productItemID) == $key ? 'selected' : '' }}>{{ $product }}</option>
                                        @endforeach
                                    </select>
                                    @error('product') <span class="text-danger">{{ $message }}</span>@enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="quality" placeholder="Enter Quality" name="quality" value="{{ old('quality', $item->quality) }}">
                                    @error('quality') <span class="text-danger">{{ $message }}</span>@enderror
                                </td>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                </td>
                            </tr>
                        </form>
                    @else
                        <tr>
                            <td>{{ $item->rProduct->rType->name }}</td>
                            <td>{{ $item->rProduct->name }}</td>
                            <td>{{ $item->quality }}</td>
                            <td>£{{ number_format($item->price, 2) }}</td>
                            <td>£{{ $item->subtotal }}</td>
                            <td>
                                <a href="{{ route('invoice_detail.edit', [$invoiceItem_datas->invoiceID, $item->itemID]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('invoice_detail.delete', [$invoiceItem_datas->invoiceID, $item->itemID]) }}" onclick="return confirm('Are you sure delete this data?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Sorry! Result is not found.</td>
                    </tr>
                @endforelse
                @if (isset($itemId))
                @else
                    <form action="{{ route('invoice_detail.store', $invoiceID) }}" method="POST">
                        @csrf
                        <tr>
                            <td>
                                <input type="text" class="form-control" id="itemId" placeholder="Enter Item Id" name="itemId" value="{{ old('itemId') }}">
                                @error('itemId') <span class="text-danger">{{ $message }}</span>@enderror
                            </td>
                            <td>
                                <select class="form-control" name="productId" id="productId">
                                    <option value=""> Select Product</option>
                                    @foreach ($product_datas as $key=>$product)
                                        <option value="{{ $key }}" {{ old('productId') == $key ? 'selected' : '' }}>{{ $product }}</option>
                                    @endforeach
                                </select>
                                @error('product') <span class="text-danger">{{ $message }}</span>@enderror
                            </td>
                            <td>
                                <input type="text" class="form-control" id="quality" placeholder="Enter Quality" name="quality" value="{{ old('quality') }}">
                                @error('quality') <span class="text-danger">{{ $message }}</span>@enderror
                            </td>
                            <td colspan="3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </td>
                        </tr>
                    </form>
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-4 offset-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <td>SubTotal</td>
                    <td><strong>£{{ number_format($invoiceItem_datas->total, 2) }}</strong></td>
                </tr>
                <tr>
                    <td>Tax (10%)</td>
                    <td><strong>£{{ number_format($invoiceItem_datas->tax, 2) }}</strong></td>
                </tr>
                <form action="{{ route('invoice_detail.updateStatus', $invoiceID) }}" method="POST">
                    @csrf
                    <tr>
                        <td>Payments</td>
                        <td><strong>-£{{ number_format($invoiceItem_datas->pay, 2) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select class="form-control" name="status" id="status">
                                <option value="Pending" {{ old('status', $invoiceItem_datas->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Paid" {{ old('status', $invoiceItem_datas->status) == 'Paid' ? 'selected' : '' }}>Paid</option>
                              </select>
                            @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="btn btn-primary">Save</button></td>
                    </tr>
                </form>
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Amount Due</strong></td>
                    <td><strong>£{{ number_format($invoiceItem_datas->amount_due, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection