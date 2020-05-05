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
                    <li class="breadcrumb-item active"><a href="{{route('pegawaiIndex')}}">Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data Pegawai - {{$pegawai->nama}}</h5>
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
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control @error ('nik') is-invalid @enderror" placeholder="Masukkan NIK" value="{{$pegawai->nik}}">
                                    @error('nik')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap" value="{{$pegawai->user->name}}">
                                    @error('Nama Lengkap')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" placeholder="Masukkan Email" value="{{$pegawai->user->email}}">
                                    @error('Email')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <p>Note : Isi password jika ingin mengubah password</p>
                                    <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror" placeholder="Masukkan Password">
                                    @error('Password')<div class=" invalid-feedback"> {{$message}}
                                    </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error ('tempat_lahir') is-invalid @enderror" placeholder="Masukkan Tempat Lahir" value="{{$pegawai->tempat_lahir}}">
                                    @error('tempat_lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control @error ('tgl_lahir') is-invalid @enderror" value="{{$pegawai->tgl_lahir}}">
                                    @error('tgl_lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control @error ('tgl_masuk') is-invalid @enderror" value="{{$pegawai->tgl_masuk}}">
                                    @error('tgl_masuk')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="{{route('pegawaiIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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