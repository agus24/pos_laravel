<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kartu extends Model
{
    use SoftDeletes;

    protected $table = 'kartus';
    protected $primaryKey = 'id';
    protected $fillable = [
    	'name',
    ];
}
