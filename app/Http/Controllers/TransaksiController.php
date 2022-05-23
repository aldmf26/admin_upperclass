<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => DB::select("SELECT t.id_transaksi,t.shipping,t.voucher, o.id_harga, t.no_order, u.name, t.email, t.nohp, t.alamat, t.total as totTransaksi, t.status
            FROM tb_transaksi as t
            LEFT JOIN user_upperclass as u ON u.id = t.id_user
            LEFT JOIN tb_order as o ON o.no_order = t.no_order
            GROUP BY o.no_order  ORDER BY t.id_transaksi DESC"),
        ];

        return view('transaksi.transaksi',$data);
    }

    public function setStatus(Request $r) {
        Transaksi::where('id_transaksi', $r->id)->update(['status' => $r->status]);

        return redirect()->route('transaksi');
    }
}
