<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Foto;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Produk;
use App\Models\Satuan;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProdukController extends Controller
{
    public function index(Request $r)
    {
        $id_lokasi = $r->id_lokasi;
        if ($r->aksi == 1) {
            dd('1');
        }
        $data = [
            'title' => 'Product',
            'produk1' => Harga::join('tb_produk', 'tb_produk.id_produk', '=', 'tb_harga.id_produk')
                ->join('tb_distribusi', 'tb_distribusi.id_distribusi', '=', 'tb_harga.id_distribusi')->join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_produk.id_kategori')
                ->join('tb_lokasi', 'tb_lokasi.id_lokasi', '=', 'tb_produk.id_lokasi')
                ->where('tb_lokasi.id_lokasi', $id_lokasi == '' ? 1 : $id_lokasi)
                ->groupBy('tb_harga.id_produk')->orderBy('tb_produk.id_produk', 'desc')
                ->get(),
            'produk' => Produk::join('tb_lokasi', 'tb_produk.id_lokasi', '=', 'tb_lokasi.id_lokasi')
                ->join('tb_kategori', 'tb_produk.id_kategori', '=', 'tb_kategori.id_kategori')
                ->join('tb_satuan', 'tb_produk.id_satuan', '=', 'tb_satuan.id_satuan')
                ->join('tb_harga', 'tb_produk.id_produk', '=', 'tb_harga.id_produk')
                ->where('tb_lokasi.id_lokasi', $id_lokasi == '' ? 1 : $id_lokasi)
                ->groupBy('tb_harga.id_produk')
                ->get(),
            'kategori' => Kategori::where('id_lokasi', $id_lokasi == '' ? 1 : $id_lokasi)->get(),
            'satuan' => Satuan::all(),
            'distribusi' => Distribusi::all(),
            'lokasi' => Lokasi::all(),
            'id_lokasi' => $id_lokasi == '' ? 1 : $id_lokasi,
        ];
        // dd(request()->get('nm_kategori'));
        return view('product.product', $data);
    }

    public function tambahProduk(Request $r)
    {
        if ($r->hasFile('foto')) {
            $r->file('foto')->move('assets/uploads/', $r->file('foto')->getClientOriginalName());
            $foto = $r->file('foto')->getClientOriginalName();
        } else {
            $foto = '';
        }

        $data = [
            'id_kategori' => $r->id_kategori,
            'id_satuan' => $r->id_satuan,
            'nm_produk' => $r->nm_produk,
            'deskripsi' => $r->deskripsi,
            'stok' => 0,
            'id_lokasi' => $r->id_lokasi,
            'foto' => $foto,
            'gr' => $r->gr,
            'best_seller' => 'off',
            'harga_modal' => $r->harga_modal,
        ];

        $p = Produk::create($data);
        $id_produk = $p->id;
        $id_distribusi = $r->id_distribusi;
        $harga = $r->harga;
        for ($i = 0; $i < count($id_distribusi); $i++) {
            $data1 = [
                'id_distribusi' => $id_distribusi[$i],
                'id_produk' => $id_produk,
                'harga' => $harga[$i],
                'link' => $r->link[$i],
            ];

            Harga::create($data1);
        }

        Video::create([
            'id_produk' => $id_produk,
            'link_video' => $r->link_video
        ]);


        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('sukses', 'Berhasil Tambah Data');
    }

    public function ubahProduk(Request $r)
    {
        if ($r->file('foto')) {
            $r->file('foto')->move('assets/uploads/', $r->file('foto')->getClientOriginalName());
            $foto = $r->file('foto')->getClientOriginalName();
            $data = [
                'id_kategori' => $r->id_kategori,
                'id_satuan' => $r->id_satuan,
                'nm_produk' => $r->nm_produk,
                'deskripsi' => $r->deskripsi,
                'gr' => $r->gr,
                'foto' => $foto
            ];
        } else {
            $data = [
                'id_kategori' => $r->id_kategori,
                'id_satuan' => $r->id_satuan,
                'nm_produk' => $r->nm_produk,
                'deskripsi' => $r->deskripsi,
                'gr' => $r->gr,
            ];
        }

        Produk::where('id_produk', $r->id_produk)->update($data);
        $id_produk = $r->id_produk;
        $id_distribusi = $r->id_distribusi;
        // dd($id_distribusi);
        for ($i = 0; $i < count($id_distribusi); $i++) {
            $data1 = [
                'harga' => $r->harga[$i],
                'link' => $r->link[$i],
            ];
            Harga::where('id_harga', $r->id_harga[$i])->update($data1);
        }

        $link_v = $r->link_video;
        if ($link_v) {
            for ($i = 0; $i < count($link_v); $i++) {
                $datal = [
                    'link_video' => $link_v[$i]
                ];
                Video::where('id_video', $r->id_video[$i])->update($datal);
            }
        }

        if ($r->link_v_i) {
            Video::create([
                'link_video' => $r->link_v_i,
                'id_produk' => $id_produk
            ]);
        }

        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('sukses', 'Berhasil Ubah Data');
    }

    public function hapusLinkV(Request $r)
    {
        Video::where('id_video', $r->id)->delete();
        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('error', 'Berhasil Hapus Link Video');
    }

    public function tbhDistribusi(Request $r)
    {
        $id_distribusi = $r->id_distribusi;
        $id_produk = $r->id_produk;
        $cek = Harga::where('id_produk', $id_produk)->where('id_distribusi', $id_distribusi)->first();
        // dd($cek);
        if ($cek == '') {
            $data = [
                'id_distribusi' => $id_distribusi,
                'id_produk' => $id_produk,
                'harga' => $r->harga,
                'link' => $r->link,
            ];
            Harga::create($data);
            return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('sukses', 'Berhasil Tambah Data');
        } else {
            return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('error', 'Distribusi Sudah Ada!');
        }
    }

    public function uploadImages(Request $r)
    {

        $image = $r->file('file');
        if ($image) {
            $image->move('assets/uploads/', $image->getClientOriginalName());
            $foto = $image->getClientOriginalName();
        } else {
            $foto = '';
        }
        $data = [
            'nm_foto' => $foto,
            'id_produk' => $r->id_produk
        ];
        Foto::create($data);

        return redirect()->route('produk', ['id_lokasi' => 1])->with('sukses', 'Berhasil Ubah Data');
    }

    public function importProduk(Request $r)
    {
        $file = $r->file('file');
        $ext = $file->getClientOriginalExtension();

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx;
        $spreadsheet = $reader->load($file);
        // $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
        // $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        $sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $data = array();

        // lokasi
        $numrow = 1;

        foreach ($sheet as $row) {
            if ($row['B'] == '' && $row['C'] == '') {
                continue;
            }
            if ($numrow > 1) {
                if ($row['B'] == '') {
                    Lokasi::create([
                        'nm_lokasi' => $row['C']
                    ]);
                } else {
                    Lokasi::where('id_lokasi', $row['B'])->update([
                        'nm_lokasi' => $row['C']
                    ]);
                }
            }
            $numrow++;
        }
        // -----------------------------------

        // kategori
        $kat = 1;

        foreach ($sheet as $row) {
            if ($row['F'] == '' && $row['G'] == '' && $row['H'] == '') {
                continue;
            }
            if ($kat > 1) {
                if ($row['G'] == '') {
                    Kategori::create([
                        'id_lokasi' => $row['F'],
                        'nm_kategori' => $row['H']
                    ]);
                } else {
                    Kategori::where('id_kategori', $row['G'])->update([
                        'id_lokasi' => $row['F'],
                        'nm_kategori' => $row['H']
                    ]);
                }
            }
            $kat++;
        }
        // -----------------------------------

        // satuan
        $sat = 1;

        foreach ($sheet as $row) {
            if ($row['K'] == '' && $row['L'] == '') {
                continue;
            }
            if ($sat > 1) {
                if ($row['K'] == '') {
                    Satuan::create([
                        'nm_satuan' => $row['L']
                    ]);
                } else {
                    Satuan::where('id_satuan', $row['K'])->update([
                        'nm_satuan' => $row['L']
                    ]);
                }
            }
            $sat++;
        }
        // -----------------------------------

        // distribusi
        $dis = 1;

        foreach ($sheet as $row) {
            if ($row['O'] == '' && $row['P'] == '') {
                continue;
            }
            if ($dis > 1) {
                if ($row['O'] == '') {
                    Distribusi::create([
                        'nm_distribusi' => $row['P']
                    ]);
                } else {
                    Distribusi::where('id_distribusi', $row['O'])->update([
                        'nm_distribusi' => $row['P']
                    ]);
                }
            }
            $dis++;
        }
        // -----------------------------------

        // produk
        $pro = 1;

        foreach ($sheet as $row) {
            if ($row['S'] == '' && $row['T'] == '' && $row['U'] == '' && $row['V'] == '' && $row['W'] == '' && $row['X'] == '' && $row['Y'] == '' && $row['Z'] == '' && $row['AA'] == '') {
                continue;
            }
            if ($pro > 1) {
                if ($row['V'] == '') {
                    $data = [
                        'id_lokasi' => $row['S'],
                        'id_kategori' => $row['T'],
                        'nm_produk' => $row['W'],
                        'deskripsi' => $row['X'],
                        'harga_modal' => $row['Y'],
                        'id_satuan' => $row['Z'],
                    ];
                    $produk = Produk::create($data);
                } else {
                    $data = [
                        'id_lokasi' => $row['S'],
                        'id_kategori' => $row['T'],
                        'nm_produk' => $row['W'],
                        'deskripsi' => $row['X'],
                        'harga_modal' => $row['Y'],
                        'id_satuan' => $row['Z'],
                    ];
                    Produk::where('id_produk', $row['V'])->update($data);
                }
            }
            $pro++;
        }
        // -----------------------------------

        // tmbh distribusi

        $tbhDis = 1;

        foreach ($sheet as $row) {
            if ($row['AE'] == '' && $row['AF'] == '' && $row['AG'] == '' && $row['AH'] == '' && $row['AI'] == '' && $row['AJ'] == '' && $row['AK'] == '') {
                continue;
            }
            if ($tbhDis > 1) {
                if ($row['AE'] == '') {
                    $produk = Produk::where('nm_produk', $row['AG'])->first();

                    if ($produk) {
                        $data = [
                            'id_produk' => $produk->id_produk,
                            'id_distribusi' => $row['AH'],
                            'link' => $row['AJ'],
                            'harga' => $row['AK'],
                        ];
                        Harga::create($data);
                    }
                } else {
                    $data = [
                        'id_harga' => $row['AE'],
                        'id_produk' => $row['AF'],
                        'id_distribusi' => $row['AH'],
                        'link' => $row['AJ'],
                        'harga' => $row['AK'],
                    ];
                    Harga::where('id_harga', $row['AE'])->update($data);
                }
            }
            $tbhDis++;
        }
        // -----------------------------------

        // video
        $vid = 1;

        foreach ($sheet as $row) {
            if ($row['AN'] == '' && $row['AO'] == '' && $row['AP'] == '' && $row['AQ'] == '') {
                continue;
            }
            if ($vid > 1) {
                if ($row['AP'] == '') {
                    $produk = Produk::where('nm_produk', $row['AO'])->first();
                    if ($produk) {
                        Video::create([
                            'id_produk' => $produk->id_produk,
                            'link_video' => $row['AQ']
                        ]);
                    }
                } else {
                    Video::where('id_video', $row['AP'])->update([
                        'id_produk' => $row['AN'],
                        'link_video' => $row['AQ']
                    ]);
                }
            }
            $vid++;
        }
        // -----------------------------------


        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('sukses', 'Data berhasil Diimport');
    }

    public function exportFormat(Request $r)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getStyle('A1:D4')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        // lebar kolom
        // lokasi
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(15);
        // -------------------------------------------
        // kategori
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(20);
        // -------------------------------------------
        // satuan
        $sheet->getColumnDimension('J')->setWidth(10);
        $sheet->getColumnDimension('K')->setWidth(10);
        $sheet->getColumnDimension('L')->setWidth(20);
        // -------------------------------------------
        // distribusi : shopee
        $sheet->getColumnDimension('N')->setWidth(10);
        $sheet->getColumnDimension('O')->setWidth(10);
        $sheet->getColumnDimension('P')->setWidth(15);
        // produk tambah
        $sheet->getColumnDimension('R')->setWidth(10);
        $sheet->getColumnDimension('S')->setWidth(10);
        $sheet->getColumnDimension('T')->setWidth(10);
        $sheet->getColumnDimension('U')->setWidth(20);
        $sheet->getColumnDimension('V')->setWidth(10);
        $sheet->getColumnDimension('W')->setWidth(30);
        $sheet->getColumnDimension('X')->setWidth(35);
        $sheet->getColumnDimension('Y')->setWidth(20);
        $sheet->getColumnDimension('Z')->setWidth(15);
        $sheet->getColumnDimension('AA')->setWidth(20);
        // -------------------------------------------
        // distribusi produk
        $sheet->getColumnDimension('AD')->setWidth(10);
        $sheet->getColumnDimension('AE')->setWidth(10);
        $sheet->getColumnDimension('AF')->setWidth(10);
        $sheet->getColumnDimension('AG')->setWidth(30);
        $sheet->getColumnDimension('AH')->setWidth(10);
        $sheet->getColumnDimension('AI')->setWidth(20);
        $sheet->getColumnDimension('AJ')->setWidth(35);
        $sheet->getColumnDimension('AK')->setWidth(20);
        // -------------------------------------------
        // video produk
        $sheet->getColumnDimension('AN')->setWidth(10);
        $sheet->getColumnDimension('AO')->setWidth(30);
        $sheet->getColumnDimension('AP')->setWidth(10);
        $sheet->getColumnDimension('AQ')->setWidth(10);
        // -------------------------------------------

        // header text       
        $sheet
            ->setCellValue('A1', 'LOKASI')
            ->setCellValue('B1', 'ID LOKASI')
            ->setCellValue('C1', 'LOKASI')
            // -------------------------------------------
            // kategori
            ->setCellValue('E1', 'KATEGORI')
            ->setCellValue('F1', 'ID LOKASI')
            ->setCellValue('G1', 'ID KATEGORI')
            ->setCellValue('H1', 'NAMA KATEGORI')
            // -------------------------------------------
            // satuan
            ->setCellValue('J1', 'SATUAN')
            ->setCellValue('K1', 'ID SATUAN')
            ->setCellValue('L1', 'SATUAN')
            // -------------------------------------------
            // distribusi : shopee
            ->setCellValue('N1', 'DISTRIBUSI')
            ->setCellValue('O1', 'ID DISTRIBUSI')
            ->setCellValue('P1', 'NAMA DISTRIBUSI')
            // produk tambah
            ->setCellValue('R1', 'TAMBAH PRODUCT')
            ->setCellValue('S1', 'ID LOKASI')
            ->setCellValue('T1', 'ID KATEGORI')
            ->setCellValue('U1', 'KATEGORI')
            ->setCellValue('V1', 'ID PRODUCT')
            ->setCellValue('W1', 'NAMA PRODUCT')
            ->setCellValue('X1', 'DESKRIPSI')
            ->setCellValue('Y1', 'HARGA MODAL')
            ->setCellValue('Z1', 'ID SATUAN')
            ->setCellValue('AA1', 'SATUAN')
            // -------------------------------------------
            // distribusi produk
            ->setCellValue('AD1', 'TAMBAH DISTRIBUSI')
            ->setCellValue('AE1', 'ID HARGA')
            ->setCellValue('AF1', 'ID PRODUK')
            ->setCellValue('AG1', 'NAMA PRODUK')
            ->setCellValue('AH1', 'ID DISTRIBUSI')
            ->setCellValue('AI1', 'NAMA DISTRIBUSI')
            ->setCellValue('AJ1', 'LINK')
            ->setCellValue('AK1', 'HARGA')
            // -------------------------------------------
            // video produk
            ->setCellValue('AM1', 'VIDEO PRODUCT')
            ->setCellValue('AN1', 'ID PRODUCT')
            ->setCellValue('AO1', 'NAMA PRODUCT')
            ->setCellValue('AP1', 'ID VIDEO')
            ->setCellValue('AQ1', 'LINK VIDEO');
        // -------------------------------------------
        $lok = 2;
        $lokasi = Lokasi::all();
        foreach ($lokasi as $l) {

            $sheet
                ->setCellValue('B' . $lok, $l->id_lokasi)
                ->setCellValue('C' . $lok, $l->nm_lokasi);
            $lok++;
        }
        $kat = 2;
        $kategori = Kategori::all();
        foreach ($kategori as $l) {

            $sheet
                ->setCellValue('F' . $kat, $l->id_lokasi)
                ->setCellValue('G' . $kat, $l->id_kategori)
                ->setCellValue('H' . $kat, $l->nm_kategori);
            $kat++;
        }
        $sat = 2;
        $satuan = Satuan::all();
        foreach ($satuan as $l) {
            $sheet
                ->setCellValue('K' . $sat, $l->id_satuan)
                ->setCellValue('L' . $sat, $l->nm_satuan);
            $sat++;
        }
        $sat = 2;
        $distribusi = Distribusi::all();
        foreach ($distribusi as $l) {

            $sheet
                ->setCellValue('O' . $sat, $l->id_distribusi)
                ->setCellValue('P' . $sat, $l->nm_distribusi);
            $sat++;
        }
        $pr = 2;
        $produk = Produk::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_produk.id_kategori')
            ->join('tb_satuan', 'tb_satuan.id_satuan', 'tb_produk.id_satuan')
            ->join('tb_lokasi', 'tb_lokasi.id_lokasi', 'tb_produk.id_lokasi')
            ->get();
        foreach ($produk as $l) {

            $sheet
                ->setCellValue('S' . $pr, $l->id_lokasi)
                ->setCellValue('T' . $pr, $l->id_kategori)
                ->setCellValue('U' . $pr, $l->nm_kategori)
                ->setCellValue('V' . $pr, $l->id_produk)
                ->setCellValue('W' . $pr, $l->nm_produk)
                ->setCellValue('X' . $pr, $l->deskripsi)
                ->setCellValue('Y' . $pr, $l->harga_modal)
                ->setCellValue('Z' . $pr, $l->id_satuan)
                ->setCellValue('AA' . $pr, $l->nm_satuan);
            $pr++;
        }
        $har = 2;
        $harga = Harga::join('tb_produk', 'tb_produk.id_produk', '=', 'tb_harga.id_produk')
            ->join('tb_distribusi', 'tb_distribusi.id_distribusi', '=', 'tb_harga.id_distribusi')
            ->get();
        foreach ($harga as $l) {

            $sheet
                ->setCellValue('AE' . $har, $l->id_harga)
                ->setCellValue('AF' . $har, $l->id_produk)
                ->setCellValue('AG' . $har, $l->nm_produk)
                ->setCellValue('AH' . $har, $l->id_distribusi)
                ->setCellValue('AI' . $har, $l->nm_distribusi)
                ->setCellValue('AJ' . $har, $l->link)
                ->setCellValue('AK' . $har, $l->harga);
            $har++;
        }
        $vi = 2;
        $video = Video::join('tb_produk', 'tb_produk.id_produk', '=', 'tb_video.id_produk')
            ->get();
        foreach ($video as $l) {
            $sheet
                ->setCellValue('AN' . $vi, $l->id_produk)
                ->setCellValue('AO' . $vi, $l->nm_produk)
                ->setCellValue('AP' . $vi, $l->id_video)
                ->setCellValue('AQ' . $vi, $l->link_video);
            $vi++;
        }
        $styleArray = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'fff1e6'
                ]
            ]
        ];
        // center
        $sheet->getStyle('A1')->applyFromArray($styleArray);
        $sheet->getStyle('E1')->applyFromArray($styleArray);
        $sheet->getStyle('J1')->applyFromArray($styleArray);
        $sheet->getStyle('N1')->applyFromArray($styleArray);
        $sheet->getStyle('R1')->applyFromArray($styleArray);
        $sheet->getStyle('AD1')->applyFromArray($styleArray);
        $sheet->getStyle('AM1')->applyFromArray($styleArray);

        $merah = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'cd4c4c'
                ]
            ]
        ];
        // colomn merah
        $sheet->getStyle('B1')->applyFromArray($merah);
        $sheet->getStyle('G1')->applyFromArray($merah);
        $sheet->getStyle('K1')->applyFromArray($merah);
        $sheet->getStyle('V1')->applyFromArray($merah);
        $sheet->getStyle('AE1')->applyFromArray($merah);
        $sheet->getStyle('AF1')->applyFromArray($merah);
        $sheet->getStyle('AN1')->applyFromArray($merah);
        $sheet->getStyle('AP1')->applyFromArray($merah);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Format Produk Import.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function hapusProduk(Request $r)
    {
        // hapus file
        $gambar = Produk::where('id_produk', $r->id)->first();
        Facadesfile::delete('assets/uploads/' . $gambar->nm_foto);

        Produk::where('id_produk', $r->id)->delete();
        Harga::where('id_produk', $r->id)->delete();
        Video::where('id_produk', $r->id)->delete();

        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('error', 'Berhasil Hapus Data');
    }

    public function bestSeller(Request $r)
    {
        $data = [
            'title' => 'Best Seller',
            'produk' => Produk::join('tb_lokasi', 'tb_lokasi.id_lokasi', '=', 'tb_produk.id_lokasi')
                ->join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_produk.id_kategori')
                ->get(),
        ];
        return view('bestSeller.bestSeller', $data);
    }

    public function bestSellerInput(Request $r)
    {
        if ($r->cek == 'best_seller') {
            Produk::where('id_produk', $r->id_produk)->update([
                'best_seller' => $r->v
            ]);
        } else {
            Produk::where('id_produk', $r->id_produk)->update([
                'top_rate' => $r->v
            ]);
        }

        return true;
    }

    public function tbhKategoriProduk(Request $r)
    {
        $data = [
            'nm_kategori' => $r->nm_kategori,
            'id_lokasi' => $r->id_lokasi,
        ];
        Kategori::create($data);

        return redirect()->route('produk', ['id_lokasi' => $r->id_lokasi])->with('sukses', 'Berhasil Tambah Kategori');
    }
}
