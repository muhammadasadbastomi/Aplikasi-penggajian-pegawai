@extends('layouts.admin.admin')
@section('title') Data Absensi Pegawai Kontrak @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('periodeUserIndex')}}">Data Periode Pegawai</a></li>
                    <li class="breadcrumb-item active">Data Absensi Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Absensi Pegawai Bulan
                {{carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}</h5>
            <div class="text-right">
                @if(Auth::user()->role =='admin')
                <div class="text-right">
                    <button class="btn btn-outline-primary dropdown-toggle btn-sm btn-outline-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-print"> </i> Cetak Absensi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('absensiCetak', ['uuid' => $periode->uuid])}}" target="#_blank">Keseluruhan</a>
                        <button class="dropdown-item" data-toggle="modal" data-target="#modalfilter">Berdasarkan Pegawai</button>
                    </div>
                    @include('admin.absensi.filter')
                </div>
                @endif
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tanggal</th>
                                    <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama</th>
                                    <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Waktu Absen</th>
                                    <th class="sorting text-center" tabindex="2" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Izin</th>
                                    <th class="sorting text-center" tabindex="3" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Sakit</th>
                                    <th class="sorting text-center" tabindex="4" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Alfa</th>
                                    <th class="sorting text-center" tabindex="5" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Hadir</th>
                                    <th class="sorting text-center" tabindex="6" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Keterangan</th>
                                    <th class="sorting text-center" tabindex="7" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $d)
                                @if(carbon\carbon::parse($d->tanggal)->translatedformat('d') < carbon\carbon::now()->
                                    translatedformat('d'))
                                    <tr>
                                        @else
                                    <tr style="background-color : rgb(240, 255, 107) !important;">
                                        @endif
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}</td>
                                        <td class="text-center align-middle"><a style="color: black;" href="{{route('DetailAbsensi', ['id' => $d->pegawai_id , 'uuid' => $d->uuid , 'periode' => $d->periode_id])}}">{{$d->pegawai->nama}}</a></td>
                                        <td class="text-center align-middle">@if($d->waktu_absen == !null) {{carbon\carbon::parse($d->waktu_absen)->format('H:i')}} @else - @endif</td>
                                        <td class="text-center">
                                            @if($d->izin == 1)
                                            ✔
                                            @else
                                            -
                                            @endif</td>
                                        <td class="text-center">
                                            @if($d->sakit == 1)
                                            ✔
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($d->alfa == 1)
                                            ✔
                                            @else
                                            -
                                            @endif</td>
                                        <td class="text-center">
                                            @if($d->hadir == 1)
                                            ✔
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
                                            <a class="btn btn-xs btn-primary text-white" href="{{route('absensiVerifikasi', ['id' => $d->uuid])}}"><i></i> Verifikasi</a>
                                            @elseif($d->status == 1)
                                            <a class="btn btn-xs btn-success text-white"><i class="fas fa-check"></i>
                                                Terverifikasi</a>
                                            @elseif(carbon\carbon::parse($d->tanggal)->format('d') < carbon\carbon::now()->format('d')) <a class="btn btn-xs btn-info text-white" href="{{route('absensiEdit',['id' => $d->uuid])}}"><i class="fas fa-edit"></i>
                                                    Edit Manual</a>
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
                                        {{-- <td class="text-center">
                    <a class="btn btn-xs btn-info text-white" href="{{route('absensiEdit', ['id' => $d->uuid])}}"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="delete btn btn-xs btn-danger text-white" data-id="{{$d->uuid}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="row">
        <div class="col-sm-12 col-md-5">
          <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
        </div>
        <div class="col-sm-12 col-md-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div> --}}
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    @endsection
    @section('script')

    <script>
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal.fire({
                title: "Apakah anda yakin?",
                icon: "warning",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/admin/absensi/delete')}}" + '/' + id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                document.location.reload(true);
                            }, 1000);
                        },
                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    Swal.fire(
                        'Dibatalkan',
                        'data batal dihapus',
                        'error'
                    )
                }
            })
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    @endsection
