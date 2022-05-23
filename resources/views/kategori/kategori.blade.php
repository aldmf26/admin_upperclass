@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Katagori Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Katagori Product</li>
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
                    <div class="col-9">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA KATEGORI</th>
                                            <th>LOKASI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tr>
                                            <form action="{{ route('tambahKategori') }}" method="post">
                                                @csrf
                                                <td></td>
                                                <td><input required type="text" class="form-control" name="nm_kategori">
                                                </td>
                                                <td>
                                                    <select name="id_lokasi" id="" class="form-control">
                                                        <option value="" class="form-control">- Pilih Lokasi -</option>
                                                        @foreach ($lokasi as $l)
                                                            <option value="{{ $l->id_lokasi }}">{{ $l->nm_lokasi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @foreach ($kategori as $k)
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $k->nm_kategori }}</td>
                                                <td>{{ $k->nm_lokasi }}</td>
                                                <td align="center">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit_data{{ $k->id_kategori }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusKategori', ['id' => $k->id_kategori]) }}"
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

    {{-- edit kategori --}}
    @foreach ($kategori as $s)
        <form action="{{ route('ubahKategori') }}" method="post">

            @csrf
            <div class="modal fade" id="edit_data{{ $s->id_kategori }}" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Kategori</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $s->id_kategori }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Nama Kategori</label>
                                    <input class="form-control" type="text" value="{{ $s->nm_kategori }}"
                                        name="nm_kategori">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Nama Lokasi</label>
                                    <select class="form-control" name="id_lokasi" id="">
                                        <option value="">- Pilih Lokasi -</option>
                                        @foreach ($lokasi as $l)
                                            <option {{ $s->id_lokasi == $l->id_lokasi ? 'selected' : '' }}
                                                value="{{ $l->id_lokasi }}">{{ $l->nm_lokasi }}</option>
                                        @endforeach
                                    </select>
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
    {{--  --}}

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
    </script>
@endsection
