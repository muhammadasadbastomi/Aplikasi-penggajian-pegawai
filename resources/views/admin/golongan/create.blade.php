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
                    <li class="breadcrumb-item active"><a href="{{route('golonganIndex')}}">Data Golongan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Golongan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Data Golongan</h5>
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
                                    <label for="golongan">Golongan</label>
                                    <input type="text" name="golongan" id="golongan" class="form-control @error ('golongan') is-invalid @enderror" placeholder="Masukkan Golongan" value="{{old('golongan')}}">
                                    @error('Golongan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control @error ('keterangan') is-invalid @enderror" placeholder="Masukkan keterangan" value="{{old('keterangan')}}">
                                    @error('keterangan')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('golonganIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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