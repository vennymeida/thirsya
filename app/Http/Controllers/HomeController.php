<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
  
    //     if ($request->user()->hasRole('usr')) {
    //         return redirect('user');
    //     }

    //     if ($request->user()->hasRole('adm')){
    //         return redirect('admin');
    //     }
    //     return redirect('/');
 
    // }

    public function index(Request $request)
    {
  
        if ($request->user()->hasRole('user')) {
            return response()->view('user.dashboardU');
        }

        else if($request->user()->hasRole('admin')){
            return response()->view('admin.dashboard');
        }

        else
        return redirect('/');
 
    }
    
}
