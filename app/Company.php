<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "tb_company";
    protected $primaryKey ="companyID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["companyID", "name", "email", "address"];
}
