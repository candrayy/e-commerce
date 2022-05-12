<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Ongkir;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::paginate(5);
        $dtOngkir = Ongkir::all();
        $dtProduk = Produk::all();
        $dtUser = User::all();
        
        return view('admin.order.order', compact('transaksi', 'dtOngkir', 'dtProduk', 'dtUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $dtOrder = Transaksi::findorfail($id);
       
        return view('admin.order.edit-order', compact('dtOrder'));
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
        $dtOrder = Transaksi::findorfail($id);
        $dtOrder->update([
            'status' => $request->status,
            'resi' => $request->resi,
        ]);
        
        if($request->status == 'Expired') {
            foreach(json_decode($dtOrder['qty']) as $key => $qty){
                Produk::where('nama_produk', $dtOrder['nama_produk'][$key])->increment('kuantitas', json_decode($qty));
            }
        }
        return redirect('order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return back();
    }
}
