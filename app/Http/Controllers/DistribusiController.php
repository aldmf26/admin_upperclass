<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Distribusi',
            'distribusi' => Distribusi::orderBy('id_distribusi', 'desc')->get(),
        ];
        return view('distribusi.distribusi', $data);
    }

    public function tambahDistribusi(Request $r)
    {
        $data = [
            'nm_distribusi' => $r->nm_distribusi,
        ];
        Distribusi::create($data);

        return redirect()->route('distribusi')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahDistribusi(Request $r)
    {
        $data = [
            'nm_distribusi' => $r->nm_distribusi,
        ];
        Distribusi::where('id_distribusi', $r->id)->update($data);

        return redirect()->route('distribusi')->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusDistribusi(Request $r)
    {
       Distribusi::where('id_distribusi', $r->id) ->delete();
       return redirect()->route('distribusi')->with('error', 'Berhasil Hapus Data');
    }
}
