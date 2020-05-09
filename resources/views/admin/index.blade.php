@extends('layouts.admin.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    @if($cek === 2)
                    Dashboard
                    @else
                    Dashboard Absensi Periode Bulan {{carbon\carbon::now()->translatedFormat('F Y')}}
                    @endif
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Home</a></li>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>Total Karyawan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Total Karyawan <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Karyawan Kontrak</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Karyawan Tetap</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @if(Auth::user()->role =='pegawai' && $absensi != null)
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <a id="hadir" disabled="disabled" href="{{route('absensiUserHadir')}}">
                                    <span class="info-box-text text-white">Hadir</span>
                                    <span class="info-box-number text-white">*****</span>
                                    @if($absensi->hadir == 1 && $absensi->status == 1)
                                    <h3>✔<sup style="font-size: 20px"></sup></h3>
                                    @else
                                    <h3 class="text-body">-</h3>
                                    @endif
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="far fa-comment"></i></span>

                            <div class="info-box-content">
                                <a href="{{route('absensiUserIzin')}}">
                                    <span class="info-box-text text-white">Izin</span>
                                    <span class="info-box-number text-white">****</span>
                                    @if($absensi->izin == 1 && $absensi->status == 1)
                                    <h3>✔<sup style="font-size: 20px"></sup></h3>
                                    @else
                                    <h3 class="text-body">-</h3>
                                    @endif
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                            <div class=" info-box-content">
                                <a>
                                    <span class="info-box-text text-black">Tanpa Keterangan </span>
                                    <span class="info-box-number text-black">*****************</span>
                                    @if($absensi->alfa == 1 && $absensi->status == 1)
                                    <h3>✔<sup style="font-size: 20px"></sup></h3>
                                    @else
                                    <h3 class="text-body">-</h3>
                                    @endif
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="far fa-heart"></i></span>

                            <div class="info-box-content">
                                <a href="{{route('absensiUserSakit')}}">
                                    <span class="info-box-text text-white">Sakit</span>
                                    <span class="info-box-number text-white">*****</span>
                                    @if($absensi->sakit == 1 && $absensi->status == 1)
                                    <h3>✔<sup style="font-size: 20px"></sup></h3>
                                    @else
                                    <h3 class="text-body">-</h3>
                                    @endif
                                </a>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="row">
                        <p>Note : {{$keterangan}}</p>
                    </div>
                </div>
            </div>
            @else
            <h2 class="text-danger">Periode belum dibuat</h2>
            @endif
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection