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
                    <li class="breadcrumb-item active"><a href="{{route('gajiIndex')}}">Data Gaji Lembur Pegawai</a></li>
                    <li class="breadcrumb-item active">Tambah Gaji Lmebur Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Gaji Lembur Pegawai</h5>
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
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="disabledTextInput">NIK</label>
                                    <input disabled type="text" id="disabledTextInput" class="form-control" placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <label for="disabledTextInput">Nama Lengkap</label>
                                    <input disabled type="text" id="disabledTextInput" class="form-control" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" name="jumlah" id="jumlah" class="form-control @error ('jumlah') is-invalid @enderror" placeholder="Masukkan Jumlah" value="{{old('jumlah')}}">
                                    @error('Jumlah')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('lemburIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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