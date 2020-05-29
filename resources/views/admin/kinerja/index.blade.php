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
          <li class="breadcrumb-item"><a href="{{route('kinerjaperiodeIndex')}}">Data Periode Kinerja Karyawan</a></li>
          <li class="breadcrumb-item active">Data Kinerja Karyawan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Data Kinerja Karyawan</h5>
      <div class="text-right">
        <!-- <a href="{{route('kinerjaPdf')}}" target="_blank" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i> Export PDF</a> -->
        <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i class="mdi mdi-add"></i> Tambah Karyawan</button>
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
                  <th>No</th>
                  <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nama</th>
                  <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Status</th>
                  <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Disiplin</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Ketepatan Waktu</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Penyelesaian Pekerjaan</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Inisiatif</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Total Nilai</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Hasil Kinerja</th>
                  <th class="sorting text-center" tabindex="1" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Keterangan</th>
                  <th></th>
              </thead>
              <tbody>
                @foreach ($data as $d)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">{{$d->pegawai->nama}}</td>
                  <td class="text-center">{{$d->pegawai->status}}</td>
                  <td class="text-center">{{$d->disiplin}}</td>
                  <td class="text-center">{{$d->waktu}}</td>
                  <td class="text-center">{{$d->penyelesaian}}</td>
                  <td class="text-center">{{$d->inisiatif}}</td>
                  <td class="text-center">{{$total}}</td>
                  <td class="text-center">
                    @if ($total == 0 )
                    Belum Ada Nilai
                    @elseif ($total < 50) Buruk @elseif ($total> 74 ) Terbaik @elseif ($total> 49 ) Lumayan
                      @else
                      -
                      @endif
                  </td>
                  <td class="text-center">{{$d->keterangan}}</td>
                  <td class="text-center">
                    <a class="btn btn-xs btn-info text-white" href="{{route('kinerjaEdit', ['id' => $d->uuid])}}"><i class="fas fa-edit"></i> Edit</a>
                    <a class="delete btn btn-xs btn-danger text-white" data-id="{{$d->uuid}}" href="{{route('kinerjaDestroy', ['id' => $d->uuid])}}"><i class="fas fa-trash"></i> Hapus</a>
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


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periode</h5>
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
              <div class="form-group">
                <label for="waktu">Ketepatan Waktu</label>
                <input type="number" name="waktu" id="waktu" class="form-control" placeholder="Masukkan Nilai Ketepatan Waktu">
              </div>
              <div class="form-group">
                <label for="penyelesaian">Penyelesaian Pekerjaan</label>
                <input type="number" name="penyelesaian" id="penyelesaian" class="form-control" placeholder="Masukkan Nilai Penyelesaian Pekerjaan">
              </div>
              <div class="form-group">
                <label for="inisiatif">Inisiatif</label>
                <input type="number" name="inisiatif" id="inisiatif" class="form-control" placeholder="Masukkan Nilai Inisiatif">
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