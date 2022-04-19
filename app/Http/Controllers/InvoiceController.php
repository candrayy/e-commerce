<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Ongkir;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksi = $request->session()->get('carts');

        // Display Total Product
        $total = $transaksi[0]['total'];

        // Display Produk Name
        $dtnama_produk = $transaksi[0]['nama_produk'];
        $dtharga_produk = $transaksi[0]['harga_produk'];

        // Display Ongkir
        $ongkirs = Ongkir::where('id', $transaksi[0]['ongkir_id'])->get();
        $kd_ongkir = $ongkirs[0]['kd_ongkir'];

        // Display Price Ongkir
        $harga_ongkir = $ongkirs[0]['ongkir'];

        // Display X Produk
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::user()->id)->get();
        foreach ($keranjang as $datas){
            $count_produk[] = $datas->produk->harga;
        }
        $dtcount_produk = count($count_produk);
        
        // dd($dtproduk_nama_harga);
        return view('user.transaksi.invoice', compact('total', 'dtnama_produk', 'dtharga_produk', 'kd_ongkir', 'harga_ongkir', 'dtcount_produk'));
    }

    public function kirim(Request $request)
    {
        $transaksi = $request->session()->get('carts');
        // $transaksi->each(function ($item, $key) {
            
        //     // Do stuff
        // });
        $data = Transaksi::create([
            'user_id' => $transaksi[0]['user_id'],
            'ongkir_id' => $transaksi[0]['ongkir_id'],
            'nama_produk' => $transaksi[0]['nama_produk'],
            'total' => $transaksi[0]['total'],
            'status' => 'Pending',
            'resi' => 'Tidak Ada',
        ]);
        
        // (store to db)
        $request->session()->forget('carts');
        // dd($transaksi);
        return redirect('beranda');
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
