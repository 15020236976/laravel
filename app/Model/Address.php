<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey='address_id';
    protected $table='address';
    protected $guarded = [];
}
