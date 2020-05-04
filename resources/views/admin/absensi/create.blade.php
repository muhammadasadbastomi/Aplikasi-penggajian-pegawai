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
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Absensi Pegawai</h5>
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
                                    <label for="pegawai_id">Pegawai</label>
                                    <select class="custom-select" name="pegawai_id" id="pegawai_id">
                                        @foreach($pegawai as $d)
                                        <option value="{{$d->id}}">{{ $d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="izin">Izin</label>
                                    <input type="text" name="izin" id="izin" class="form-control @error ('izin') is-invalid @enderror" placeholder="Masukkan Izin" value="{{old('izin')}}">
                                    @error('Izin')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="sakit">Sakit</label>
                                    <input type="text" name="sakit" id="sakit" class="form-control @error ('sakit') is-invalid @enderror" placeholder="Masukkan Sakit" value="{{old('sakit')}}">
                                    @error('Sakit')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="alfa">Alfa</label>
                                    <input type="alfa" name="alfa" id="alfa" class="form-control @error ('alfa') is-invalid @enderror" placeholder="Masukkan Alfa" value="{{old('alfa')}}">
                                    @error('Alfa')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="hadir">Hadir</label>
                                    <input type="text" name="hadir" id="hadir" class="form-control @error ('hadir') is-invalid @enderror" placeholder="Masukkan Hadir" value="{{old('hadir')}}">
                                    @error('Hadir')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <input type="date" name="periode" id="periode" class="form-control @error ('periode') is-invalid @enderror" placeholder="Masukkan Periode" value="{{old('periode')}}">
                                    @error('Periode')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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