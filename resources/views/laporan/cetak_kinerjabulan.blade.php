<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kinerja Pegawai Kontrak</title>

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
        <h2 style="text-align:center; margin-top:-25px;">Laporan Data Kinerja Pegawai Kontrak Bulan {{$noww}}</h2>
        <table id="example1" class="table table-bordered nowrap table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
            <thead>
                <tr role="row">
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Nama Lengkap</th>
                    <th class="text-center align-middle">Status Sekarang</th>
                    <th class="text-center align-middle">Disiplin</th>
                    <th class="text-center">Ketepatan<br>Waktu</th>
                    <th class="text-center">Penyelesaian<br>Pekerjaan</th>
                    <th class="text-center align-middle">Inisiatif</th>
                    <th class="text-center align-middle">Total Nilai</th>
                    <th class="text-center align-middle">Hasil Kinerja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td class="text-center align-middle">{{$loop->iteration}}</td>
                    <td class="text-center align-middle">{{$d->pegawai->nama}}</td>
                    <td class="text-center align-middle">{{$d->pegawai->status}}</td>
                    <td class="text-center"><b>{{$d->disiplin}}</b> / 100 </td>
                    <td class="text-center"><b>{{$d->waktu}}</b> / 100 </td>
                    <td class="text-center"><b>{{$d->penyelesaian}}</b> / 100 </td>
                    <td class="text-center"><b>{{$d->inisiatif}}</b> / 100 </td>
                    <td class="text-center"><b>{{ceil($d->total)}}</b> / 100 </td>
                    <td class="text-center align-middle">
                        @if ($d->total == 0 )
                        -
                        @elseif ($d->total < 51) Buruk @elseif ($d->total> 84 ) Terbaik @elseif ($d->total> 50 ) Baik
                            @else
                            -
                            @endif
                    </td>
                    @endforeach </tbody>
        </table> <br>
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