@extends('template.master')
@section('content')
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
                        <div class="card-header">
                            <a href="#" data-target="#tambah" data-toggle="modal" class="btn btn-md btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>LOKASI</th>
                                        <th>DESKRIPSI</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($footer as $k)
                                        <tr>
                                            <td width="10">{{ $no++ }}</td>
                                            <td>{{ $k->nm_lokasi }}</td>
                                            <td>{{ $k->deskripsi }}</td>
                                            <td align="center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#edit{{ $k->id_footer }}"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                    href="{{ route('hapusKategori', ['id' => $k->id_footer]) }}"
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

<form action="{{ route('tambahFooter') }}" method="post">
    @csrf
    <div class="modal fade" id="tambah" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header btn-costume">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Footer Info</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for=""></label>
                                <select name="id_lokasi" id="" class="form-control">
                                    <option value="">- Pilih Lokasi -</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{$l->id_lokasi}}">{{$l->nm_lokasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="ckeditor" id="ckedtor" name="deskripsi"></textarea>
                            </div>
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

{{-- edit footer --}}
@foreach ($footer as $f)
<form action="{{ route('ubahFooter') }}" method="post">
    @csrf
    <div class="modal fade" id="edit{{$f->id_footer}}" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-header btn-costume">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Ubah Footer Info</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="id_footer" value="{{$f->id_footer}}">
                                <label for=""></label>
                                <select name="id_lokasi" id="" class="form-control">
                                    <option value="">- Pilih Lokasi -</option>
                                    @foreach ($lokasi as $l)
                                        <option {{$f->id_lokasi == $l->id_lokasi ? 'selected' : ''}} value="{{$l->id_lokasi}}">{{$l->nm_lokasi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="ckeditor" id="ckedtor" name="deskripsi">{{$f->deskripsi}}</textarea>
                            </div>
                        </div>                       
                        @php
                            $sosmed = DB::table('tb_footer_sosmed')->where('id_footer', $f->id_footer)->get();
                        @endphp
                        
                       
                            <div class="col-12">
                                <div class="form-group">
                                <label for="">Nama Sosmed</label>
                                @foreach ($sosmed as $s)
                                <input type="hidden" name="id_footer_sosmed[]" value="{{$s->id_fs}}">
                                <input class="form-control" type="text" value="{{$s->nm_sosmed}}" readonly>
                                <input class="form-control mb-3" type="text" value="{{$s->link}}" name="link[]">
                                @endforeach
                            </div>
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
@endforeach
{{-- ------------- --}}
<!-- /.content-wrapper -->
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