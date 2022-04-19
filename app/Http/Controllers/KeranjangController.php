<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Transaksi;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtKeranjang = Keranjang::where('user_id', Auth::id())->paginate(5);
        //dd($dtKeranjang);
        return view('user.keranjang.keranjang', compact('dtKeranjang'));
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
    public function keranjangadd(Request $request, $id)
    {
        // if(Auth::id())
        // {
        //     $user = Auth::user();
            // $ongkir = Ongkir::firstOrFail();
            // $produk = Produk::firstOrFail();
        //     $keranjang = new Keranjang;
        //     $keranjang->user_id = $user->name;
        //     $keranjang->produk_id = $produk->nama_produk;
        //     $keranjang->ongkir_id = $ongkir->ongkir;
        //     dd($keranjang);
        //     $keranjang->save();
        //     return redirect('keranjang');
        // }
        // else
        // {
        //     return redirect()->back();
        // }
        
        $data = Keranjang::create([
            'user_id' => Auth::user()->id,
            'produk_id' => $id,
        ]);
    
        //dd($data);
        $data->save();
        return redirect('keranjang');
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
        $dtKeranjang = Keranjang::find($id);
        $dtKeranjang->delete();
        return redirect()->back();
    }
}
