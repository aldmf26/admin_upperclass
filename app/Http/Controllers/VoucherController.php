<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Data Voucher',
            'voucher' => Voucher::orderBy('id_voucher', 'desc')->get(),
        ];

        return view('voucher.voucher',$data);
    }

    public function tambahVoucher(Request $r)
    {
        $kode = strtoupper(Str::random(3).random_int(100, 999));

        $data = [
            'kode' => $kode,
            'jumlah' => $r->jumlah,
            'ket' => $r->ket,
            'expired' => $r->expired,
            'status' => '1',
            'terpakai' => 'belum',
        ];

        Voucher::create($data);

        return redirect()->route('voucher');
    }

    public function ubahVoucher(Request $request)
    {
        $data = [
            'jumlah' => $request->jumlah,
            'ket' => $request->ket,
            'expired' => $request->expired,
        ];

        Voucher::where('id_voucher', $request->id_voucher)->update($data);
        return redirect()->route('voucher');
    }

    public function hapusVoucher(Request $request)
    {
        Voucher::where('id_voucher', $request->id_voucher)->delete();
        return redirect()->route('voucher');
    }

    public function setVoucher(Request $r)
    {
        Voucher::where('id_voucher', $r->id)->update(['status' => $r->status]);
        return redirect()->route('voucher');
    }
}
