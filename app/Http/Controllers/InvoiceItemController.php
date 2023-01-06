<?php

namespace App\Http\Controllers;

use App\Helpers\InvoiceItem as HelpersInvoiceItem;
use App\Invoice;
use App\InvoiceItem;
use App\Product;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function index($invoiceID){
        $product_datas     = Product::pluck('name','productID');
        $invoiceItem_datas = Invoice::with(['rFrom', 'rFor','rItem', 'rItem.rProduct', 'rItem.rProduct.rType'])->find($invoiceID); 
        return view("invoice_item.index", compact("invoiceID","invoiceItem_datas", "product_datas"));
    }
    public function store(Request $request, $invoiceID){
        $request->validate([
            'itemId'    => 'required|unique:tb_invoice_item,itemId',
            'productId' => 'required',
            'quality'   => 'required',
        ]);
        $invoice_data = Invoice::find($invoiceID);
        if(!$invoice_data){
            return redirect()->route('invoice.index', $invoiceID)->with('warning', 'Create Item is failed. Data invoice is not found!!');
        } 
        $producet_data = Product::find($request->productId);
        if(!$producet_data){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Create Item is failed. Data product is not found!!');
        } 
        $newInvoiceItem = new InvoiceItem();
        $newInvoiceItem->itemID         =   $request->itemId;
        $newInvoiceItem->invoiceItemID  =   $invoiceID;
        $newInvoiceItem->productItemID  =   $request->productId;
        $newInvoiceItem->quality        =   $request->quality;
        $newInvoiceItem->price          =   $producet_data->price ? $producet_data->price : 0;
        $newInvoiceItem->save();

        HelpersInvoiceItem::generateTotalItem($invoiceID);
        return redirect()->route('invoice_detail.index', $invoiceID)->with('success', 'create success');
    }

    public function edit($invoiceID,$itemId){
        $product_datas     = Product::pluck('name','productID');
        $invoiceItem_datas = Invoice::with(['rFrom', 'rFor','rItem', 'rItem.rProduct', 'rItem.rProduct.rType'])
                ->whereHas('rItem', function($q) use ($itemId){
                    $q->where('itemId',$itemId);
                })->find($invoiceID); 
        return view("invoice_item.index", compact("invoiceID", "itemId","invoiceItem_datas", "product_datas"));
    }

    public function update(Request $request, $invoiceID, $itemId){
        $request->validate([
            'productId' => 'required',
            'quality'   => 'required',
        ]);
        $invoice_data = Invoice::find($invoiceID);
        if(!$invoice_data){
            return redirect()->route('invoice.index', $invoiceID)->with('warning', 'Update Item is failed. Data invoice is not found!!');
        } 
        $producet_data = Product::find($request->productId);
        if(!$producet_data){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Update Item is failed. Data product is not found!!');
        } 
        $updateInvoiceItem = InvoiceItem::find($itemId);
        if(!$updateInvoiceItem){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Update Item is failed. Data item is not found!!');
        } 
        $updateInvoiceItem->productItemID   =   $request->productId;
        $updateInvoiceItem->quality         =   $request->quality;
        $updateInvoiceItem->price           =   $producet_data->price ? $producet_data->price : 0;
        $updateInvoiceItem->save();

        HelpersInvoiceItem::generateTotalItem($invoiceID);
        return redirect()->route('invoice_detail.index', $invoiceID)->with('success', 'Update success');
    }
    public function delete($invoiceID, $itemId){
        $invoice_data = Invoice::find($invoiceID);
        if(!$invoice_data){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Delete Item is failed. Data invoice is not found!!');
        } 
        $invoiceItem_data = InvoiceItem::find($itemId);
        if(!$invoiceItem_data){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Delete Item is failed. Data invoice is not found!!');
        }
        $invoiceItem_data->delete();
        HelpersInvoiceItem::generateTotalItem($invoiceID);
        return redirect()->route('invoice_detail.index', $invoiceID)->with('success', 'Delete success');
    }

    public function updateStatus(Request $request, $invoiceID){
        $request->validate([
            'status'  => 'required',
        ]);
        $invoice_data = Invoice::find($invoiceID);
        if(!$invoice_data){
            return redirect()->route('invoice_detail.index', $invoiceID)->with('warning', 'Update Item is failed. Data invoice is not found!!');
        } 
        $invoice_data->status = $request->status;
        $invoice_data->update();
        return redirect()->route('invoice_detail.index', $invoiceID)->with('success', 'Pay success');
        
    }
}
