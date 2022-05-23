<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets') }}/dist/img/logoup.png" alt="AdminLTE Logo"
            class="brand-image image-center elevation-3" style="opacity: .8">
        <p class="text-block text-info text-md">Admin Upperclass</p>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="
                        nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk') }}" class="nav-link {{ request()->is('produk') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi') }}" class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i> 
                        <p>Transaksi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Database
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('voucher') }}"
                            class="nav-link {{ request()->is('voucher') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Voucher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bestSeller') }}"
                            class="nav-link {{ request()->is('bestSeller') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Best Seller / Top Rate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('banner') }}"
                                class="nav-link {{ request()->is('banner') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}"
                                class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Us</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('footer') }}"
                                class="nav-link {{ request()->is('footer') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Footer Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lokasi') }}"
                                class="nav-link {{ request()->is('lokasi') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lokasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori') }}"
                                class="nav-link {{ request()->is('kategori') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('satuan') }}"
                                class="nav-link {{ request()->is('satuan') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('distribusi') }}"
                                class="nav-link {{ request()->is('distribusi') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Distribusi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('wa') }}"
                                class="nav-link {{ request()->is('wa') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nomor Whatsapp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user') }}"
                                class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
