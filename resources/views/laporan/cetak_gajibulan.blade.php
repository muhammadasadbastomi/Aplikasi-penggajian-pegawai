<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pegawai Gaji Perbulan</title>

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
            margin-top: 10%;
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
        <h2 style="text-align:center; margin-top:-25px;">Laporan Data Gaji Pegawai Bulan {{$noww}}</h2>
        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed nowrap" role="grid" aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc text-center">No</th>
                    <th class="sorting_asc text-center">Nama Lengkap</th>
                    <th class="sorting_asc text-center">Status Sekarang</th>
                    <th class="sorting_asc text-center">Gaji Honor</th>
                    <th class="sorting_asc text-center">Hasil Kinerja</th>
                    <th class="sorting_asc text-center">Bonus</th>
                    <th class="sorting_asc text-center">Total Gaji Honor</th>
                    <!-- <th></th> -->
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">{{$d->pegawai->nama}}</td>
                    <td class="text-center">{{$d->pegawai->status}}</td>
                    <td class="text-center">Rp. {{number_format($d->pegawai->honor, 0, ',', '.')}},-
                    </td>
                    <td class="text-center align-middle">
                        @if ($d->total == 0 )
                        -
                        @elseif ($d->total < 51) <span class="badge badge-danger">Buruk</span> @elseif ($d->total> 84 ) <span class="badge badge-primary">Terbaik</span> @elseif ($d->total> 50 ) <span class="badge badge-info">Baik</span>
                            @else
                            -
                            @endif
                    </td>
                    <td class="text-center"> @if ($d->total == 0 ) -
                        @elseif ($d->total < 50) - @elseif ($d->total> 84 ) 25% @elseif ($d->total> 49 ) 15% @else - @endif</td>
                    <td class="text-center">
                        @if ($d->total == 0 ) -
                        @elseif ($d->total < 49) Rp. {{number_format($d->pegawai->honor, 0, ',', '.') }},- @elseif ($d->total> 84 ) Rp. {{number_format($d->pegawai->honor * 0.25 + $d->pegawai->honor, 0, ',', '.') }},-
                            @elseif ($d->total> 50 ) Rp. {{number_format($d->pegawai->honor * 0.15 + $d->pegawai->honor, 0, ',', '.') }},-
                            @else
                            -
                            @endif
                    </td>
                </tr>
            </tbody>
            @endforeach
            <!-- <tfoot>
                <tr>
                    <th scope="col" class="align-right" colspan="6">Total Pengeluaran Perbulan : </th>
                    <th scope="col" class="align-right">Rp. {{number_format($d->total, 0, ',', '.')}},-</th>
                </tr>
            </tfoot> -->
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