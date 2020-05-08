@extends('layouts.admin.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card bg-light">
                    <div class="card-body pt-0" style="margin-top: 12px;">
                        <div class="row">
                            <div class="col-7">
                                <h3 class="lead"><b></b></h3>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-toggle-on"></i></span>&nbsp;Status : </li>
                                    <li class="small" style="margin-top: 6px;"><span class=" fa-li"><i class="fas fa-id-card"></i></span>&nbsp;NIK : </li>
                                    <li class="small" style="margin-top: 6px;"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;Golongan : </li>
                                    <li class="small" style="margin-top: 6px;"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;Jabatan : </li>
                                </ul>
                            </div>
                            <div class="col-5 text-center">
                                <img src="../../dist/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">

                        </div>
                    </div>
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">About {{$pegawai}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <p><strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Masuk</strong> : </p>

                        <hr>

                        <p><strong><i class="fas fa-at mr-1"></i> Email</strong> : </p>

                        <hr>

                        <p><strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lahir</strong> : </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong> : <p style="margin: 12px; "> </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card card-gray">
                        <div class="card-header">
                            <h3 class="card-title">Info</h3>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body" style="margin-left: 28px;">
                        <form role="form" method="post">
                            @method ('put')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukkan nama" value="">
                                @error('nama')<div class="invalid-feedback"> {{$message}}
                                </div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="">
                                <p>Note : Isi Email jika ingin mengubah email</p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <p>Note : Isi Password jika ingin mengubah password</p>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <textarea type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error ('tempat_lahir') is-invalid @enderror"></textarea>
                                @error('tempat_lahir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" value="}" required>
                            </div>
                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control" value="" required>
                            </div>
                            <div class="footer" style="margin-top: 30px; margin-bottom: 30px;">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="{{route('adminIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Kembali</a>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    @endsection