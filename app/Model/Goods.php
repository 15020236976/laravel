<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $primaryKey='goods_id';
    protected $table='goods';
    protected $guarded = [];
}
