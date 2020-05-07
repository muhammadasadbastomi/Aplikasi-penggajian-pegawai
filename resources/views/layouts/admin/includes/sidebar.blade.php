<aside class="main-sidebar elevation-4 sidebar-dark-danger">
    <!-- Brand Logo -->
    <a href="{{ route('adminIndex') }}" class="brand-link text-sm navbar-secondary">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 519px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid"
                style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu Data -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy nav-child-indent"
                            data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Sidebar Menu Data Master Admin -->
                            @if(auth()->user()->role == 'admin')
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="{{route('jabatanIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Jabatan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('golonganIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Golongan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('pegawaiIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Pegawai</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('periodekaryawanIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Gaji Karyawan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('periodeIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Gaji Pegawai</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('jabatanIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Absensi Pegawai</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- End Sidebar Menu Data Master Admin -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-money-check-alt"></i>
                                    <p>
                                        Data Gaji Pegawai
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('userIndex') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Admin
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('periodeIndex')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Data Absensi Pegawai
                                    </p>
                                </a>
                            </li>
                            @else
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Data Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: block;">
                                    <li class="nav-item">
                                        <a href="{{route('periodeUserIndex')}}" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Data Absensi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('absensiIndex')}}" class="nav-link active">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                        Data Absensi Pegawai
                                    </p>
                                </a>
                            </li>
                        </ul>

                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 49.6657%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>