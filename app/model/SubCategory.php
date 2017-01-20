<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
    	"name"
    ];
}
