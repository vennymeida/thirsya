<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Alert;
use App\Http\Request\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;


class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  UpdateProfileRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function doupdate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $users = User::where('id', $request->post('id'))->first();
        $users->username= $request->post('username');
        $users->name = $request->post('name');
        $users->email = $request->post('email');
        if($request->post('password')){
            $users->password = Hash::make($request->post('password'));
        }
        $users->save();
        Alert::success('Sukses', 'Berhasil Ubah Profil');
        return redirect()->route('Adminprofil');
    }

    public function doupdate1(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $users = User::where('id', $request->post('id'))->first();
        $users->username= $request->post('username');
        $users->name = $request->post('name');
        $users->email = $request->post('email');
        if($request->post('password')){
            $users->password = Hash::make($request->post('password'));
        }
        $users->save();
        Alert::success('Sukses', 'Berhasil Ubah Profil');
        return redirect()->route('Userprofil');
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );
    
        return redirect()->route('profil/update');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //
    }


}
