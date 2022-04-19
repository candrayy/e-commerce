<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ongkir;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtOngkir = Ongkir::paginate(5);
        return view('admin.ongkir.ongkir', compact('dtOngkir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.ongkir.tambah-ongkir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ongkir::create([
            'kd_ongkir' => $request->kd_ongkir,
            'ongkir' => $request->ongkir,
        ]);
        return redirect('ongkir');
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
        $dtOngkir = Ongkir::findorfail($id);
        return view('admin.ongkir.edit-ongkir', compact('dtOngkir'));
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
        $dtOngkir = Ongkir::findorfail($id);
        $dtOngkir->update([
            'kd_ongkir' => $request->kd_ongkir,
            'ongkir' => $request->ongkir,
        ]);
        return redirect('ongkir');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dtOngkir = Ongkir::findorfail($id);
        $dtOngkir->delete();
        return redirect('ongkir');
    }
}
