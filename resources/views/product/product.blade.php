@extends('template.master')
@section('content')
    <style>
        .modal-lg-max {
            max-width: 800px;
        }
        .modal-mds {
            max-width: 700px;
        }

    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    @foreach ($lokasi as $l)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $id_lokasi == $l->id_lokasi ? 'active' : '' }}"
                                                href="?id_lokasi={{ $l->id_lokasi }}">{{ $l->nm_lokasi }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <a href="#" data-target="#tambah" data-toggle="modal" class="btn btn-primary btn-sm"><i
                                        class="fas fa-plus"></i> Tambah Produk</a>
                                <a href="#" data-target="#import" data-toggle="modal" class="btn btn-primary btn-sm"><i
                                        class="fas fa-file-import"></i> Import</a>
                                        <!-- Example split danger button -->
                                {{-- <a href="{{ route('exportFormat') }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-file"></i> Format Import</a> --}}

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>KATEGORI</th>
                                            <th>NAMA PRODUK</th>
                                            <th>LOKASI</th>
                                            <th>DISTRIBUSI / LINK</th>
                                            <th>Video Produk</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($produk1 as $k)
                                            @php
                                                $video = DB::table('tb_video')
                                                    ->where('id_produk', $k->id_produk)
                                                    ->get();
                                            @endphp
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $k->nm_kategori }}</td>
                                                <td>{{ $k->nm_produk }}</td>
                                                <td>{{ $k->nm_lokasi }}</td>
                                                @php
                                                    $harga = DB::table('tb_harga')
                                                        ->select('tb_harga.*', 'tb_distribusi.*')
                                                        ->join('tb_distribusi', 'tb_harga.id_distribusi', '=', 'tb_distribusi.id_distribusi')
                                                        ->where('id_produk', $k->id_produk)
                                                        ->get();
                                                @endphp
                                                <td style="white-space: nowrap;" align="center">
                                                    @foreach ($harga as $h)
                                                        @php
                                                            if (Str::lower($h->nm_distribusi) == 'shopee') {
                                                                $icon = 'https://img.icons8.com/color/48/000000/shopee.png';
                                                            } elseif (Str::lower($h->nm_distribusi) == 'tokopedia') {
                                                                $icon = 'https://www.freepnglogos.com/uploads/logo-tokopedia-png/logo-tokopedia-15.png';
                                                            }
                                                            $w = 40;
                                                        @endphp
                                                        <img class="tes" src="{{ $icon }}"
                                                            width="{{ $w }}" />
                                                        : <a href="{{ $h->link }}" target="blank"><button
                                                                class="btn btn-primary btn-sm">Go</button></a><br>
                                                    @endforeach
                                                    <button data-target="#tbhDistribusi{{ $k->id_produk }}"
                                                        data-toggle="modal" class="btn btn-light btn-sm float-right"><i
                                                            class="fa fa-plus"></i></button>
                                                </td>
                                                <td>
                                                    @foreach ($video as $v)
                                                        <a href="{{ $v->link_video }}"
                                                            target="blank">{{ $v->link_video }}</a>
                                                    @endforeach
                                                </td>
                                                <td align="center">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit{{ $k->id_produk }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ?')"
                                                        href="{{ route('hapusProduk', ['id' => $k->id_produk, 'id_lokasi' => $id_lokasi]) }}"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    {{-- tambah distribusi --}}
    @foreach ($produk as $k)
        <form action="{{ route('tbhDistribusi') }}" method="post">
            @csrf
            <div class="modal fade" id="tbhDistribusi{{ $k->id_produk }}" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Distribusi</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id_produk" value="{{ $k->id_produk }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Distribusi</label>
                                    <select name="id_distribusi" class="form-control" id="">
                                        <option value="">- Pilih Distribusi -</option>
                                        @foreach ($distribusi as $d)
                                            <option value="{{ $d->id_distribusi }}">{{ $d->nm_distribusi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Harga</label>
                                    <input class="form-control" type="number" name="harga">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Link</label>
                                    <input class="form-control" type="link" name="link">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-success">Edit / Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    {{-- ---------------------- --}}
    {{-- import --}}
    <form action="{{ route('importProduk') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="modal fade" id="import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-mds" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Import Produk</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <table>
                                <tr>
                                <td width="100" class="pl-2">
                                    <img width="80px" src="{{ asset('assets') }}/img/1.png" alt="">
                                </td>
                                <td>
                                    <span style="font-size: 20px;"><b> Download Excel template</b></span><br>
                                    File ini memiliki kolom header dan isi yang sesuai dengan data produk
                                </td>
                                <td>
                                    <a href="{{ route('exportFormat') }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> DOWNLOAD TEMPLATE</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td width="100" class="pl-2">
                                    <img width="80px" src="{{ asset('assets') }}/img/2.png" alt="">
                                </td>
                                <td>
                                    <span style="font-size: 20px;"><b> Upload Excel template</b></span><br>
                                    Setelah mengubah, silahkan upload file.
                                </td>
                                <td>
                                    <input type="file" name="file" class="form-control">
                                </td>
                            </tr>
                            </table>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit / Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- -------------------------------- --}}
    
    {{-- tambah produk --}}
    <form action="{{ route('tambahProduk') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="modal fade" id="tambah" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id_lokasi" value="{{ $id_lokasi }}">
                            <div class="col-md-3">
                                <label for="" class="form-label">Kategori</label>
                                <select class="form-control" name="id_kategori" id="tbh">
                                    <option value="">- Pilih Kategori -</option>
                                    
                                    <div id="katego"></div>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->nm_kategori }}</option>
                                    @endforeach
                                    
                                    {{-- <button class="btn btn-primary">Tambah Kategori</button>
                                    <option value="" id="tmbhkat" data-toggle="modal" data-target="#tbhKategori" class="btn btn-primary text-center"><a href="#" >Tambah Kategori</a></option> --}}
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="">Aksi</label>
                                <a href="#" data-target="#tbhKategori" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </div>
                            <div class="col-md-4">
                                <label for="formFile">Foto</label>
                                <input class="form-control" type="file" name="foto" id="formFile">
                            </div>
                            <div class="col-md-2">
                                <label for="">Satuan</label>
                                <select class="form-control" name="id_satuan" id="">
                                    <option value="">- Satuan -</option>
                                    @foreach ($satuan as $k)
                                        <option value="{{ $k->id_satuan }}">{{ $k->nm_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Gram</label>
                                <input type="number" class="form-control" name="gr">
                            </div>
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control" name="nm_produk">
                            </div>
                            <div class="col-md-4">
                                <label for="">Harga Modal</label>
                                <input type="number" class="form-control" name="harga_modal">
                            </div>
                            <div class="col-md-4">
                                <label for="">Produk Video</label>
                                <input type="url" class="form-control" name="link_video">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-12">
                                <label for="">Deskripsi</label>
                                <textarea class="ckeditor" id="ckedtor" name="deskripsi"></textarea>
                                {{-- <input type="textarea" name="deskripsi" class="form-control"> --}}
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="">Stok</label>
                                <input type="number" name="stok" class="form-control">
                            </div> --}}

                        </div><br>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Distribusi</label>
                                <select name="id_distribusi[]" class="form-control" id="">
                                    <option value="">- Pilih Distribusi -</option>
                                    @foreach ($distribusi as $d)
                                        <option value="{{ $d->id_distribusi }}">{{ $d->nm_distribusi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="">Link</label>
                                <input type="url" class="form-control" name="link[]">
                            </div>
                            <div class="col-3">
                                <label for="">Harga</label>
                                <input type="number" class="form-control" name="harga[]">
                            </div>
                            <div class="col-1">
                                <label for="">Aksi</label>
                                <a href="#" class="btn btn-success btn-sm" id="tambah_distribusi"><i
                                        class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div id="add_distribusi">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit / Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    

    {{-- --------------------------------- --}}
    {{-- edit produk --}}
    @foreach ($produk as $s)
        <form action="{{ route('ubahProduk') }}" enctype="multipart/form-data" method="post">

            @csrf
            <div class="modal fade" id="edit{{ $s->id_produk }}" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Produk</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_produk" value="{{ $s->id_produk }}">
                            <input type="hidden" name="id_lokasi" value="{{ $id_lokasi }}">
                            <div class="row">
                                <div class="col-6">
                                    <img width="100%"
                                        src="{{ asset('assets') }}/uploads/{{ $s->foto == '' ? 'noimage.jpg' : $s->foto }}"
                                        alt="">
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                    </div>
                                    @php
                                        $video = DB::table('tb_video')
                                            ->where('id_produk', $s->id_produk)
                                            ->get();
                                        
                                    @endphp
                                    <label class="mt-2" for="">Product Video</label>
                                    @foreach ($video as $v)
                                        <div class="row">
                                            <div class="col-10">
                                                {{-- <label for="">Product Video</label> --}}
                                                <input type="url" name="link_video[]" class="form-control"
                                                    value="{{ $v->link_video }}">
                                            </div>
                                            <div class="col-2">
                                                <a href="{{ route('hapusLinkV', ['id' => $v->id_video]) }}"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_video[]" value="{{ $v->id_video }}">
                                    @endforeach
                                    <input type="text" name="link_v_i" class="form-control">

                                </div>
                                <div class="col-6">
                                    <div class="row mb-3 mb-3">
                                        <div class="col-6">
                                            <label for="" class="form-label">Kategori</label>
                                            <select class="form-control" name="id_kategori" id="">
                                                <option value="">- Pilih Kategori -</option>
                                                @foreach ($kategori as $k)
                                                    <option {{ $s->id_kategori == $k->id_kategori ? 'selected' : '' }}
                                                        value="{{ $k->id_kategori }}">{{ $k->nm_kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Satuan</label>
                                            <select class="form-control" name="id_satuan" id="">
                                                <option value="">- Satuan -</option>
                                                @foreach ($satuan as $k)
                                                    <option {{ $s->id_satuan == $k->id_satuan ? 'selected' : '' }}
                                                        value="{{ $k->id_satuan }}">{{ $k->nm_satuan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Gram</label>
                                            <input class="form-control" type="number" name="gr" value="{{ $s->gr }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="">Nama Produk</label>
                                            <input type="text" value="{{ $s->nm_produk }}" class="form-control"
                                                name="nm_produk">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <textarea class="ckeditor" id="ckedtor" name="deskripsi">{{ $s->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    @php
                                        $harga = DB::table('tb_harga')
                                            ->select('tb_harga.*', 'tb_distribusi.*')
                                            ->join('tb_distribusi', 'tb_harga.id_distribusi', '=', 'tb_distribusi.id_distribusi')
                                            ->where('id_produk', $s->id_produk)
                                            ->get();
                                    @endphp
                                    @foreach ($harga as $h)
                                    <input type="hidden" name="id_distribusi[]" value="{{ $h->id_distribusi }}">
                                    <input type="hidden" name="id_harga[]" value="{{ $h->id_harga }}">
                                        @php
                                            if (Str::lower($h->nm_distribusi) == 'shopee') {
                                                $icon = 'https://img.icons8.com/color/48/000000/shopee.png';
                                            } elseif (Str::lower($h->nm_distribusi) == 'tokopedia') {
                                                $icon = 'https://www.freepnglogos.com/uploads/logo-tokopedia-png/logo-tokopedia-15.png';
                                            }
                                            $w = 48;
                                        @endphp
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-10">
                                                <label for="">Harga</label>
                                                <input class="form-control" type="number" name="harga[]"
                                                    value="{{ $h->harga }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <img class="tes" src="{{ $icon }}"
                                                    width="{{ $w }}" />
                                            </div>
                                            <div class="col-10">
                                                <input class="form-control" type="text" name="link[]"
                                                    value="{{ $h->link }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-images btn-block" data-toggle="modal"
                                        data-target="#modalDropzone{{ $s->id_produk }}">Upload
                                        Images</a>
                                </div>
                            </div> --}}

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Edit / Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="modalDropzone{{ $s->id_produk }}" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Upload Images</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('uploadImages', ['id_produk' => $s->id_produk]) }}"
                            class="dropzone" method="get" enctype="multipart/form-data">

                            {{ csrf_field() }}

                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Edit / Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- ------------------------------------- --}}
     {{-- tambah kategori -------------------------------- --}}
       
     <form method="post" action="{{ route('tbhKategoriProduk') }}">
        @csrf
        <div class="modal fade" id="tbhKategori" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id_lokasi" value="{{ $id_lokasi }}" id="id_lokasi">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nama Kategori</label>
                                <input autofocus class="form-control" type="text"
                                    name="nm_kategori">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Edit / Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection
@section('script')
    <script>
        <?php if(Session::get('sukses')) { ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            icon: 'success',
            title: "{{ Session::get('sukses') }}"
        });
        <?php }elseif(Session::get('error')) { ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            icon: 'error',
            title: "{{ Session::get('error') }}"
        });
        <?php } ?>
        $(document).ready(function() {
            $(document).on('click', '.tes', function() {
                alert(1)
            })
            var jml = 1;
            $('#tambah_distribusi').click(function() {
                jml += 1
                var html = "<div class='row mt-3' id='row_stk" + jml + "'>"
                html +=
                    '<div class="col-3"><select name="id_distribusi[]" class="form-control" id=""><option value="">- Pilih Distribusi -</option>@foreach ($distribusi as $d)<option value="{{ $d->id_distribusi }}">{{ $d->nm_distribusi }}</option>@endforeach</select></div > '
                html +=
                    '<div class="col-3"><input type="url" class="form-control" name="link[]"></div>'
                html +=
                    '<div class="col-3"><input type="number" class="form-control" name="harga[]"></div>'
                html +=
                    '<div class="col-1"><a href="#" class="btn btn-danger btn-sm remove_stk" data-row="row_stk' +jml + '"><i class="fa fa-minus"></i></a></div>'
                html += '</div>'
                $('#add_distribusi').append(html);
                $('.select').select2()
            })

            $(document).on('click', '.remove_stk', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });

            $('.modal').on('hidden.bs.modal', function () {
            //If there are any visible
            if($(".modal:visible").length > 0) {
                //Slap the class on it (wait a moment for things to settle)
                setTimeout(function() {
                    $('body').addClass('modal-open');
                },200)
            }

            // $(document).on('submit', '#formtbhKategori', function(){
            //     event.preventDefault();
            //     var id_lokasi = $('#id_lokasi').val()
            //     var kategori = $('#tbhKategori').serialize()
                
            //     $.ajax({
            //         type: "GET",
            //         url: "{{route('tbhKategoriProduk')}}?aksi=1&"+kategori,
            //         contentType: false,
            //         processData: false,
            //         success: function (response) {
            //             Swal.fire({
            //             toast: true,
            //             position: 'top-end',
            //             showConfirmButton: false,
            //             timer: 3000,
            //             icon: 'success',
            //             title: 'Post center berhasil dibuat'
            //             });
            //         }
            //     });
            // })
        });

        })

        
    </script>
@endsection
