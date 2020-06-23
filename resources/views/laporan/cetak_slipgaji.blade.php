<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Slip Gaji Pegawai</title>

    <style>
        .logo {
            float: left;
            margin-left: 170px;
            width: 15%;
            padding: 0px;
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

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .ttd {
            margin-left: 70%;
            text-align: center;
        }

        hr {
            margin-top: 15%;
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
        <h3 style="text-align:center; margin-top:-37px;">Slip Gaji Pegawai Kontrak</h3>
        <br>
        <h4 style="text-align:center; margin-top:-30px;">Periode {{\carbon\carbon::parse($start)->translatedFormat('d F Y')}} - {{\carbon\carbon::parse($end)->translatedFormat('d F Y')}}</h4>
        <br>
        <table>
            @foreach($data as $d)
            <tbody>
                <tr>
                    <td> </td>
                    <td style="width: 65px;"> </td>
                    <td style="width: 1px;"> </td>
                    <td style="width: 100px;">NIK</td>
                    <td style="width: 10px;">:</td>
                    <td>{{$d->pegawai->nik}}</td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$d->pegawai->nama}}</td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>Status</td>
                    <td>:</td>
                    <td>Pegawai Kontrak</td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <br>
        <br>
        <table>
            @foreach($data as $d)
            <tbody style="font-size: 19px;">
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td style="height: 30px;"> <b>Penghasilan</b> </td>
                    <td> </td>
                    <td> </td>
                    <td> <b>Total Penghasilan</b> </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td style="height: 30px;">Gaji Pokok</td>
                    <td>Rp. {{number_format($d->pegawai->honor, 0, ',', '.')}},-</td>
                    <td> </td>
                    <td>
                        @if ($d->total == 0 ) -
                        @elseif ($d->total < 49) Rp. {{number_format($d->pegawai->honor, 0, ',', '.') }},- @elseif ($d->total> 84 ) Rp. {{number_format($d->pegawai->honor * 0.25 + $d->pegawai->honor, 0, ',', '.') }},-
                            @elseif ($d->total> 50 ) Rp. {{number_format($d->pegawai->honor * 0.15 + $d->pegawai->honor , 0, ',', '.') }},-
                            @else - @endif
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td style="height: 30px;"> Total Kinerja </td>
                    <td>
                        @if ($d->total == 0 ) -
                        @elseif ($d->total < 49) Rp. {{number_format($d->pegawai->honor * 0 , 0, ',', '.') }},- @elseif ($d->total> 84 ) Rp. {{number_format($d->pegawai->honor * 0.25, 0, ',', '.') }},-
                            @elseif ($d->total> 50 ) Rp. {{number_format($d->pegawai->honor * 0.15 , 0, ',', '.') }},-
                            @else - @endif
                    </td>
                    <td></td>
                    <td>
                        @if ($d->total == 0 ) -
                        @elseif ($d->total < 49) Terbilang : Dua Juta Rupiah. @elseif ($d->total> 84 ) Terbilang : Dua Juta Rupiah Lima Ratus Ribu Rupiah.
                            @elseif ($d->total> 50 ) Terbilang : Dua Juta Tiga Ratus Ribu Rupiah.
                            @else - @endif
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <br>
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
