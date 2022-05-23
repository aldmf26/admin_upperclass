<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\FooterSosmed;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Footer Info',
            'footer' => Footer::join('tb_lokasi', 'tb_lokasi.id_lokasi', '=', 'tb_footer.id_lokasi')->get(),
            'lokasi' => Lokasi::all(),
        ];
        return view('footer.footer', $data);
    }

    public function tambahFooter(Request $r)
    {
        Footer::create([
            'deskripsi' => $r->deskripsi,
            'id_lokasi' => $r->id_lokasi,
        ]);

        return redirect()->route('footer')->with('sukses', 'Berhasil tambah data');
    }

    public function ubahFooter(Request $r)
    {
        Footer::where('id_footer', $r->id_footer)->update([
            'deskripsi' => $r->deskripsi,
            'id_lokasi' => $r->id_lokasi,
        ]);

        $link = $r->link;
        for ($i=0; $i < count($link) ; $i++) { 
            FooterSosmed::where('id_fs',$r->id_footer_sosmed[$i])->update(
                [
                    'link' => $link[$i]
                ]
            );
        }

        return redirect()->route('footer')->with('sukses', 'Berhasil ubah data');
    }
}
