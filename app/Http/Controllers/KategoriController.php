<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Kategori',
            'kategori' => Kategori::join('tb_lokasi', 'tb_kategori.id_lokasi', '=', 'tb_lokasi.id_lokasi')->orderBy('id_kategori', 'desc')->get(),
            'lokasi' => Lokasi::all(),
        ];
        return view('kategori.kategori', $data);
    }

    public function tambahKategori(Request $r)
    {
        $data = [
            'nm_kategori' => $r->nm_kategori,
            'id_lokasi' => $r->id_lokasi,
        ];
        Kategori::create($data);

        return redirect()->route('kategori')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahKategori(Request $r)
    {
        $data = [
            'nm_kategori' => $r->nm_kategori,
            'id_lokasi' => $r->id_lokasi,
        ];
        Kategori::where('id_kategori', $r->id)->update($data);

        return redirect()->route('kategori')->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusKategori(Request $r)
    {
       Kategori::where('id_kategori', $r->id) ->delete();
       return redirect()->route('kategori')->with('error', 'Berhasil Hapus Data');
    }
}
