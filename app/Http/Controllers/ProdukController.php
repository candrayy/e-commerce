<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtProduk = Produk::paginate(5);
        return view('admin.produk.produk', compact('dtProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.tambah-produk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dtProduk = new Produk;
        $dtProduk->kd_produk = $request->kd_produk;
        $dtProduk->nama_produk = $request->nama_produk;
        $dtProduk->harga = $request->harga;
        $dtProduk->deskripsi = $request->deskripsi;
        if($request->hasfile('gambar'))
        {
            $file = $request->file('gambar');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('images/produk/', $filename);
            $dtProduk->gambar = $filename;
        }
        $dtProduk->save();
        return redirect('produk');
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
        $dtProduk = Produk::findorfail($id);
        return view('admin.produk.edit-produk', compact('dtProduk'));
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
        $dtProduk = Produk::findorfail($id);
        $dtProduk->kd_produk = $request->kd_produk;
        $dtProduk->nama_produk = $request->nama_produk;
        $dtProduk->harga = $request->harga;
        $dtProduk->deskripsi = $request->deskripsi;
        if($request->hasfile('gambar'))
        {
            $file = $request->file('gambar');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('images/produk/', $filename);
            $dtProduk->gambar = $filename;
        }
        $dtProduk->update();
        return redirect('produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dtProduk = Produk::findorfail($id);
        $destination = 'images/produk/'.$dtProduk->gambar;
        if(file::exists($destination))
        {
            File::delete($destination);
        }
        $dtProduk->delete();
        return redirect('produk');
    }
}
