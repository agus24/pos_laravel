<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request,$tipe)
    {
    	switch($tipe){
    		case 'item' :
    			return response()->json($this->item($request));
    			break;
            case 'adjustBarang' :
                return response()->json($this->adjustBarang($request));
                break;
    	}
    }

    private function item($request)
    {
    	if($request->ajax()){
    		$data = $request->input('data');
            $hsl = [];
    		$barang = new Barang;
    		$hasil = $barang
		    				->leftjoin('hargas','hargas.id','=','barangs.id_harga')
		    				->where('barangs.kode','like','%'.$data.'%')
		    				->orwhere('nama','like','%'.$data.'%')
		    				->select('barangs.*','hargas.harga as harga_beli')
		    				->get()
		    				->toArray();

    		foreach($hasil as $key => $value){
				$hsl[] = array(
								"label" => $value['kode']." ".$value['nama'],
								"value" => $value['id'],
								"harga" => $value['harga_beli']
							);
			}

    		return $hsl;
    	}
    	else{
    		abort('405');
    	}

    }

    private function adjustBarang($request)
    {

        if(!$request->ajax()){
            abort('405');
        }
        
        $id_barang = $request->input('id_barang');

        $stok = DB::table('v_stok')->where('id',$id_barang)->get();

        return $stok;

    }
}
