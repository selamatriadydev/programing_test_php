<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request){
        $invoice_datas = Invoice::withCount('rItem')->paginate(10); 
        return view("invoice.index", compact("invoice_datas"));
    }

    public function create(){
        $company_datas  = Company::pluck('name', 'companyID');
        $client_datas   = Client::pluck('name', 'clientID');
        return view("invoice.create", compact('company_datas','client_datas'));
    }

    public function store(Request $request){
        $request->validate([
            'invoiceId' => 'required|unique:tb_invoice,invoiceId',
            'dueDate'   => 'required|date',
            'fromId'    => 'required',
            'forId'     => 'required',
            'subject'   => 'required'
        ]);

        $newInvoice = new Invoice();
        $newInvoice->invoiceID  =   $request->invoiceId;
        $newInvoice->fromId     =   $request->fromId;
        $newInvoice->forId      =   $request->forId;
        $newInvoice->issueDate  =  date('Y-m-d');
        $newInvoice->dueDate    =   $request->dueDate;
        $newInvoice->subject    =   $request->subject;
        $newInvoice->status     =   "Pending";
        $newInvoice->save();
        $invoiceID = $newInvoice->invoiceID;

        return redirect()->route('invoice_detail.index', $invoiceID)->with('success', 'create success');
    }

    public function show($id){
        $invoiceItem_datas = Invoice::with(['rFrom', 'rFor','rItem', 'rItem.rProduct', 'rItem.rProduct.rType'])->find($id); 
        return view("invoice.show", compact('invoiceItem_datas'));
    }

    public function edit($id){
        $invoice_data   = Invoice::find($id);
        $company_datas  = Company::pluck('name', 'companyID');
        $client_datas   = Client::pluck('name', 'clientID');
        return view("invoice.edit", compact('invoice_data','company_datas','client_datas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'dueDate'   => 'required|date',
            'fromId'    => 'required',
            'forId'     => 'required',
            'subject'   => 'required'
        ]);

        $invoice_update = Invoice::find($id);
        if(!$invoice_update){
            return redirect()->route('invoice.index')->with('warning', 'Update is failed. Data is not found!!');
        }
        $invoice_update->fromId = $request->fromId;
        $invoice_update->forId  = $request->forId;
        $invoice_update->dueDate= $request->dueDate;
        $invoice_update->subject= $request->subject;
        $invoice_update->update();
        return redirect()->route('invoice.index')->with('success', 'update success');
    }

    public function delete($id){
        $invoice_data = Invoice::find($id);
        if(!$invoice_data){
            return redirect()->route('invoice.index')->with('warning', 'Delete is failed. Data is not found!!');
        }
        $invoice_data->delete();
        $invoiceItem_data = InvoiceItem::where('invoiceItemID', $id)->first();
        if($invoiceItem_data){
            InvoiceItem::where('invoiceItemID', $id)->delete();
        }
        return redirect()->route('invoice.index')->with('success', 'Delete success');
    }
}
