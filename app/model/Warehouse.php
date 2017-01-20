<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name', 
        'address'
    ];

    protected $table 		= "warehouses";
    protected $primaryKey 	= "id";
}
