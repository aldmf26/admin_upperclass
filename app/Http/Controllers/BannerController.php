<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class BannerController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Banner',
            'banner' => Banner::orderBy('id_banner', 'desc')->get(),
        ];
        return view('banner.banner', $data);
    }

    public function tambahBanner(Request $r)
    {
        if ($r->hasFile('foto')) {
            $r->file('foto')->move('assets/uploads/', $r->file('foto')->getClientOriginalName());
            $foto = $r->file('foto')->getClientOriginalName();
        } else {
            $foto = '';
        }

        Banner::create([
            'nm_foto' => $foto,
            'teks1' => $r->teks1,
            'teks2' => $r->teks2
        ]);

        return redirect()->route('banner')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahBanner(Request $r)
    {
        $data = [
            'teks1' => $r->teks1,
            'teks2' => $r->teks2,
        ];
        Banner::where('id_banner', $r->id)->update($data);

        return redirect()->route('banner')->with('sukses', 'Berhasil Ubah Data');   
    }

    public function hapusBanner(Request $r)
    {
        // hapus file
		$gambar = Banner::where('id_banner',$r->id)->first();
		FacadesFile::delete('assets/uploads/'.$gambar->nm_foto);

        Banner::where('id_banner', $r->id)->delete();
        return redirect()->route('banner')->with('error', 'Berhasil Hapus Data');
    }
}
