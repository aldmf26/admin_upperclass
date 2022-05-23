@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">About Us</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">About Us</li>
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
                            <div class="card-header">
                                {{-- <a href="#" class="btn btn-md btn-primary" data-target="#tambah" data-toggle="modal">Tambah
                                    About</a> --}}
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>FOTO</th>
                                            <th>Keterangan</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp                                    
                                        @foreach ($about as $k)
                                            <tr>
                                                <td width="10" align="center">{{ $no++ }}</td>
                                                <td align="center">
                                                    <img width="50%"
                                                        src="{{ asset('assets') }}/uploads/{{ $k->gambar }}" alt="">
                                                    <a href="#" data-toggle="modal" data-target="#edit{{ $k->id_about }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>{{ $k->ket }}</td>
                                                <td align="center ">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#edit_data{{ $k->id_about }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                        href="{{ route('hapusAbout', ['id' => $k->id_about]) }}"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit{{ $k->id_about }}" role="dialog"
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
                                                            <input type="hidden" name="id_about"
                                                                value="{{ $k->id_about }}">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">

                                                                    <img width="100%"
                                                                        src="{{ asset('assets') }}/uploads/{{ $k->gambar }}"
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
    {{-- tambah about --}}
        <form action="{{ route('tambahAbout') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="tambah" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah About</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Gmbar</label>
                                    <input class="form-control" type="file"
                                        name="gambar">
                                        <p class="text-info"><em>size : 1200 x 1200</em></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="">Keterangan</label>
                                    <input class="form-control" type="text"
                                        name="ket">
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
    {{--  --}}
    {{-- ---------------------------------------------- --}}

    {{-- edit banner --}}
    @foreach ($about as $s)
        <form enctype="multipart/form-data" action="{{ route('ubahAbout') }}" method="post">

            @csrf
            <div class="modal fade" id="edit_data{{ $s->id_about }}" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header btn-costume">
                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Teks Banner</h5>
                            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{ $s->id_about }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" value="{{ $s->gambar }}" name="gambarIsi">
                                    <img width="100%" src="{{ asset('assets') }}/uploads/{{ $s->gambar }}" alt="">
                                    <p class="text-info"><em>size : 1200 x 1200</em></p>
                                </div>
                                <div class="col-6">           
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Keterangan</label>
                                            <input class="form-control" disabled type="text" value="{{ $s->ket }}"
                                                name="ket">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Gmbar</label>
                                            <input class="form-control" value="{{$s->gambar}}" type="file"
                                                name="gambar">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <textarea class="ckeditor" id="ckedtor" name="teks1">{{ $s->teks1 }}</textarea>
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
