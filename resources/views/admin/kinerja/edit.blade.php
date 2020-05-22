@extends('layouts.admin.admin')

@section('title') Ubah Data Kinerja Karyawan @endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{route('kinerjaperiodeIndex')}}">Data Periode Kinerja Karyawan</a></li>
          <li class="breadcrumb-item active"><a href="{{route('kinerjaperiodeIndex')}}">Data Kinerja Karyawan</a></li>
          <li class="breadcrumb-item active">Edit Data Kinerja Karyawan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Edit Data Kinerja Karyawan - {{$data->id}}</h5>
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
                <div class="form-group">
                  <label for="disiplin">disiplin</label>
                  <input type="text" id="disiplin" name="disiplin" class="form-control @error ('disiplin') is-invalid @enderror" placeholder="Masukkan disiplin" value="#">
                  @error('disiplin')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="waktu">waktu</label>
                  <input type="text" id="waktu" name="waktu" class="form-control @error ('waktu') is-invalid @enderror" placeholder="Masukkan waktu" value="#">
                  @error('waktu')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="penyelesaian">penyelesaian</label>
                  <input type="text" id="penyelesaian" name="penyelesaian" class="form-control @error ('penyelesaian') is-invalid @enderror" placeholder="Masukkan penyelesaian" value="#">
                  @error('penyelesaian')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="inisiatif">inisiatif</label>
                  <input type="text" id="inisiatif" name="inisiatif" class="form-control @error ('inisiatif') is-invalid @enderror" placeholder="Masukkan inisiatif" value="#">
                  @error('inisiatif')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" id="keterangan" name="keterangan" class="form-control @error ('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan" value="#">
                  @error('Keterangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{route('kinerjaperiodeIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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