@extends('layouts.admin.admin')
@section('title') Data Gaji Honor Karyawan @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('GajiperiodeIndex')}}">Data Periode Gaji</a></li>
                    <li class="breadcrumb-item active">Tambah Periode Gaji Karyawan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Gaji Periode Karyawan - {{\carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}</h5>
            <div class="text-right">
                @foreach ($periode1 as $d)
                <!-- <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i class="mdi mdi-add"></i> Tambah Karyawan</button> -->
                @endforeach
            </div>
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
                                    <th class="sorting_asc text-center">Nama</th>
                                    <th class="sorting_asc text-center">Status</th>
                                    <th class="sorting_asc text-center">Gaji Honor</th>
                                    <th class="sorting_asc text-center">Kinerja</th>
                                    <th class="sorting_asc text-center">Total Honor</th>
                                    <th class="sorting_asc text-center">Keterangan</th>
                                    <!-- <th></th> -->
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$d->pegawai->nama}}</td>
                                    <td class="text-center">{{$d->pegawai->status}}</td>
                                    <td class="text-center">Rp. {{number_format($d->honor, 0, ',', '.')}},-</td>
                                    <td class="text-center">
                                        @if ($d->total == 0 ) -
                                        @elseif ($d->total < 140) Kurang Baik <span class="badge badge-danger float-right">0%</span> @elseif ($d->total> 245 ) Terbaik <span class="badge badge-success float-right">25%</span>
                                            @elseif ($d->total> 139 ) Baik <span class="badge badge-primary float-right">15%</span>
                                            @else
                                            -
                                            @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($d->total == 0 ) -
                                        @elseif ($d->total < 140) Rp. {{number_format($d->honor, 0, ',', '.') }},- @elseif ($d->total> 245 ) Rp. {{number_format($d->honor * 0.025 + $d->honor, 0, ',', '.') }},-
                                            @elseif ($d->total> 139 ) Rp. {{number_format($d->honor * 0.015 + $d->honor, 0, ',', '.') }},-
                                            @else
                                            -
                                            @endif
                                    </td>
                                    <td class="text-center">{{$d->keterangan}}</td>
                                    <!-- <td class="text-center">
                                        <a class="delete btn btn-xs btn-danger text-white" data-id="{{$d->uuid}}" href="{{route('lihatkaryawanDelete', ['id' => $d->uuid])}}"><i class="fas fa-trash"></i> Hapus </a>
                                    </td> -->
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



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gaji Periode Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="karyawan">Nama Karyawan</label>
                                <select class="custom-select" name="karyawan" id="karyawan">
                                    @foreach($karyawan as $d)
                                    <option value="{{$d->id}}">{{ $d->nama}} {{$d->nik}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="pekerja">Status Pekerja</label>
                                <input selected disabled value type="text" id="pekerja" class="form-control" placeholder="Karyawan">
                            </div> -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea type="text" name="keterangan" id="keterangan" class="form-control">{{old('keterangan')}}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
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