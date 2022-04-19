<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Ongkir;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtKeranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        $dtOngkir = Ongkir::all();
        $dtCount = Keranjang::where('user_id', Auth::id())->count();
        // $dtProduk = Produk::select('id', 'nama', 'harga')->where('id', $dtKeranjang);
        // dd($dtKeranjang);
        return view('user.transaksi.transaksi', compact('dtKeranjang', 'dtOngkir', 'dtCount'));
    }

    //produk->keranjang  ->transaki     
    public function beli(Request $request)
    {
        // $user = Auth::user();
        $ongkir = Ongkir::where('id', $request['ongkir_id'])->get();
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::user()->id)->get();
        foreach ($keranjang as $datas){
            $dtNamaProduk[] = $datas->produk->nama_produk;
            $dtHargaProduk[] = $datas->produk->harga;
        }
        
        $total = (count($dtNamaProduk) * $ongkir[0]['ongkir']) + array_sum($dtHargaProduk);
        $transaksi = collect([
            'user_id' => Auth::User()->id,
            'nama_produk' => $dtNamaProduk,
            'harga_produk' => $dtHargaProduk,
            'ongkir_id' => $request->ongkir_id,
            'total' => $total,
            'status' => 'Pending',
            'resi' => 'Tidak Ada',
        ]);

        $request->session()->push('carts', $transaksi);
        // dd($dtHargaProduk);
        return redirect ('invoice');
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
        //
    }
}
