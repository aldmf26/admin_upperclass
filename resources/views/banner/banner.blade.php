@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Banner</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Banner</li>
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
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>FOTO</th>
                                            <th>TEKS 1</th>
                                            <th>TEKS 2</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tr>
                                            <form action="{{ route('tambahBanner') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <td></td>
                                                <td><input autofocus required type="file" class="form-control"
                                                        name="foto"><span class="text-info"><em>size : 1920 x 930</em></span>
                                                </td>
                                                <td><input autofocus required type="text" class="form-control"
                                                        name="teks1">
                                                </td>
                                                <td><input required autofocus required type="text" class="form-control"
                                                        name="teks2">
                                                </td>
                                                <td><button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @foreach ($banner as $k)
                                            <tr>
                                                <td width="10" align="center">{{ $no++ }}</td>
                                                <td align="center">
                                                    <img width="30%"
                                                        src="{{ asset('assets') }}/uploads/{{ $k->nm_foto }}" alt="">
                                                    <a href="#" data-toggle="modal" data-target="#edit{{ $k->id_banner }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>{{ $k->teks1 }}</td>
                                                <td>{{ $k->teks2 }}</td>
                                                <td align="center ">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit_data{{ $k->id_banner }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusBanner', ['id' => $k->id_banner]) }}"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit{{ $k->id_banner }}" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header btn-costume">
                                                            <h5 class="modal-title text-dark" id="exampleModalLabel">View
                                                                Foto</h5>
                                                            <button type="button" class="close text-dark"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_banner"
                                                                value="{{ $k->id_banner }}">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">

                                                                    <img width="100%"
                                                                        src="{{ asset('assets') }}/uploads/{{ $k->nm_foto }}"
                                                                        alt="">


                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    {{-- edit banner --}}
    @foreach ($banner as $s)
        <form action="{{ route('ubahBanner') }}" method="post">

            @csrf
            <div class="modal fade" id="edit_data{{ $s->id_banner }}" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Teks Banner</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $s->id_banner }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Teks 1</label>
                                    <input class="form-control" type="text" value="{{ $s->teks1 }}" name="teks1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Teks 2</label>
                                    <input class="form-control" type="text" value="{{ $s->teks2 }}" name="teks2">
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
    {{-- --------------------- --}}



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
