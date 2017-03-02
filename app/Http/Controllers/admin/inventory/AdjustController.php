<?php

namespace App\Http\Controllers\admin\inventory;

use App\Http\Controllers\Controller;
use App\model\Adjust;
use App\model\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdjustController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function valid($request){
        $this->validate($request,[
                                    "no_adjust" => "required",
                                    "date" => "required",
                                    "barang_id" => "required",
                                    "qty_awal" => "required",
                                    "qty" => "required",
                                    "qty_akhir" => "required"
                                ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Adjust::FindBarang()->paginate(15);
        $data = Adjust::FindBarang()->get();
        return view('inventory.adjustment.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::select('id as kiri','nama as kanan')->get()->toArray();
        $barang = $this->generateCombo($barang);
        $no_adjust = Adjust::getNewNoAdjust(Auth::user()->ware_id);
        return view('inventory.adjustment.add',['barang'=>$barang,'no_adjust'=>$no_adjust]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->valid($request);

        $adjust = new Adjust;

        $adjust->no_adjust  = $request->input('no_adjust');
        $adjust->date       = $request->input('date');
        $adjust->barang_id  = $request->input('barang_id');
        $adjust->qty_awal   = $request->input('qty_awal');
        $adjust->qty        = $request->input('qty');
        $adjust->qty_akhir  = $request->input('qty_akhir');
        $adjust->ware_id    = Auth::user()->ware_id;

        $adjust->insertStock(
                        $request->input('barang_id'),
                        $request->input('qty'),
                        $request->input('no_adjust')
                    );

        $adjust->save();

        return redirect('adjustment');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adjust = Adjust::findOrFail($id);
        $barang_id  = $adjust->barang_id;
        $qty        = $adjust->qty;
        $no_adjust  = $adjust->no_adjust;

        $adjust->deleteStock(
                            $barang_id,
                            $qty,
                            $no_adjust
                        );

        $adjust->delete();

        return redirect('adjustment');
    }
}
