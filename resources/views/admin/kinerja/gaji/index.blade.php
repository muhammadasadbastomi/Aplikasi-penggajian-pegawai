@extends('layouts.admin.admin')
@section('title') Lihat Data Gaji Honor Pegawai @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('hasilperiodeIndex')}}">Data Periode Pegawai</a></li>
                    <li class="breadcrumb-item active">Lihat Periode Gaji Honor Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Gaji Honor Periode Pegawai - {{\carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed nowrap" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc text-center">No</th>
                                    <th class="sorting_asc text-center">Nama Lengkap</th>
                                    <th class="sorting_asc text-center">Status Sekarang</th>
                                    <th class="sorting_asc text-center">Gaji Honor</th>
                                    <th class="sorting_asc text-center">Hasil Kinerja</th>
                                    <th class="sorting_asc text-center">Total Gaji Honor</th>
                                    <th class="sorting_asc text-center">Cetak Slip Gaji</th>
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
                                    <td class="text-center">
                                        @if ($d->total == 0 ) -
                                        @elseif ($d->total < 49) Rp. {{number_format($d->pegawai->honor, 0, ',', '.') }},- @elseif ($d->total> 84 ) Rp. {{number_format($d->pegawai->honor * 0.25 + $d->pegawai->honor, 0, ',', '.') }},-
                                            @elseif ($d->total> 50 ) Rp. {{number_format($d->pegawai->honor * 0.15 + $d->pegawai->honor, 0, ',', '.') }},-
                                            @else
                                            -
                                            @endif

                                            @if ($d->total == 0 ) -
                                            @elseif ($d->total < 50) @elseif ($d->total> 84 ) &emsp14;<span class="text-success">
                                                    &emsp14;<i class="fas fa-arrow-up"></i> 25%
                                                </span>
                                                @elseif ($d->total> 49 ) <span class="text-success">
                                                    &emsp14;<i class="fas fa-arrow-up"></i> 15%
                                                </span>
                                                @else
                                                -
                                                @endif
                                    </td>
                                    <td class="text-center"><a class="btn btn-outline-primary text-primary" href="{{route('slipgajiCetak',['uuid' => $d->uuid, 'id' => $d->periode_id, 'tgl' => $d->tanggal, 'pegawai_id' => $d->pegawai_id])}}" target="#blank"> <i class="fa fa-print"> Cetak Slip Gaji </i> </a></td>
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
                        url: "{{ url('admin/gaji/periode/karyawan/delete')}}" + '/' + id,
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
                                timer: 800
                            })
                            setTimeout(function() {
                                document.location.reload(true);
                            }, 400);
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