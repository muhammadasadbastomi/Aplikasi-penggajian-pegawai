@extends('layouts.admin.admin')

@section('content')
<div class="content-wrapper" style="min-height: 1192.06px;">
    <!-- Content Header (Page header) -->
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
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Nicole Pearson</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist /
                                        Coffee Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> Address: Demo Street 123,
                                            Demo City 04312, NJ</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: + 800 - 12 12 23 52</li>
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
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                fermentum enim neque.</p>
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
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="jabatan">Nama</label>
                                        <input type="text" id="jabatan" name="jabatan"
                                            class="form-control @error ('jabatan') is-invalid @enderror"
                                            placeholder="Masukkan Jabatan" value="">
                                        @error('Jabatan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gaji_pokok">Email</label>
                                        <input type="text" id="gaji_pokok" name="gaji_pokok"
                                            class="form-control @error ('gaji_pokok') is-invalid @enderror"
                                            placeholder="Masukkan Email" value="">
                                        @error('Gaji Pokok')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tunjangan">Tunjangan</label>
                                        <input type="text" id="tunjangan" name="tunjangan"
                                            class="form-control @error ('tunjangan') is-invalid @enderror"
                                            placeholder="Masukkan Tunjangan" value="">
                                        @error('Tunjangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tunjangan">Password</label>
                                        <input type="text" id="tunjangan" name="tunjangan"
                                            class="form-control @error ('tunjangan') is-invalid @enderror"
                                            placeholder="Masukkan Password" value="">
                                        @error('Tunjangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tunjangan">Password Baru</label>
                                        <input type="text" id="tunjangan" name="tunjangan"
                                            class="form-control @error ('tunjangan') is-invalid @enderror"
                                            placeholder="Masukkan Password Baru" value="">
                                        @error('Tunjangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tunjangan">Konfirmasi Password Baru</label>
                                        <input type="text" id="tunjangan" name="tunjangan"
                                            class="form-control @error ('tunjangan') is-invalid @enderror"
                                            placeholder="Masukkan Konfirmasi Password Baru" value="">
                                        @error('Tunjangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{route('jabatanIndex')}}" class="btn btn-danger text-white"><i
                                    class="mdi mdi-back"></i>Batal</a>
                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
