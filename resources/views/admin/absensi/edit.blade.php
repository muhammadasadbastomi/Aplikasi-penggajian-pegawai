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
          <li class="breadcrumb-item active"><a href="{{route('absensiIndex')}}">Data Absensi Pegawai</a></li>
          <li class="breadcrumb-item active">Edit Data</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Edit Data Absensi Pegawai {{$absensi->absensi}}</h5>
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
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$absensi->pegawai->nama}}">
                  </div>
                  <div class="form-group">
                    <label for="disabledTextInput">NIK</label>
                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$absensi->pegawai->nik}}">
                  </div>
                </fieldset>

                <div class="form-group">
                  <label for="izin">Izin</label>
                  <input type="text" id="izin" name="izin" class="form-control @error ('izin') is-invalid @enderror" placeholder="Masukkan Izin" value="{{$absensi->izin}}">
                  @error('Izin')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="sakit">Sakit</label>
                  <input type="text" id="sakit" name="sakit" class="form-control @error ('sakit') is-invalid @enderror" placeholder="Masukkan Sakit" value="{{$absensi->sakit}}">
                  @error('Sakit')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="alfa">Alfa</label>
                  <input type="text" id="alfa" name="alfa" class="form-control @error ('alfa') is-invalid @enderror" placeholder="Masukkan Alfa" value="{{$absensi->alfa}}">
                  @error('Alfa')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="hadir">Hadir</label>
                  <input type="text" id="hadir" name="hadir" class="form-control @error ('hadir') is-invalid @enderror" placeholder="Masukkan Hadir" value="{{$absensi->hadir}}">
                  @error('Hadir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="periode">Periode</label>
                  <input type="date" id="periode" name="periode" class="form-control @error ('periode') is-invalid @enderror" value="{{$absensi->periode}}">
                  @error('Periode')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{route('absensiIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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
@endsection