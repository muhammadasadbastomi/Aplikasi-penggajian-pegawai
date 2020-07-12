@extends('layouts.admin.admin')
@section('title') Data Pegawai Kontrak @endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item active">Data Pegawai Kontrak</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Pegawai Kontrak</h5>
            <div class="text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Cetak</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('pegawaiCetak')}}" target="_blank">Keseluruhan</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modalcetak">Berdasarkan Tanggal Masuk</a>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modaltambah"><i class="mdi mdi-add"></i>Tambah Data</button>
            </div>
        </div>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline collapsed nowrap" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th class="sorting text-center">NIK</th>
                                    <th class="sorting text-center">Nama Lengkap</th>
                                    <th class="sorting text-center">Status</th>
                                    <th class="sorting text-center">Alamat</th>
                                    <th class="sorting text-center">Tanggal Lahir</th>
                                    <th class="sorting text-center">Tempat Lahir</th>
                                    <th class="sorting text-center">Tanggal Masuk</th>
                                    <th class="sorting text-center">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$d->nik}}</td>
                                    <td class="text-center">{{$d->nama}}</td>
                                    <td class="text-center">{{$d->status}}</td>
                                    <td class="text-center">{{$d->alamat}}</td>
                                    <td class="text-center">{{Carbon\Carbon::parse($d->tgl_lahir)->Format('d F Y')}}</td>
                                    <td class="text-center">{{$d->tempat_lahir}}</td>
                                    <td class="text-center">{{Carbon\Carbon::parse($d->tgl_masuk)->Format('d F Y')}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-info text-white" data-toggle="modal" data-target="#modaledit" data-id="{{$d->id}}" data-nik="{{$d->nik}}" data-nama="{{$d->nama}}" data-status="{{$d->status}}" data-email="{{$d->user->email}}" data-alamat="{{$d->alamat}}" data-tgl_lahir="{{$d->tgl_lahir}}" data-tempat_lahir="{{$d->tempat_lahir}}" data-tgl_masuk="{{$d->tgl_masuk}}"><i class="fas fa-ed it"></i>Edit</button>
                                        <button class="delete btn btn-xs btn-danger text-white" data-uuid="{{$d->uuid}}" data-id="{{$d->user->uuid}}"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.pegawai.tambah')
@include('admin.pegawai.edit')
@include('admin.pegawai.cetak')
@endsection
@section('script')
<script>
    $('#modaledit').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget)
        let id = button.data('id')
        let nama = button.data('nama')
        let nik = button.data('nik')
        let email = button.data('email')
        let alamat = button.data('alamat')
        let tgl_lahir = button.data('tgl_lahir')
        let tempat_lahir = button.data('tempat_lahir')
        let status = button.data('status')
        let tgl_masuk = button.data('tgl_masuk')
        let modal = $(this)

        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #nama').val(nama);
        modal.find('.modal-body #nik').val(nik);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #alamat').val(alamat);
        modal.find('.modal-body #tempat_lahir').val(tempat_lahir);
        modal.find('.modal-body #tgl_lahir').val(tgl_lahir);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #tgl_masuk').val(tgl_masuk);
    })
</script>
<script>
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var uuid = $(this).data('uuid');
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
                    url: "{{ url('/admin/pegawai')}}" + '/' + uuid + '/' + id,
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
    $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
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
