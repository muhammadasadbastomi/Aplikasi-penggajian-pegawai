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
          <li class="breadcrumb-item active"><a href="{{route('absensiIndex', ['id' => $absensi->periode->uuid])}}">Data
              Absensi Pegawai</a></li>
          <li class="breadcrumb-item active">Edit Data</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Edit Data Absensi Pegawai - {{$absensi->pegawai->nama}} -
        {{carbon\carbon::parse($absensi->tanggal)->translatedFormat('d F Y')}}</h5>
      <div class="text-right">

      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">


      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post">
              {{method_field('PUT')}}
              @csrf
              <div class="card-body">
                <fieldset disabled>
                  <div class="form-group">
                    <label for="disabledTextInput">Nama Lengkap</label>
                    <input type="text" id="disabledTextInput" class="form-control"
                      placeholder="{{$absensi->pegawai->nama}}">
                  </div>
                  <div class="form-group">
                    <label for="disabledTextInput">NIK</label>
                    <input type="text" id="disabledTextInput" class="form-control"
                      placeholder="{{$absensi->pegawai->nik}}">
                  </div>
                </fieldset>
                @if(Auth::user()->role == 'admin')
                <div class="form-group">
                  <label for="absensi">Jabatan</label>
                  <select class="custom-select" name="absensi" id="absensi">
                    <option>-- Pilih Absensi --</option>
                    <option value="1" {{ $absensi->hadir == 1 ? 'selected' : ''}}>
                      Hadir
                    </option>
                    <option value="2" {{ $absensi->izin == 1 ? 'selected' : ''}}>
                      Izin
                    </option>
                    <option value="3" {{ $absensi->sakit == 1 ? 'selected' : ''}}>
                      Sakit
                    </option>
                    <option value="4" {{ $absensi->alfa == 1 ? 'selected' : ''}}>
                      Tanpa Keterangan</option>
                  </select>
                </div>
                <div class="form-group" id="keterangan" style="display : none;">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" name="keterangan" id="keterangan"
                    class="form-control @error ('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan"
                    value="{{old('keterangan')}}">
                  @error('Keterangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                @else
                <div class="form-group" id="keterangan">
                  <label for=" keterangan">Keterangan
                    {{$keterangan}}
                  </label>
                  <input type="text" name="keterangan" id="keterangan"
                    class="form-control @error ('keterangan') is-invalid @enderror"
                    placeholder="Masukkan Keterangan {{$keterangan}}" value="{{old('keterangan')}}">
                  @error('Keterangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                @endif

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{route('absensiIndex',['id' => $absensi->periode->uuid ])}}"
                    class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
                </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</div>
@endsection
@section('script')
<script>
  $('#absensi').on("change",function(){
  let val= $(this). children("option:selected"). val();
  if(val == 2 || val == 3){
  $("#keterangan").css("display", "inline");
  }else{
  $("#keterangan").css("display", "none");
  }
  })
</script>
@endsection