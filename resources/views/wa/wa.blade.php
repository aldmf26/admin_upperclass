@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Nomor Wa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Nomor Wa</li>
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
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NOMOR</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // dd($wa);
                                            $no = 1;
                                            // $wa = DB::table('wa')->get();
                                        @endphp
                                    
                                            <tr>
                                                <td width="10">{{ $no++ }}</td>
                                                <td>{{ $wa->nomor }}</td>
                                                <td align="center">
                                                    <a
                                                        href="#" data-target="#ubah{{$wa->id_wa}}" data-toggle="modal"
                                                        class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                       
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
   
    <form action="{{ route('ubahWa') }}" method="post">
        @csrf
        <div class="modal fade" id="ubah{{$wa->id_wa}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content ">
                    <div class="modal-header btn-costume">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{$wa->id_wa}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Nomor</label>
                                <input required class="form-control" type="text" value="{{$wa->nomor}}" name="nomor">
                                <span class="text-warning"><em>0 diubah 62</em></span>
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
