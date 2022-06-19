<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Barang;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        // if (request()->user()->hasRole('adm')) {
        // if (request()->user()->hasRole('admin')) {
            
        //    return view('admin.dashboard');
        // } else {
        //     return redirect('/');
        // } 
        $data = [
            'userCount' => User::all()->count(),
            'produkCount' => Barang::count(),
            'orderCount' => Pesanan::count(),
        ];
            return view ('admin.dashboard',compact('data'));
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
