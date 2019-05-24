<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey='order_id';
    protected $table='order';
    protected $guarded = [];
}
