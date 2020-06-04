@extends('layouts.admin.admin')

@section('title') Data Kinerja Karyawan @endsection

@section('css')
<link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('kinerjaperiodeIndex')}}">Data Periode Kinerja Karyawan</a></li>
          <li class="breadcrumb-item active">Data Kinerja Karyawan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Data Kinerja Karyawan {{\carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}
    </h5>
    <div class="text-right">
      <!-- <a href="{{route('kinerjaPdf')}}" target="_blank" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i> Export PDF</a> -->
      <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i
          class="mdi mdi-add"></i> Tambah Karyawan</button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

      <div class="row">
        <div class="col-sm-12 table-responsive">
          <table id="example1" class="table table-bordered nowrap table-striped dataTable dtr-inline collapsed"
            role="grid" aria-describedby="example1_info">
            <thead>
              <tr role="row">
                <th>No</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nama</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Status</th>
                <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                  aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Disiplin</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Ketepatan Waktu</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Penyelesaian Pekerjaan</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Inisiatif</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Total Nilai</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Hasil Kinerja</th>
                <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1"
                  aria-label="Browser: activate to sort column ascending">Keterangan</th>
                <th></th>
            </thead>
            <tbody>
              @foreach ($data as $d)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="text-center">{{$d->pegawai->nama}}</td>
                <td class="text-center">{{$d->pegawai->status}}</td>
                <td class="text-center">{{$d->disiplin}}

                  <hr>Hadir : {{$d->disiplin_detail->hadir}} Hari
                  <hr>Sakit : {{$d->disiplin_detail->sakit}} Hari
                  <hr>Izin : {{$d->disiplin_detail->izin}} Hari
                  <hr>Alfa : {{$d->disiplin_detail->alfa}} Hari
                </td>
                <td class="text-center">{{$d->waktu}}</td>
                <td class="text-center">{{$d->penyelesaian}}</td>
                <td class="text-center">{{$d->inisiatif}}</td>
                <td class="text-center">{{$d->total}}</td>
                <td class="text-center">
                  @if ($d->total == 0 )
                  -
                  @elseif ($d->total < 140) Kurang Baik @elseif ($d->total> 245 ) Terbaik @elseif ($d->total> 139 ) Baik
                    @else
                    -
                    @endif
                </td>
                <td class="text-center">{{$d->keterangan}}</td>
                <td class="text-center">
                  <a class="btn btn-xs btn-info text-white" data-id="{{$d->id}}" data-nama="{{$d->pegawai->nama}}"
                    data-nik="{{$d->pegawai->nik}}" data-waktu="{{$d->waktu}}" data-penyelesaian="{{$d->penyelesaian}}"
                    data-inisiatif="{{$d->inisiatif}}" data-keterangan="{{$d->keterangan}}" data-toggle="modal"
                    data-target="#ModalEdit"><i class="fas fa-edit"></i> Edit</a>
                  <a class="delete btn btn-xs btn-danger text-white" data-id="{{$d->uuid}}"
                    href="{{route('kinerjaDestroy', ['id' => $d->uuid])}}"><i class="fas fa-trash"></i> Hapus</a>
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

<!-- modal tambah-->
@include('admin.kinerja.tambah')
<!-- end modal tambah -->

<!-- modal edit -->
@include('admin.kinerja.edit')
<!-- end modal edit -->

@endsection

@section('script')
<script>
  $('#ModalEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var nama = button.data('nama')
    var nik = button.data('nik')
    var penyelesaian = button.data('penyelesaian')
    var waktu = button.data('waktu')
    // var disiplin = button.data('disiplin')
    var inisiatif = button.data('inisiatif')
    var keterangan = button.data('keterangan')
    var modal = $(this)

    modal.find('.modal-body #id').val(id)
    modal.find('.modal-body #nama').val(nama)
    modal.find('.modal-body #nik').val(nik)
    modal.find('.modal-body #penyelesaiann').val(penyelesaian)
    modal.find('.modal-body #waktuu').val(waktu)
    // modal.find('.modal-body #disiplinn').val(disiplin)
    modal.find('.modal-body #inisiatiff').val(inisiatif)
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
          url: "{{ url('/admin/kinerja/delete')}}" + '/' + id,
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

<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

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

<script>
  function nilaiwaktu(vol) {
    document.querySelector('#waktuu').value = vol;
  }

  function nilaipenyelesaian(vol) {
    document.querySelector('#penyelesaiann').value = vol;
  }

  function nilaiinisiatif(vol) {
    document.querySelector('#inisiatiff').value = vol;
  }
</script>

@if (count($errors) > 0)
<script>
  $(function() {
    Command: toastr["error"]("Karyawan Sudah Ada.", "Gagal")
  });

  toastr.options = {
    "toast": true,
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
</script>
@endif

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>


@endsection