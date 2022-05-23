@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Distribusi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Distribusi</li>
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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA DISTRIBUSI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tr>
                                            <form action="{{ route('tambahDistribusi') }}" method="post">
                                                @csrf
                                                <td></td>
                                                <td><input autofocus required type="text" class="form-control"
                                                        name="nm_distribusi">
                                                </td>
                                                <td><button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @foreach ($distribusi as $k)
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $k->nm_distribusi }}</td>
                                                <td align="right ">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit{{ $k->id_distribusi }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusDistribusi', ['id' => $k->id_distribusi]) }}"
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
    @foreach ($distribusi as $s)
        <form action="{{ route('ubahDistribusi') }}" method="post">

            @csrf
            <div class="modal fade" id="edit{{ $s->id_distribusi }}" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Distribusi</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $s->id_distribusi }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Nama Distribusi</label>
                                    <input class="form-control" type="text" value="{{ $s->nm_distribusi }}"
                                        name="nm_distribusi">
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
