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
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Jabatan</h5>
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
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control @error ('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan" value="{{old('jabatan')}}">
                                    @error('Jabatan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="gaji_pokok">Gaji Pokok</label>
                                    <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control @error ('gaji_pokok') is-invalid @enderror" placeholder="Masukkan Gaji Pokok" value="{{old('gaji_pokok')}}">
                                    @error('gaji_Pokok')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="tunjangan">Tunjangan</label>
                                    <input type="text" name="tunjangan" id="tunjangan" class="form-control @error ('tunjangan') is-invalid @enderror" placeholder="Masukkan Tunjangan" value="{{old('tunjangan')}}">
                                    @error('Tunjangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('jabatanIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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