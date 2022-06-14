<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class ShopController extends Controller
{
    public function index()
    {
        if (request()->user()->hasRole('user')) {
            $barangs = Barang::all();
           return view('user.shop', ['barangs' => $barangs]);
        } else {
            return redirect('/');
        } 
    }
}
