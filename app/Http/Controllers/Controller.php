<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function generateCombo($array)
    {

    	$hasil[''] = 'Select';
    	foreach($array as $key => $value){
    		$hasil[$value['kiri']] = $value['kanan'];
    	}
    	return $hasil;

    }
}
