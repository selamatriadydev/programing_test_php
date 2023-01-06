<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice(){
        $invoice_datas = Invoice::with(['rFrom', 'rFor'])->withCount('rItem')->get(); 
        if(!$invoice_datas){
            return response()->json(['Message' => 'Data not found']);
        }
        return response()->json($invoice_datas);
    }

    public function invoiceItem($invoiceID){
        $invoiceItem_datas = Invoice::with(['rFrom', 'rFor','rItem', 'rItem.rProduct', 'rItem.rProduct.rType'])->find($invoiceID); 
        if(!$invoiceItem_datas){
            return response()->json(['message' => 'Data not found']);
        }
        return response()->json($invoiceItem_datas);
    }
}
