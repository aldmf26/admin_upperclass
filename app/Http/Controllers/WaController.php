<?php

namespace App\Http\Controllers;

use App\Models\Wa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Nomor Wa',
            'wa' => DB::table('wa')->first(),
        ];
        // dd($data);
        return view('wa.wa', $data);
    }

    public function ubahWa(Request $r)
    {
        DB::table('wa')->where('id_wa', $r->id)->update(['nomor' => $r->nomor]);
        return redirect()->route('wa')->with('sukses', 'Berhasil ubah data');
    }
}
