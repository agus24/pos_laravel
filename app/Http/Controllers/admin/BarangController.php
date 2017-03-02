<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Barang;
use App\model\Category;
use App\model\Harga;
use App\model\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    private $cmbCategory;
    private $cmbSubCategory;
    private $cmbHarga;
    private $kirim;


    public function __construct()
    {
        $this->middleware('auth');
        $this->cmbCategory         = $this->generateCombo(Category::combo());
        $this->cmbSubCategory      = $this->generateCombo(SubCategory::combo());
        $this->cmbHarga            = $this->generateCombo(Harga::combo());

        $category       = $this->cmbCategory;
        $subCategory    = $this->cmbSubCategory;
        $harga          = $this->cmbHarga;
        $lastID         = Barang::orderby('id','desc')->limit('1')->select('id')->get()->toArray();

        $this->kirim = [
                    "category" => $category,
                    "subCategory" => $subCategory,
                    "harga" => $harga,
                    "lastID" => empty($lastID)?1:$lastID
                ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::joinAll()->get();
        return view('master.barang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('master.barang.add',$this->kirim);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "kode"          => "required|unique:barangs",
            "nama"          => "required",
            "id_harga"         => "required|numeric",
            "id_category"      => "required|numeric",
            "id_subcategory"   => "required|numeric",
            "harga"   => "required|numeric",
        ]);

        $barang = new Barang;

        $barang->kode = $request->input('kode');
        $barang->nama = $request->input('nama');
        $barang->id_harga = $request->input('id_harga');
        $barang->id_category = $request->input('id_category');
        $barang->id_subcategory = $request->input('id_subcategory');
        $barang->harga = $request->input('harga');
        $barang->save();

        return redirect('barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->kirim['barang'] = $barang;
        return view('master.barang.edit',$this->kirim);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "kode"              => "required",
            "nama"              => "required",
            "id_harga"          => "required|numeric",
            "id_category"       => "required|numeric",
            "id_subcategory"    => "required|numeric",
            "harga"    => "required|numeric",
        ]);

        $barang = Barang::findOrFail($id);

        $barang->kode = $request->input('kode');
        $barang->nama = $request->input('nama');
        $barang->id_harga = $request->input('id_harga');
        $barang->id_category = $request->input('id_category');
        $barang->id_subcategory = $request->input('id_subcategory');
        $barang->harga = $request->input('harga');
        $barang->save();

        return redirect('barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('barang');
    }
}
