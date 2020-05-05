<!DOCTYPE html>
<html>

<head>
    <title>Export PDF Dinas Perhubungan Kota Banjarbaru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <h5 class="sorting text-center">Laporan Data Pegawai Dinas Perhubungan Kota Banjarbaru</h5>
    <h6 class="sorting text-center"><a style="margin-top: 12px; color: black;">Laporan Data Pegawai</a>
    </h6>
    <br>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="sorting text-center">No</th>
                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">NIK</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama</th>
                <th class="sorting text-center" tabindex="2" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Jabatan</th>
                <th class="sorting text-center" tabindex="3" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tempat Lahir</th>
                <th class="sorting text-center" tabindex="4" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tanggal Lahir</th>
                <th class="sorting text-center" tabindex="5" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $d)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$d->nik}}</td>
                <td class="text-center">{{$d->nama}}</td>
                <td class="text-center">{{$d->jabatan->jabatan}}</td>
                <td class="text-center">{{$d->tempat_lahir}}</td>
                <td class="text-center">{{$d->tgl_lahir}}</td>
                <td class="text-center">{{$d->tgl_masuk}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>