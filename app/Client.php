<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "tb_client";
    protected $primaryKey ="clientID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["clientID", "name", "email", "address"];

    public function rInvoice(){
        return $this->belongsTo(Invoice::class, 'clientID');
    }
}
