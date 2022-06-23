<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            $users = User::all();
            $paginate = User::orderBy('id', 'asc')->paginate(10);
            $role = Role::all();
           return view('admin.pembeli', ['users' => $users ,'paginate'=>$paginate, 'role' => $role]);
        } else {
            return redirect('/');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pembeli = User::all();
        return view('admin.createP',['pembeli' => $pembeli]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);
           
        //fungsi eloquent untuk menambah data

        
        $pembeli= new User;
        
        
        //$roleuser->user()->associate($pembeli->id);
        //$roleuser->save();
        $pembeli->username = $request->get('username');
        $pembeli->name = $request->get('name');
        $pembeli->email = $request->get('email');
        $pembeli->password = Hash::make($request->get('password'));
        $pembeli->save();

        //$roleuser = new RoleUser;
        $roleuser = RoleUser::create([
            'user_id' => $pembeli->id,
            'role_id' => $request -> role_id
        ]);
        // $pembeli->save();
        
        //Fungsi eloquent untuk menambah data dengan relasi belongsTo
        
        
    
    
        // Mahasiswa::create($request->all());
    
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('pembeli.index')
            ->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all()->where('id', $id)->first();
        return view('admin.detailP',['users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        $users = User::all()->where('id', $id)->first();
        return view('admin.editP',['users'=>$users]);
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
        // echo print_r($request->post()); 
        // exit;
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $users = User::all()->where('id', $id)->first();
        $users->username= $request->post('username');
        $users->name = $request->post('name');
        $users->email = $request->post('email');
        // $users->password = Hash::make($request->post('password'));
        if($request->post('password')){
            $users->password = Hash::make($request->post('password'));
        }
        
    //     if ($users->foto && file_exists(storage_path('app/public/'. $users->foto))) {
    //         Storage::delete('public/'. $users->foto);
    //     }

    //       $image_name = '';
    //     if ($request->file('foto')) {
    //     $image_name = $request->file('foto')->store('images', 'public');
    // }
    //     $barangs->foto = $image_name;
        $users->save();

        
       
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('pembeli.index')
            ->with('success', 'Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembeli = User::all()->where('id', $id)->first();
        $pembeli->delete($pembeli);
        return redirect()->route('pembeli.index');
    }

    public function listUserRole($id)
    {
        if (request()->user()->hasRole('admin')) {
            $users = RoleUser::leftJoin('users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id', '=',$id)->get();
            $role = Role::all();
            $paginate = RoleUser::leftJoin('users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id', '=',$id)->paginate(3);
           return view('admin.pembeli', ['users' => $users ,'paginate'=>$paginate, 'role' => $role]);
        } else {
            return redirect('/');
        } 
    }

    public function getUserFilter(Request $request, $role)
    {
        $data = Role_Users::where('role_id', $role)->get();
        $roleNih = $role;

        return view('admin.pembeli', compact('data', 'roleNih'));
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->searchUser;
        if (request()->user()->hasRole('admin')) {
            $users = User::where('username', 'like', "%" . $keyword . "%")->get();
            $paginate = User::orderBy('id', 'asc')->paginate(3);
            $role = Role::all();
           return view('admin.pembeli', ['users' => $users ,'paginate'=>$paginate, 'role' => $role]);
        } else {
            return redirect('/');
        } 
    }
   
}
