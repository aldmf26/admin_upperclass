@extends('template.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @php
                    $sumTot = DB::table('tb_transaksi')->where('status', 'SUCCESS')->sum('total');
                    $orderanTot = DB::table('tb_order')->sum('qty');
                    $totTransaksi = DB::table('tb_transaksi')->count('id_transaksi');
                    $totUser = DB::table('user_upperclass')->count('id');
                @endphp
                <div class="row">
                    <div class="col-5">
                        <div class="info-box">
                            <span class="info-box-icon bg-info mr-3"><i class="fas fa-file-invoice-dollar"></i></span>  
                            <div class="info-box-content">
                                <h3>Rp {{ number_format($sumTot,0) }}</h3>
                                <h6 class="text-info">Penghasilan</h6>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                    </div>
                    <div class="col-5">
                        <div class="info-box">
                            <span class="info-box-icon bg-info mr-3"><i class="fas fa-shopping-cart"></i></span>
        
                            <div class="info-box-content">
                                <h3>{{ $orderanTot }}</h3>
                                <h6 class="text-info">Penjualan</h6>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="info-box">
                            <span class="info-box-icon bg-info mr-3"><i class="fas fa-cash-register"></i></span>  
                            <div class="info-box-content">
                                <h3>{{ $totTransaksi }}</h3>
                                <h6 class="text-info">Total Transaksi</h6>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                    </div>
                    <div class="col-5">
                        <div class="info-box">
                            <span class="info-box-icon bg-info mr-3"><i class="fas fa-user"></i></span>
        
                            <div class="info-box-content">
                                <h3>{{ $totUser }}</h3>
                                <h6 class="text-info">Total User Upperclass</h6>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
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
        $(function(){
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                   
                })
              

    </script>
@endsection
