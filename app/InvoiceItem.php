<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = "tb_invoice_item";
    protected $primaryKey ="itemID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["itemID", "invoiceItemID", "productItemID", "quality","price"];

    public function rProduct(){
        return $this->hasOne(Product::class, 'productID','productItemID');
    }
    public function rInventory(){
        return $this->hasMany(Invoice::class, 'invoiceID', 'invoiceItemID');
    }


    public function getSubtotalAttribute()
    {
        return number_format($this->quality * $this->price, 2);
    }


}
