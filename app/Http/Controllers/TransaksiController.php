<?php

namespace App\Http\Controllers;

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
        // $dtProduk = Produk::select('id', 'nama', 'harga')->where('id', $dtKeranjang);
        // dd($dtKeranjang);
        return view('user.transaksi.transaksi', compact('dtKeranjang'));
    }

    public function beli(Request $request)
    {
        // $user = Auth::user();
        $keranjang = Keranjang::with('produk','user')->where('user_id', Auth::user()->id)->get();
        $transaksi = Transaksi::create([
            'user_id' => Auth::User()->id,
            'produk_id' => $request->produk_id,
            'harga' => $request->harga,
            'ongkir' => 0,
            'total' => 0,
            'status' => 'PENDING',
            'resi' => 'Tidak Ada',
        ]);

        // foreach ($keranjang as $k) {
        //     $transaksi->produk()->attach($k->produk_id,[
        //         'produk_id' => $k->produk->nama_produk,
        //         'harga' => $k->produk->harga,
        //         'ongkir' => $k->ongkir->ongkir,
        //     ]);

        //     $transaksi->increment('total', $k->produk->harga + $k->ongkir->ongkir);
        // }
        dd($transaksi);
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
