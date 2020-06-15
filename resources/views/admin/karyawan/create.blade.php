@extends('layouts.admin.admin')

@section('title') Tambah Data Pegawai @endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('karyawanIndex')}}">Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Pegawai</h5>
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
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control @error ('nik') is-invalid @enderror" placeholder="Masukkan NIK" value="{{old('nik')}}">
                                    @error('nik')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap" value="{{old('nama')}}">
                                    @error('nama')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" placeholder="Masukkan E-mail" value="{{old('email')}}">
                                    @error('email')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror" placeholder="Masukkan Password" value="{{old('password')}}" autocomplete="new-password">
                                    @error('password')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Konfirmasi Password</label>
                                    <input id="password-confirm" class="form-control  @error('password-confirm') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Konfirmasi Password" autocomplete="new-password">
                                    @error('password-confirm')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <select hidden class="custom-select" name="pekerja" id="pekerja">
                                    <option selected value="Karyawan">Karyawan</option>
                                    <option disabled value="Pegawai">Pegawai</option>
                                </select>
                                <div class="form-group">
                                    <label for="status">status</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option selected value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="custom-select" name="jabatan_id" id="jabatan_id">
                                       
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea type="text" name="alamat" id="alamat" class="form-control @error ('alamat') is-invalid @enderror"> {{old('alamat')}}</textarea>
                                    @error('alamat')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <textarea type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error ('tempat_lahir') is-invalid @enderror"> {{old('tempat_lahir')}}</textarea>
                                    @error('tempat_lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{old('tgl_lahir')}}" required>
                                    @error('tgl_Lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" value="{{old('tgl_masuk')}}" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('karyawanIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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