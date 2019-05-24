<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey='id';
    protected $table='Comment';
    protected $guarded = [];
}
