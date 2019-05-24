<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User1 extends Model
{
    protected $primaryKey='id';
    protected $table='user1';
    protected $fillable=[
    	'name',
    	'pwd',
    	'email',
    	'created_at',
    	'update_at',

    ];
}
