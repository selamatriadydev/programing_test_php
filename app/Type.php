<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = "tb_type";
    protected $primaryKey ="typeID";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ["typeID", "name"];
}
