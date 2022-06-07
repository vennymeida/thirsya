<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        // if (request()->user()->hasRole('usr')) {
        if (request()->user()->hasRole('user')) {
            return view('user.dashboardU');
        } else {
            return redirect('/');
        } 
    }

    public function dashboardU(){
        return view('user.dashboardU');
    }
}
