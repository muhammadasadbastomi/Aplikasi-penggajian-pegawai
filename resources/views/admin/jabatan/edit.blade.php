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
          <li class="breadcrumb-item active"><a href="{{route('jabatanIndex')}}">Data Jabatan</a></li>
          <li class="breadcrumb-item active">Edit Data</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Edit Data Jabatan - {{$jabatan->jabatan}}</h5>
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
                  <label>Kode Jabatan</label>
                  <input type="text" name="kode_jabatan" value="{{$jabatan->kode_jabatan}}" class="form-control"
                    placeholder="Masukan Kode Jabatan">
                </div>
                <div class="form-group">
                  <label>Nama Jabatan</label>
                  <input type="text" name="jabatan" value="{{$jabatan->jabatan}}" class="form-control"
                    placeholder="Masukan Nama Jabatan">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="keterangan" value="{{$jabatan->keterangan}}" class="form-control"
                    placeholder="Masukan Keterangan">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="{{route('jabatanIndex')}}" class="btn btn-danger text-white"><i
                    class="mdi mdi-back"></i>Batal</a>
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