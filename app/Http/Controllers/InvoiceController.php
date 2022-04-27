<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $dtqty_produk = $transaksi[0]['qty'];
        $dtharga_produk = $transaksi[0]['harga_produk'];

        // Display Ongkir
        $ongkirs = Ongkir::where('id', $transaksi[0]['ongkir_id'])->get();
        $kd_ongkir = $ongkirs[0]['kd_ongkir'];

        // Display Price Ongkir
        $harga_ongkir = $ongkirs[0]['ongkir'];

        // Display X Produk
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::user()->id)->get();
        foreach ($keranjang as $datas){
            $count_produk[] = $datas->qty;
        }
        $dtcount_produk = array_sum($count_produk);
        
        
        // dd($dtqty_produk = $transaksi[0]['qty']);
        return view('user.transaksi.invoice', compact('total', 'dtnama_produk', 'dtharga_produk', 'kd_ongkir', 'harga_ongkir',
        'dtcount_produk', 'dtqty_produk'));
    }

    public function kirim(Request $request)
    {
        $transaksi = $request->session()->get('carts');
        // $transaksi->each(function ($item, $key) {
            
        //     // Do stuff
        // });
        Transaksi::create([
            'user_id' => $transaksi[0]['user_id'],
            'ongkir_id' => $transaksi[0]['ongkir_id'],
            'nama_produk' => $transaksi[0]['nama_produk'],
            'qty' => json_encode($transaksi[0]['qty']),
            'total' => $transaksi[0]['total'],
            'status' => 'Pending',
            'resi' => 'Tidak Ada',
        ]);

        $data = ([
            'user_id' => $transaksi[0]['user_id'],
            'ongkir_id' => $transaksi[0]['ongkir_id'],
            'nama_produk' => $transaksi[0]['nama_produk'],
            'qty' => json_encode($transaksi[0]['qty']),
            'total' => $transaksi[0]['total'],
            'status' => 'Pending',
            'resi' => 'Tidak Ada',
        ]);
        
        
        // dd($data);
        $request->session()->forget('carts');
        Keranjang::where('user_id', Auth::user()->id)->delete();
        foreach($data as $key => $barang){
            // Produk::where('nama_produk', $barang['nama_produk'])->decrement('kuantitas', $barang['qty']);
        }
        dd($data);
        return redirect('keranjang');
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
