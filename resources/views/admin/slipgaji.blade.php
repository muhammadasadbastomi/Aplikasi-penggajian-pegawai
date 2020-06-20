@extends('layouts.admin.admin')
@section('title') Slip Gaji Pegawai @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item active">Slip Gaji Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Cetak Slip Gaji Pegawai</h5>
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
                                    <th class="text-center">Nama Pegawai</th>
                                    <th></th>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$d->nama}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-primary text-white" href="{{route('slipgajiCetak', ['id' => $d->uuid])}}"><i class="fas fa-print"></i> Cetak Slip Gaji</a>
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    @endsection