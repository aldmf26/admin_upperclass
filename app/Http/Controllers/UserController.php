<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $r)
    {   
        $data = [
            'title' => 'User',
            'user' => Users::orderBy('id','desc')->get()
        ];
        return view('user.user',$data);  
    }

    public function tambahUser(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'username' => $r->username,
            'password' => bcrypt($r->password),
        ];

        Users::create($data);
        return redirect()->route('user')->with('sukses', 'Berhasil Tambah Data');
    }

    public function hapusUser(Request $r)
    {
        Users::where('id', $r->id)->delete();
        return redirect()->route('user')->with('error', 'Berhasil hapus Data');
    }
}
