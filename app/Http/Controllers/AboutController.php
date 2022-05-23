<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class AboutController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'About Us',
            'about' => About::orderBy('id_about', 'desc')->get()
        ];
        return view('about.about',$data);
    }

    public function tambahAbout(Request $r)
    {
        if ($r->hasFile('gambar')) {
            $r->file('gambar')->move('assets/uploads/', $r->file('gambar')->getClientOriginalName());
            $gambar = $r->file('gambar')->getClientOriginalName();
        } else {
            $gambar = '';
        }

        $data = [
            'teks1' => $r->teks1,
            'ket' => $r->ket,
            'gambar' => $gambar,
        ];
        About::create($data);

        return redirect()->route('about')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahAbout(Request $r)
    {
      
        if ($r->hasFile('gambar')) {
            $r->file('gambar')->move('assets/uploads/', $r->file('gambar')->getClientOriginalName());
            $gambar = $r->file('gambar')->getClientOriginalName();
        } else {
            $gambar = $r->gambarIsi;
        }
        
        $data = [
            'gambar' => $gambar,
            'teks1' => $r->teks1,
            'ket' => $r->ket,
        ];
        About::where('id_about', $r->id)->update($data);

        return redirect()->route('about')->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusAbout(Request $r)
    {
        $gambar = About::where('id_about',$r->id)->first();
		FacadesFile::delete('assets/uploads/'.$gambar->nm_foto);

       About::where('id_about', $r->id) ->delete();
       return redirect()->route('about')->with('error', 'Berhasil Hapus Data');
    }
}
