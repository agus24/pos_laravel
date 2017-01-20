<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';
    protected $primaryKey = 'id';
    protected $fillable = [
	    "kode",
	    "harga"
    ];
    
}
