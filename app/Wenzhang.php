<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wenzhang extends Model
{
    protected $primaryKey='id';
    protected $table='wenzhang';
    protected $fillable=[
    	'tatle',
    	'c_id',
    	'zyx',
    	'isshow',
    	'man',
    	'email',
    	'gjz',
    	'desc',
    	'file',
        'created_at',
        'updated_at',

    ];
}
