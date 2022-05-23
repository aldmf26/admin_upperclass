<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Lokasi',
            'lokasi' => Lokasi::orderBy('id_lokasi', 'desc')->get(),
        ];
        return view('lokasi.lokasi', $data);
    }

    public function tambahLokasi(Request $r)
    {
        if ($r->hasFile('gambar')) {
            $r->file('gambar')->move('assets/uploads/', $r->file('gambar')->getClientOriginalName());
            $gambar = $r->file('gambar')->getClientOriginalName();
        } else {
            $gambar = '';
        }

        $data = [
            'nm_lokasi' => $r->nm_lokasi,
            'gambar' => $r->gambar,
        ];
        Lokasi::create($data);

        return redirect()->route('lokasi')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahLokasi(Request $r)
    {
        if ($r->hasFile('gambar')) {
            $r->file('gambar')->move('assets/uploads/', $r->file('gambar')->getClientOriginalName());
            $gambar = $r->file('gambar')->getClientOriginalName();
        } else {
            $gambar = '';
        }
        $data = [
            'nm_lokasi' => $r->nm_lokasi,
            'gambar' => $gambar,
        ];
        Lokasi::where('id_lokasi', $r->id)->update($data);

        return redirect()->route('lokasi')->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusLokasi(Request $r)
    {
       Lokasi::where('id_lokasi', $r->id) ->delete();
       return redirect()->route('lokasi')->with('error', 'Berhasil Hapus Data');
    }
}
