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
    <h5 class="sorting text-center">Laporan Data Gaji Pegawai Dinas Perhubungan Kota Banjarbaru</h5>
    <h6 class="sorting text-center"><a style="margin-top: 12px; color: black;">Laporan Data Gaji Pegawai</a>
    </h6>
    <br>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="sorting text-center">No</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nama</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Golongan</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Jabatan</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Gaji Pokok</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Tunjangan</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Potongan</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Jumlah</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $d)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$d->nama}}</td>
                <td class="text-center">{{$d->golongan->golongan}}</td>
                <td class="text-center">{{$d->jabatan->jabatan}}</td>
                <td class="text-center">{{$d->jabatan->gaji_pokok}}</td>
                <td class="text-center">{{$d->jabatan->tunjangan}}</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>