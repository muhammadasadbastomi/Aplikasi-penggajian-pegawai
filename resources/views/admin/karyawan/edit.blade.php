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
                    <li class="breadcrumb-item active"><a href="{{route('karyawanIndex')}}">Data karyawan</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data karyawan - {{$karyawan->nama}}</h5>
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
                                    <input type="text" id="nik" name="nik" class="form-control @error ('nik') is-invalid @enderror" placeholder="Masukkan NIK" value="{{$karyawan->nik}}">
                                    @error('nik')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukkan Nama Lengkap" value="{{$karyawan->user->name}}">
                                    @error('nama')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{$karyawan->user->email}}">
                                    <p>Note : Isi Email jika ingin mengubah email</p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" autocomplete="new-password">
                                    @error('password')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    <p>Note : Isi Password jika ingin mengubah password</p>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Konfirmasi Password</label>
                                    <input id="password-confirm" class="form-control  @error('password-confirm') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Konfirmasi Password" autocomplete="new-password">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="pekerja">Status Pekerja</label>
                                    <input id="pekerja" class="form-control" type="text " placeholder="#" disabled>
                                </div> -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="status" id="status">
                                        @foreach($karyawan1 as $d)
                                        <option value="{{$d->status}}" selected>Status Sekarang {{$d->status}}</option>
                                        <option value="aktif">Pilih aktif</option>
                                        <option value="non-aktif">Pilih non-aktif</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="custom-select" name="jabatan_id" id="jabatan_id">
                                       
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea type="text" id="alamat" name="alamat" class="form-control @error ('alamat') is-invalid @enderror">{{$karyawan->alamat}} </textarea>
                                    @error('alamat')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <textarea type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error ('tempat_lahir') is-invalid @enderror">{{$karyawan->tempat_lahir}} </textarea>
                                    @error('tempat_lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="{{$karyawan->tgl_lahir}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control" value="{{$karyawan->tgl_masuk}}" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
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