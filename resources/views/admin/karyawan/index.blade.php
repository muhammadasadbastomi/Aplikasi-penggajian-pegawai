@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Karyawan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Data Karyawan</h5>
      <div class="text-right">
        <a href="{{route('karyawanPdf')}}" target="_blank" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i> Export PDF</a>
        <a href="{{route('karyawanCreate')}}" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i>Tambah Data</a>
        <a href="{{route('karyawanFilter')}}" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i>PDF Filter</a>
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
                  <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">NIK</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama</th>
                  <th class="sorting text-center" tabindex="2" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Jabatan</th>
                  <th class="sorting text-center" tabindex="3" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Golongan</th>
                  <th class="sorting text-center" tabindex="4" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                  <th class="sorting text-center" tabindex="5" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tempat Lahir</th>
                  <th class="sorting text-center" tabindex="6" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tanggal Lahir</th>
                  <th class="sorting text-center" tabindex="7" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tanggal Masuk</th>
                  <th></th>
              </thead>
              <tbody>
                @foreach ($karyawan as $d)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">{{$d->nik}}</td>
                  <td class="text-center">{{$d->nama}}</td>
                  <td class="text-center">{{$d->jabatan->jabatan}}</td>
                  <td class="text-center">{{$d->golongan->golongan}}</td>
                  <td class="text-center">{{$d->status}}</td>
                  <td class="text-center">{{$d->tempat_lahir}}</td>
                  <td class="text-center">{{$d->tgl_lahir}}</td>
                  <td class="text-center">{{$d->tgl_masuk}}</td>
                  <td class="text-center">
                    <a class="btn btn-xs btn-info text-white" href="{{route('karyawanEdit', ['id' => $d->uuid])}}"><i class="fas fa-edit"></i> Edit</a>
                    <a class="delete btn btn-xs btn-danger text-white" data-id="{{$d->uuid}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
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
            url: "{{ url('/admin/karyawan/delete')}}" + '/' + id,
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
  @endsection