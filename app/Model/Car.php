<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $primaryKey='cart_id';
    protected $table='cart';
    protected $guarded = [];
}
