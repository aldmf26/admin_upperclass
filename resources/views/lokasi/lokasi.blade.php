@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Lokasi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Lokasi</li>
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
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA LOKASI</th>
                                            <th>GAMBAR</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tr>
                                            <form action="{{ route('tambahLokasi') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <td></td>
                                                <td><input autofocus required type="text" class="form-control"
                                                        name="nm_lokasi">
                                                </td>
                                                <td><input autofocus required type="file" class="form-control"
                                                        name="gambar"><span class="text-info"><em>size : 1200 x 809</em></span>
                                                </td>
                                                <td><button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @foreach ($lokasi as $k)
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $k->nm_lokasi }}</td>
                                                <td>
                                                    <img width="100%" src="{{asset('assets')}}/uploads/{{ $k->gambar }}" alt="">
                                                </td>
                                                <td align="right ">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit_data{{ $k->id_lokasi }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusLokasi', ['id' => $k->id_lokasi]) }}"
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
    @foreach ($lokasi as $s)
        <form action="{{ route('ubahLokasi') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="modal fade" id="edit_data{{ $s->id_lokasi }}" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Kategori</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $s->id_lokasi }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <img width="100%" src="{{ asset('assets') }}/uploads/{{ $s->gambar }}" alt="">
                                    <span class="text-info"><em>size : 1200 x 809</em></span>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Nama Kategori</label>
                                            <input class="form-control" type="text" value="{{ $s->nm_lokasi }}"
                                                name="nm_lokasi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Gmbar</label>
                                            <input class="form-control" type="file"
                                                name="gambar">
                                        </div>
                                    </div>
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
