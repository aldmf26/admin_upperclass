@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Best Seller Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Best Seller Product</li>
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
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>FOTO</th>
                                            <th>LOKASI</th>
                                            <th>KATEGORI</th>
                                            <th>NAMA PRODUK</th>
                                            <th>BEST SELLER</th>
                                            <th>TOP RATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($produk as $k)
                                            <tr>
                                                <td width="10" align="center">{{ $no++ }}</td>
                                                <td align="center">
                                                    <img width="30%"
                                                        src="{{ asset('assets') }}/uploads/{{ $k->foto }}" alt="">
                                                    <a href="#" data-toggle="modal" data-target="#edit{{ $k->id_produk }}"
                                                        class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>{{ $k->nm_lokasi }}</td>
                                                <td>{{ $k->nm_kategori }}</td>
                                                <td>{{ $k->nm_produk }}</td>
                                                <td>
                                                    {{-- <a href="{{route('bestSellerInput', ['id' => $k->id_produk])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                    <?php if($k->best_seller == ''){ ?>
                                                    <a class="btn btn-sm btn-info btnInput" cek="best_seller" value="ON"
                                                        id_produk="{{ $k->id_produk }}">OFF</a>
                                                    <?php }else{ ?>
                                                    <a class="btn btn-sm btn-primary btnDelete" cek="best_seller" value=""
                                                        id_produk="{{ $k->id_produk }}">ON</a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    {{-- <a href="{{route('bestSellerInput', ['id' => $k->id_produk])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --}}
                                                    <?php if($k->top_rate == ''){ ?>
                                                    <a class="btn btn-sm btn-info btnInput" cek="top_rate" value="ON"
                                                        id_produk="{{ $k->id_produk }}">OFF</a>
                                                    <?php }else{ ?>
                                                    <a class="btn btn-sm btn-primary btnDelete" cek="top_rate" value=""
                                                        id_produk="{{ $k->id_produk }}">ON</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit{{ $k->id_produk }}" role="dialog"
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
                                                                value="{{ $k->id_produk }}">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12">
                                                                    <img width="100%"
                                                                        src="{{ asset('assets') }}/uploads/{{ $k->foto }}"
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




    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btnInput', function() {
                var id_produk = $(this).attr('id_produk')
                var value = $(this).attr('value')
                var cek = $(this).attr('cek')

                $.ajax({
                    type: "GET",
                    url: "{{ route('bestSellerInput') }}?id_produk=" + id_produk + "&v=" +
                        value + "&cek=" + cek,
                    success: function(response) {
                        location.reload();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'success',
                            title: "Produk telah masuk best seller"
                        });
                    }
                });
            })
            $(document).on('click', '.btnDelete', function() {
                var id_produk = $(this).attr('id_produk')
                var value = $(this).attr('value')
                var cek = $(this).attr('cek')

                $.ajax({
                    type: "GET",
                    url: "{{ route('bestSellerInput') }}?id_produk=" + id_produk + "&v=" +
                        value + "&cek=" + cek,
                    success: function(response) {
                        location.reload();
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            icon: 'error',
                            title: "Produk dihapus dari best seller"
                        });
                    }
                });

            })


        })
        // <?php if(Session::get('sukses')) { ?>

        // <?php }elseif(Session::get('error')) { ?>

        // <?php } ?>
    </script>
@endsection
