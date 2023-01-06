<?php
namespace App\Helpers;

use App\Invoice;
use App\InvoiceItem as AppInvoiceItem;

class InvoiceItem {

    public static function generateTotalItem($invoiceItemID)
    {
        $invoice_item = AppInvoiceItem::where('invoiceItemID', $invoiceItemID)->get();
        $total = $invoice_item->sum(function($i) {
            return $i->price * $i->quality;
        });
        $tax = ($total * 10) / 100;
        $pay = $total+$tax;
        $invoice = Invoice::find($invoiceItemID);
        $invoice->total = $total;
        $invoice->pay = $pay;
        $invoice->update();
    }
}