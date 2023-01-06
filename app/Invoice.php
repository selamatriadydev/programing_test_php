<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "tb_invoice";
    protected $primaryKey ="invoiceID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["invoiceID", "fromId", "forId", "issueDate","dueDate","subject", "total", "pay", "status"];

    public function rFrom(){
        return $this->hasOne(Company::class, 'companyID','fromId');
    }

    public function rFor(){
        return $this->hasOne(Client::class, 'clientID', 'forId');
    }

    public function rItem(){
        return $this->hasMany(InvoiceItem::class, 'invoiceItemID', 'invoiceID');
    }

    public function getTaxAttribute()
    {
        return ($this->total * 10) / 100;
    }

    public function getTotalPriceAttribute()
    {
        return ($this->total + (($this->total * 10) / 100));
    }

    public function getAmountDueAttribute()
    {
        return "0";
    }
}
