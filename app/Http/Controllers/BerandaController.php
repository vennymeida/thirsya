<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BerandaController extends Controller
{
    public function index()
    {
            return view('beranda.index');
    }

    public function shop(){
            $barangs = Barang::all();
           return view('beranda.shopBeranda', ['barangs' => $barangs]);
        }

        public function about(){
                return view('beranda.aboutBeranda');
            }
    }

