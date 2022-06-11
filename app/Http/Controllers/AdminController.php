<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        // if (request()->user()->hasRole('adm')) {
        if (request()->user()->hasRole('admin')) {
            
           return view('admin.dashboard');
        } else {
            return redirect('/');
        } 
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function profil(){
        return view('admin.profil');
    }

    public function barang(){
        return view('admin.barang');
    }

    public function pembeli(){
        return view('admin.pembeli');
    }

    public function transaksi(){
        return view('admin.transaksi');
    }
}
