@extends('layouts.admin.admin')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    #imgView {
        width: 300px;
    }

    .loadAnimate {
        animation: setAnimate ease 2.5s infinite;
    }

    @keyframes setAnimate {
        0% {
            color: #000;
        }

        50% {
            color: transparent;
        }

        99% {
            color: transparent;
        }

        100% {
            color: #000;
        }
    }

    .custom-file-label {
        cursor: pointer;
    }
</style>
@endsection
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
            <div class="col-sm-3">
                <!-- Profile Image -->
                <div class="card bg-light">
                    <div class="card-body pt-0" style="margin-top: 16px;">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 class="lead"><b>{{$pegawai->nama}}</b></h3>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;{{$pegawai->pekerja}}</li>
                                    <li class="small" style="margin-top: 6px;"><span class="fa-li"><i class="fas fa-lg fa-toggle-on"></i></span>&nbsp;Status : {{$pegawai->status}}</li>
                                    <li class="small" style="margin-top: 6px;"><span class=" fa-li"><i class="fas fa-id-card"></i></span>&nbsp;NIK : {{$pegawai->nik}}</li>
                                    @if(auth()->user()->pegawai->pekerja=='Pegawai')
                                    <li class="small"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;Golongan : {{$pegawai->golongan}}</li>
                                    @else
                                    <li class="small"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;Golongan : - </li>
                                    @endif
                                    <li class="small" style="margin-top: 6px;"><span class=" fa-li"><i class="fas fa-user-tie"></i></span>&nbsp;Jabatan : {{$pegawai->jabatan->jabatan}}</li>
                                </ul>
                            </div>
                            <div class="col-md-4 text-center">
                                <img src="{{$user->photos()}}" alt="" class="img-circle img-fluid">
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
                        <h3 class="card-title">About {{$pegawai->nama}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <p><strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Masuk</strong> : {{$pegawai->tgl_masuk}}</p>

                        <hr>

                        <p><strong><i class="fas fa-at mr-1"></i> Email</strong> : {{$pegawai->user->email}}</p>

                        <hr>

                        <p><strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lahir</strong> : {{$pegawai->tgl_lahir}}</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong> : <p style="margin: 12px; "> {{$pegawai->tempat_lahir}}</p>

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
                        <form role="form" method="post" enctype="multipart/form-data">
                            @method ('put')
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukkan nama" value="{{$user->name}}">
                                @error('nama')<div class="invalid-feedback"> {{$message}}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control @error ('email') is-invalid @enderror" placeholder="{{$user->email}}">
                                @error('email')<div class="invalid-feedback"> {{$message}}</div>@enderror
                                <p>Note : Isi Email jika ingin mengubah email</p>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control @error ('password') is-invalid @enderror" placeholder="Masukkan Password">
                                @error('password')<div class="invalid-feedback"> {{$message}}</div>@enderror
                                <p>Note : Isi Password jika ingin mengubah Password</p>
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control @error ('konfirmasi_password') is-invalid @enderror" placeholder="Konfirmasi Password">
                                @error('konfirmasi_password')<div class=" invalid-feedback"> {{$message}} </div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="photos">Photo</label>
                                <div class="custom-file">
                                    <input type="file" name="photos" class="imgFile custom-file-input @error ('photos') is-invalid @enderror" id="photos" aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" for="photos" name="photos">{{$user->photos}}</label>
                                    @error('photos')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <div class="imgWrap">
                                <img src="no-image.png" id="imgView" class="card-img-top img-fluid">
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
    @section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        $("#photos").change(function(event) {
            fadeInAdd();
            getURL(this);
        });

        $("#photos").on('click', function(event) {
            fadeInAdd();
        });

        function getURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#photos").val();
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                reader.onload = function(e) {
                    debugger;
                    $('#imgView').attr('src', e.target.result);
                    $('#imgView').hide();
                    $('#imgView').fadeIn(500);
                    $('.custom-file-label').text(filename);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(".alert").removeClass("loadAnimate").hide();
        }

        function fadeInAdd() {
            fadeInAlert();
        }

        function fadeInAlert(text) {
            $(".alert").text(text).addClass("loadAnimate");
        }
    </script>
    @endsection