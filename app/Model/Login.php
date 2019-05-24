<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $primaryKey='u_id';
    protected $table='user';
    protected $guarded = [];
}
