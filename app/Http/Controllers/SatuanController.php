<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Satuan',
            'satuan' => Satuan::orderBy('id_satuan', 'desc')->get(),
        ];
        return view('satuan.satuan', $data);
    }

    public function tambahSatuan(Request $r)
    {
        $data = [
            'nm_satuan' => $r->nm_satuan,
        ];
        Satuan::create($data);

        return redirect()->route('satuan')->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahSatuan(Request $r)
    {
        $data = [
            'nm_satuan' => $r->nm_satuan,
        ];
        Satuan::where('id_satuan', $r->id)->update($data);

        return redirect()->route('satuan')->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusSatuan(Request $r)
    {
       Satuan::where('id_satuan', $r->id) ->delete();
       return redirect()->route('satuan')->with('error', 'Berhasil Hapus Data');
    }
}
