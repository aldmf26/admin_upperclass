@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Transaksi Masuk</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi Masuk</li>
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
                                            <th class="text-center">#</th>
                                            <th width='100' class="text-center">NO ORDER</th>
                                            <th>NAMA</th>
                                            <th>EMAIL</th>
                                            <th>NO HP</th>
                                            <th class="text-center">TRANSAKSI TOTAL</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($transaksi as $t)
                                        <tr>
                                            <td align="center">{{$no++}}</td>
                                            <td align="center">{{ Str::substr($t->no_order,14) }}</td>
                                            <td>{{$t->name}}</td>
                                            <td>{{$t->email}}</td>
                                            <td>{{$t->nohp}}</td>
                                            <td align="right">{{number_format($t->totTransaksi,0)}}</td>
                                            <td align="center">
                                                @if ($t->status == 'PENDING')
                                                    <span class="badge badge-info">PENDING</span>
                                                @elseif($t->status == 'DELIVERED')
                                                    <span class="badge badge-success">DELIVERED</span>
                                                @elseif($t->status == 'FAILED')
                                                    <span class="badge badge-warning">FAILED</span>    
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <a href="{{ route('setStatus', ['id' => $t->id_transaksi, 'status' => 'DELIVERED']) }}" class="btn btn-DELIVERED btn-sm">DELIVERED</a>
                                            </td> --}}
                                            <td align="center">
                                                <a
                                                    href="#" data-toggle="modal" data-target="#detail{{$t->id_transaksi}}"
                                                    class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                {{-- <a onclick="return confirm('Apakah ingin dihapus ?')"
                                                    href="{{ route('hapusUser', ['id' => $k->id_user]) }}"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --}}
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
    @foreach ($transaksi as $t)
    <div class="modal fade" id="detail{{$t->id_transaksi}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header btn-costume">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th width="30%">Nama</th>
                            <td>{{$t->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$t->email}}</td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>{{$t->nohp}}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{$t->alamat}}</td>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <td>{{number_format($t->shipping,0)}}</td>
                        </tr>
                        <tr>
                            <th>Voucher</th>
                            <td>{{$t->voucher == '' ? 'tidak ada' : number_format($t->voucher,0)}}</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td>{{number_format($t->totTransaksi,0)}}</td>
                        </tr>
                        <tr>
                            <th>Status Transaksi</th>
                            <td>{{$t->status}}</td>
                        </tr>
                        <tr>
                            <th>Pembelian Produk</th>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                    </tr>
                                    @php
                                        $produk = DB::table('tb_produk')->join('tb_harga', 'tb_harga.id_harga', '=', 'tb_produk.id_produk')->join('tb_order', 'tb_order.id_harga', '=','tb_harga.id_harga')->where('tb_order.no_order', $t->no_order)->get();
                                    @endphp
                                    @foreach ($produk as $p)
                                        <tr>
                                            <td>{{ $p->nm_produk }}</td>
                                            <td>{{ $p->qty }}</td>
                                            <td>{{ $p->harga }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-4">
                            <a href="{{ route('setStatus', ['id' => $t->id_transaksi, 'status' => 'DELIVERED']) }}" class="btn btn-success btn-sm btn-block"><i class="fa fa-check"></i> Set Sukses</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('setStatus', ['id' => $t->id_transaksi, 'status' => 'FAILED']) }}" class="btn btn-warning btn-sm btn-block"><i class="fa fa-times"></i> Set Gagal</a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('setStatus', ['id' => $t->id_transaksi, 'status' => 'PENDING']) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-spinner"></i> Set Pending</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-DELIVERED">Save</button>
                </div>
            </div>
        </div>
    </div>
        
    @endforeach
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