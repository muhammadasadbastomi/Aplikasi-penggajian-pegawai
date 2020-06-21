@extends('layouts.admin.admin')
@section('title') Data Periode Pegawai @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item active">Data Periode Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Periode Pegawai</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="text-center">No</th>
                                    <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Periode</th>
                                    <th></th>
                            </thead>
                            <tbody>
                                @foreach ($periode as $d)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{\carbon\carbon::parse($d->periode)->translatedFormat('F Y')}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-primary text-white" href="{{route('hasilkinerjaIndex', ['id' => $d->uuid])}}"><i class="fas fa-chart-line"></i> Lihat Hasil Kinerja Pegawai Bulan {{\carbon\carbon::parse($d->periode)->translatedFormat('F Y')}}</a>
                                        <a class="btn btn-xs btn-info text-white" href="{{route('hasilgajiIndex', ['id' => $d->uuid])}}"><i class="fas fa-money-bill-wave"></i> Lihat Gaji Honor Pegawai Pada Bulan {{\carbon\carbon::parse($d->periode)->translatedFormat('F Y')}}</a>
                                        <button class="btn btn-outline-primary btn-xs dropdown-toggle btn-sm btn-outline-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-print"> </i> Cetak
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('kinerjabulanCetak', ['periode_id' => $d->uuid,'periode' => $d->periode])}}" target="#blank">Cetak Kinerja Bulan {{\carbon\carbon::parse($d->periode)->translatedFormat('F Y')}}</a>
                                            <a class="dropdown-item" href="{{route('gajibulanCetak', ['periode_id' => $d->uuid,'periode' => $d->periode])}}" target="#blank">Cetak Gaji Bulan {{\carbon\carbon::parse($d->periode)->translatedFormat('F Y')}}</a>
                                        </div>
                                    </td>
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
                        url: "{{ url('/admin/periode/delete')}}" + '/' + id,
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