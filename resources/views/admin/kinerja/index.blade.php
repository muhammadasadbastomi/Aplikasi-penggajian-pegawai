@extends('layouts.admin.admin')

@section('title') Data Hasil Kinerja Pegawai @endsection

@section('css')
<!-- <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css"> -->
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
                    <li class="breadcrumb-item"><a href="{{route('hasilperiodeIndex')}}">Data Periode Pegawai</a></li>
                    <li class="breadcrumb-item active">Data Hasil Kinerja Pegawai</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Data Hasil Kinerja Pegawai - {{\carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}
        </h5>
        <div class="text-right">
            <!-- <a href="" target="_blank" class="btn btn-sm btn-primary text-white"><i class="mdi mdi-add"></i> Export PDF</a> -->
            <!-- <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#exampleModal"><i class="mdi mdi-add"></i> Tambah Data</button> -->
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
                                <th class="text-center align-middle">Nama Lengkap</th>
                                <th class="text-center align-middle">Status Sekarang</th>
                                <th class="text-center align-middle">Disiplin</th>
                                <th class="text-center">Ketepatan<br>Waktu</th>
                                <th class="text-center">Penyelesaian<br>Pekerjaan</th>
                                <th class="text-center align-middle">Inisiatif</th>
                                <th class="text-center align-middle">Total Nilai</th>
                                <th class="text-center align-middle">Hasil Kinerja</th>
                                <th class="text-center align-middle">Cetak Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr style="background-color : rgb(209, 209, 224);">
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">{{$d->pegawai->nama}}</td>
                                <td class="text-center align-middle">{{$d->pegawai->status}}</td>
                                <td class="text-center">
                                    <div class="progress-group">
                                        <span class="text-right" style="margin-left: 9px;"><b>{{$d->disiplin}}</b> / 100 <button data-nama="{{$d->pegawai->nama}}" data-alfa="{{$d->where('alfa', 1)->where('pegawai_id', $d->pegawai_id)->sum('alfa')}}" data-sakit="{{$d->where('sakit', 1)->where('pegawai_id', $d->pegawai_id)->sum('sakit')}}" data-hadir="{{$d->where('hadir', 1)->where('pegawai_id', $d->pegawai_id)->sum('hadir')}}" data-izin="{{$d->where('izin', 1)->where('pegawai_id', $d->pegawai_id)->sum('izin')}}" data-toggle="modal" class="btn btn-noHover btn-sm border-transparent" data-target="#modaldisiplin"><span class="badge badge-primary">!</span></button></span>
                                        @include('admin.kinerja.disiplin')
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                      @if ($d->disiplin < 50 )
                      bg-danger
                      @elseif ($d->disiplin > 49 && $d->disiplin < 85)
                      bg-info
                      @else
                      bg-primary
                      @endif " style="width:{{$d->disiplin}}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-group">
                                        <span class="text-right"> <button class="btn btn-noHover btn-sm border-transparent"> <b>{{$d->waktu}}</b> / 100</button></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                      @if ($d->waktu < 50 )
                      bg-danger
                      @elseif ($d->waktu > 49 && $d->waktu < 85)
                      bg-info
                      @else
                      bg-primary
                      @endif " style="width: {{$d->waktu}}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-group">
                                        <span class="text-right"><button class="btn btn-noHover btn-sm border-transparent"> <b>{{$d->penyelesaian}}</b> / 100</button></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                      @if ($d->penyelesaian < 50 )
                      bg-danger
                      @elseif ($d->penyelesaian > 49 && $d->penyelesaian < 85 )
                      bg-info
                      @else
                      bg-primary
                      @endif " style="width: {{$d->penyelesaian}}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-group">
                                        <span class="text-right"><button class="btn btn-noHover btn-sm border-transparent"> <b>{{$d->inisiatif}}</b> / 100</button></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                      @if ($d->inisiatif < 50 )
                      bg-danger
                      @elseif ($d->inisiatif > 49  && $d->inisiatif < 85)
                      bg-info
                      @else
                      bg-primary
                      @endif " style="width: {{$d->inisiatif}}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="progress-group">
                                        <span class="text-right"><button class="btn btn-noHover btn-sm border-transparent"> <b> {{ceil($d->total)}}</b> /100</button></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar
                      @if ($d->total < 50 )
                      bg-danger
                      @elseif ($d->total > 49 && $d->total < 85)
                      bg-info
                      @else
                      bg-primary
                      @endif
                      " style="width:{{ceil($d->total)}}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    @if ($d->total == 0 )
                                    -
                                    @elseif ($d->total < 51) <span class="badge badge-danger">Buruk</span> @elseif ($d->total> 84 ) <span class="badge badge-primary">Terbaik</span> @elseif ($d->total> 50 ) <span class="badge badge-info">Baik</span>
                                        @else
                                        -
                                        @endif
                                </td>
                                <td class="text-center align-middle"><a class="btn btn-outline-primary text-primary" href="{{route('kinerjapegawaiCetak',['uuid' => $d->uuid, 'id' => $d->periode_id, 'tgl' => $d->tanggal, 'pegawai_id' => $d->pegawai_id])}}" target="#blank"> <i class="fa fa-print"> Cetak Kinerja </i> </a></td>
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
    $('#modaldisiplin').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var nama = button.data('nama')
        var izin = button.data('izin')
        var hadir = button.data('hadir')
        var alfa = button.data('alfa')
        var sakit = button.data('sakit')
        var modal = $(this)

        modal.find('.modal-body #nama').val(nama)
        modal.find('.modal-body #izin').val(izin)
        modal.find('.modal-body #hadir').val(hadir)
        modal.find('.modal-body #alfa').val(alfa)
        modal.find('.modal-body #sakit').val(sakit)
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
<!-- <script src="../../plugins/toastr/toastr.min.js"></script> -->
<!-- @if (count($errors) > 0)
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
@endif -->

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>


@endsection
