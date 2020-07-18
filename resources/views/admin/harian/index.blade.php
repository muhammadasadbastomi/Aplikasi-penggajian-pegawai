@extends('layouts.admin.admin')
@section('title') Data Kinerja Pegawai Kontrak @endsection
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
                    <li class="breadcrumb-item active">Data Kinerja Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Kinerja Pegawai Bulan
                {{carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}</h5>
            <div class="text-right">
                @if(Auth::user()->role =='admin')
                <button class="btn btn-outline-primary dropdown-toggle btn-sm btn-outline-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-print"> </i> Cetak Kinerja
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('kinerjawaktuCetak',['id' => $periode->uuid])}}" target="#_blank">Berdasarkan Ketepatan Waktu</a>
                    <button class="dropdown-item" data-toggle="modal" data-target="#modalfilterwaktu">Berdasarkan Ketepatan Waktu Pegawai</button>
                    <a class="dropdown-item" href="{{route('kinerjapenyelesaianCetak',['id' => $periode->uuid])}}" target="#_blank">Berdasarkan Penyelesaian Pekerjaan</a>
                    <button class="dropdown-item" data-toggle="modal" data-target="#modalfilterpenyelesaian">Berdasarkan Penyelesaian Pekerjaan Pegawai</button>
                    <a class="dropdown-item" href="{{route('kinerjainisiatifCetak',['id' => $periode->uuid])}}" target="#_blank">Berdasarkan Inisiatif</a>
                    <button class="dropdown-item" data-toggle="modal" data-target="#modalfilterinisiatif">Berdasarkan Inisiatif Pegawai</button>
                </div>
                @include('admin.harian.filterwaktu')
                @include('admin.harian.filterpenyelesaian')
                @include('admin.harian.filterinisiatif')
                @endif
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="example1" class="table table-bordered nowrap table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Tanggal</th>
                                    <th class="text-center align-middle">Nama Lengkap</th>
                                    <th class="text-center">Ketepatan<br>Waktu</th>
                                    <th class="text-center">Penyelesaian<br>Pekerjaan</th>
                                    <th class="text-center align-middle">Inisiatif</th>
                                    <th class="text-center align-middle">Kegiatan</th>
                                    @if(Auth::user()->role =='admin')
                                    <th class="text-center align-middle">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($harian as $d)
                                @if(carbon\carbon::parse($d->tanggal)->translatedformat('d') < carbon\carbon::now()->
                                    translatedformat('d'))
                                    <tr>
                                        @else
                                    <tr style="background-color : rgb(240, 255, 107) !important;">
                                        @endif
                                        <td class="text-center align-middle">{{$loop->iteration}}</td>
                                        <td class="text-center align-middle">{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}</td>
                                        @if(Auth::user()->role =='admin')
                                        <td class="text-center align-middle"><a style="color: black;" href="{{route('DetailKinerja', ['id' => $d->pegawai_id , 'uuid' => $d->uuid , 'periode' => $d->periode_id])}}">{{$d->pegawai->nama}}</a></td>
                                        @else
                                        <td class="text-center align-middle">{{$d->pegawai->nama}}</td>
                                        @endif
                                        <td class="text-center align-middle">@if (!empty($d->waktu))
                                            <div class="progress-group">
                                                <span class="text-right"> <button class="btn btn-noHover btn-sm border-transparent">{{$d->waktu}} / 100</button></span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar @if ($d->waktu < 50 ) bg-danger @elseif ($d->waktu > 49 && $d->waktu < 85) bg-info @else bg-primary @endif " style="width: {{$d->waktu}}%"></div>
                                                </div>
                                            </div> @else - @endif
                                        </td>
                                        <td class="text-center align-middle">@if (!empty($d->inisiatif))
                                            <div class="progress-group">
                                                <span class="text-right"> <button class="btn btn-noHover btn-sm border-transparent">{{$d->inisiatif}} / 100</button></span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar @if ($d->waktu < 50 ) bg-danger @elseif ($d->waktu > 49 && $d->waktu < 85) bg-info @else bg-primary @endif " style="width: {{$d->waktu}}%"></div>
                                                </div>
                                            </div> @else - @endif
                                        </td>
                                        <td class="text-center align-middle">@if (!empty($d->penyelesaian))
                                            <div class="progress-group">
                                                <span class="text-right"> <button class="btn btn-noHover btn-sm border-transparent">{{$d->penyelesaian}} / 100</button></span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar @if ($d->waktu < 50 ) bg-danger @elseif ($d->waktu > 49 && $d->waktu < 85) bg-info @else bg-primary @endif " style="width: {{$d->waktu}}%"></div>
                                                </div>
                                            </div> @else - @endif
                                        </td>
                                        <td class="text-center align-middle">@if (!empty($d->keterangankinerja)) {!!$d->keterangankinerja!!} @else - @endif</td>
                                        @if(Auth::user()->role =='admin')
                                        <td class="text-center align-middle">
                                            @if($d->tanggal == carbon\carbon::now()->format('Y-m-d'))
                                            <button type="button" data-id="{{$d->uuid}}" data-keterangan="{{$d->keterangankinerja}}" data-waktu="{{$d->waktu}}" data-penyelesaian="{{$d->penyelesaian}}" data-inisiatif="{{$d->inisiatif}}" data-tgl="{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}" data-nama="{{$d->pegawai->nama}}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-chart-line"></i> Masukkan Kinerja</button>
                                            @else
                                            <button type="button" data-id="{{$d->uuid}}" data-keterangan="{{$d->keterangankinerja}}" data-waktu="{{$d->waktu}}" data-penyelesaian="{{$d->penyelesaian}}" data-inisiatif="{{$d->inisiatif}}" data-tgl="{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}" data-nama="{{$d->pegawai->nama}}" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-edit"></i> Edit Kinerja</button>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    @include('admin.harian.tambah')
    @endsection
    @section('script')


    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nama = button.data('nama')
            var tgl = button.data('tgl')
            var waktu = button.data('waktu')
            var inisiatif = button.data('inisiatif')
            var penyelesaian = button.data('penyelesaian')
            var keterangan = button.data('keterangan')
            var modal = $(this)

            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #nama').val(nama)
            modal.find('.modal-body #tgl').val(tgl)
            modal.find('.modal-body #waktuuu').val(waktu)
            modal.find('.modal-body #inisiatifff').val(inisiatif)
            modal.find('.modal-body #penyelesaiannn').val(penyelesaian)
            modal.find('.modal-body #keterangan').val(keterangan)
        })
    </script>

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

    <script>
        function nilaiwaktuu(vol) {
            document.querySelector('#waktuuu').value = vol;
        }

        function nilaipenyelesaiann(vol) {
            document.querySelector('#penyelesaiannn').value = vol;
        }

        function nilaiinisiatiff(vol) {
            document.querySelector('#inisiatifff').value = vol;
        }
    </script>
    @endsection
