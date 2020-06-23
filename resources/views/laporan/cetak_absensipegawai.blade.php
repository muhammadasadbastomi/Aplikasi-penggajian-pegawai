<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absensi Pegawai</title>

    <style>
        .logo {
            float: left;
            margin-right: 0px;
            width: 15%;
            padding: 0px;
            text-align: right;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            font-size: 14px;
            border: 1px solid;
            padding-left: 5px;
            text-align: center;
        }

        .judul {
            text-align: center;
        }

        .headtext {
            float: right;
            margin-left: 0px;
            width: 75%;
            padding-left: 0px;
            padding-right: 10%;
        }

        .ttd {
            margin-left: 70%;
            text-align: center;

        }

        .sizeimg {
            width: 60px;
        }

        .headtext {
            float: right;
            margin-left: 0px;
            width: 75%;
            padding-left: 0px;
            padding-right: 10%;
        }

        .header {
            margin-bottom: 0px;
            text-align: center;
            height: 150px;
            padding: 0px;
        }

        .ttd {
            margin-left: 70%;
            text-align: center;
        }

        hr {
            margin-top: 14%;
            height: 3px;
            background-color: black;
        }

        br {
            margin-bottom: 5px !important;
        }

        h5 {
            line-height: 0.3;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="sizeimg" src="img/bjb.png">
        </div>
        <div class="headtext">
            <h3 style="margin:0px;">PEMERINTAH KOTA BANJARBARU</h3>
            <h1 style="margin:0px;">DINAS PERHUBUNGAN</h1>
            <p style="margin:0px;">Alamat : Jl. Jenderal Sudirman No.3 Telp. ( 0511 ) 6749034 Banjarbaru</p>
        </div>
        <hr>
    </div>
    <div class="container">
        <h2 style="text-align:center; margin-top:-25px;">Laporan Data Absensi Pegawai Kontrak {{$pegawai->nama}} Periode
            {{\carbon\carbon::parse($start)->translatedFormat('d F Y')}} -
            {{\carbon\carbon::parse($end)->translatedFormat('d F Y')}}</h2>
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" role="grid"
            aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <th>No</th>
                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Tanggal</th>
                    <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Browser: activate to sort column ascending">Nama</th>
                    <th class="sorting text-center" tabindex="2" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Izin</th>
                    <th class="sorting text-center" tabindex="3" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Sakit</th>
                    <th class="sorting text-center" tabindex="4" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Alfa</th>
                    <th class="sorting text-center" tabindex="5" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Hadir</th>
                    <th class="sorting text-center" tabindex="6" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Keterangan</th>
                    <th class="sorting text-center" tabindex="7" aria-controls="example1" rowspan="1" colspan="1"
                        aria-label="Platform(s): activate to sort column ascending">Status</th>
                    {{-- <th></th> --}}
            </thead>
            <tbody>
                @foreach ($data as $d)
                @if(carbon\carbon::parse($d->tanggal)->translatedformat('d') < carbon\carbon::now()->
                    translatedformat('d'))
                    <tr>
                        @else
                    <tr>
                        @endif
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center">{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}</td>
                        <td class="text-center">{{$d->pegawai->nama}}</td>
                        <td class="text-center">
                            @if($d->izin == 1)
                        <td style="font-family: DejaVu Sans, sans-serif;">✔</td>
                        @else
                        -
                        @endif</td>
                        <td class="text-center">
                            @if($d->sakit == 1)
                        <td style="font-family: DejaVu Sans, sans-serif;">✔</td>
                        @else
                        -
                        @endif
                        </td>
                        <td class="text-center">
                            @if($d->alfa == 1)
                        <td style="font-family: DejaVu Sans, sans-serif;">✔</td>
                        @else
                        -
                        @endif</td>
                        <td class="text-center">
                            @if($d->hadir == 1)
                        <td style="font-family: DejaVu Sans, sans-serif;">✔</td>
                        @else
                        -
                        @endif
                        </td>
                        <td class="text-center">
                            @if(isset($d->keterangan))
                            {{$d->keterangan}}
                            @else
                            -
                            @endif
                        </td>
                        <td class="text-center">
                            @if(Auth::user()->role == 'admin')
                            @if($d->hadir == 1 && $d->status == 3
                            || $d->izin == 1 && $d->status == 3
                            || $d->sakit == 1 && $d->status == 3)
                            <a class="btn btn-xs btn-primary text-white"
                                href="{{route('absensiVerifikasi', ['id' => $d->uuid])}}"><i></i> Verifikasi</a>
                            @elseif($d->status == 1)
                            <a class="btn btn-xs btn-success text-white"><i class="fas fa-check"></i>
                                Terverifikasi</a>
                            @elseif(carbon\carbon::parse($d->tanggal)->format('d') < carbon\carbon::now()->format('d'))
                                @else
                                @endif
                                @elseif($d->status == 1)
                                <a class="btn btn-xs btn-success text-white"><i class="fas fa-check"></i>
                                    Terverifikasi</a>
                                @elseif($d->hadir == 1 && $d->status == 3
                                || $d->izin == 1 && $d->status == 3
                                || $d->sakit == 1 && $d->status == 3)
                                <a class="btn btn-xs btn-success text-white"><i class="fas fa-clock"></i>
                                    Menunggu Verifikasi Admin</a>
                                @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <div class="ttd">
            <h5>
                Banjarbaru, {{$now}}
            </h5>
            <h5>Kepala Dinas</h5>
            <br>
            <br>
            <h5 style="text-decoration:underline;">AHMAD YANI, S.Sos, MM</h5>
            <h5>Pembina Utama Muda</h5>
            <h5>NIP.19641102 198903 1 006</h5>
        </div>
    </div>
</body>

</html>