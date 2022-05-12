<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            return redirect()->back();
        } else{
            return view('login');
        }
    }
    
    protected function authenticated()
    {
        if(Auth::user()->role == 'adm')
        {
            return redirect('admin');
        }
        elseif(Auth::user()->role == 'usr')
        {
            return redirect('beranda');
        }
    }

    public function postlogin(request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('admin');
        }
        else {
            return back();
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
