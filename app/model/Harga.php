<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'hargas';
    protected $fillable = [
    	'kode',
    	'harga'
    ];
}
