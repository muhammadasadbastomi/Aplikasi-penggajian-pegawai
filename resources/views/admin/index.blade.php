@extends('layouts.admin.admin')
@section('title') Dashboard Absen @endsection
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
            <div class="col-lg-12 col-6">
                <!-- small box -->
                @if(Auth::user()->role =='pegawai' && $absensi != null)
                @if(carbon\carbon::now()->format('D') == 'Sat' || carbon\carbon::now()->format('D') == 'Sun')
                <h1>Hari weekend</h1>
                @else
                @if($kinerja == 1)
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
                <form action="{{route('absensiKinerjaIndex')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <h4>{{$keterangankinerja}}</h4>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="textarea" name="keterangankinerja" id="keterangankinerja" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; padding-bottom: 100px; display: none;"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                <button style="margin-right: 10px;" type="reset" class="btn btn-danger float-right">Reset</button>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <p>Note : {{$keterangankinerja}}</p>
                        </div> -->
                    </div>
                </form>
                @elseif($kinerja == 2)
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
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon"><i class="fa fa-chart-line"></i></span>
                                <div class="info-box-content" style="margin-top: 20px; margin-bottom:20px;">
                                    <a href="{{route('absensiUserSakit')}}">
                                        <span class="info-box-text text-white">{{$keterangankinerja}}</span>
                                        <span class="info-box-number text-white">*****</span>
                                        @if($absensi->keterangankinerja != null)
                                        <h3>✔<sup style="font-size: 20px"></sup></h3>
                                        @else
                                        <h3 class="text-body">-</h3>
                                        @endif
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
                @else
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
                @endif
                @endif

                @elseif(Auth::user()->role == 'admin')
                @else
                <h2 class="text-danger">Periode belum dibuat</h2>

                @endif
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection