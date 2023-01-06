<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "tb_product";
    protected $primaryKey ="productID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["productID", "name", "itemTypeID", "price", "stock"];

    public function rInvoiceItem(){
        return $this->belongsTo(InvoiceItem::class,'productItemID', 'productID');
    }

    public function rType(){
        return $this->hasOne(Type::class, 'typeID','itemTypeID');
    }
}
