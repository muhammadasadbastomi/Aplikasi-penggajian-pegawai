@extends('layouts.admin.admin')
@section('title') Detail Data Absensi Pegawai Kontrak @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('periodeUserIndex')}}"> Detail Data Periode Pegawai</a></li>
                    <li class="breadcrumb-item active"> Detail Data Absensi Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Detail Data Absensi Pegawai Kontrak {{$pegawai->nama}} Bulan
                {{carbon\carbon::parse($periode1->periode)->translatedFormat('F Y')}}</h5>
            <div class="text-right">
                @if(Auth::user()->role =='admin')
                <div class="text-right">
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
                                    <th class="sorting text-center">Tanggal</th>
                                    <th class="sorting text-center">Nama</th>
                                    <th class="sorting text-center">Izin</th>
                                    <th class="sorting text-center">Sakit</th>
                                    <th class="sorting text-center">Alfa</th>
                                    <th class="sorting text-center">Hadir</th>
                                    <th class="sorting text-center">Keterangan</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                @if(carbon\carbon::parse($d->tanggal)->translatedformat('d') < carbon\carbon::now()->
                                    translatedformat('d'))
                                    <tr>
                                        @else
                                    <tr style="background-color : rgb(240, 255, 107) !important;">
                                        @endif
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{carbon\carbon::parse($d->tanggal)->translatedFormat('l, d F Y')}}</td>
                                        <td class="text-center">{{$d->pegawai->nama}}</td>
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
