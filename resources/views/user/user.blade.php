@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                            <div class="card-header">
                                <a href="#" class="btn btn-md btn-primary" data-target="#tbhUser" data-toggle="modal">Tambah
                                    User</a>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>USERNAME</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($user as $k)
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $k->nama }}</td>
                                                <td>{{ $k->username }}</td>
                                                <td align="center">

                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusUser', ['id' => $k->id_user]) }}"
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
    <form action="{{ route('tambahUser') }}" method="post">

        @csrf
        <div class="modal fade" id="tbhUser" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nama</label>
                                <input required class="form-control" type="text" name="nama">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Username</label>
                                <input class="form-control" type="text" name="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
