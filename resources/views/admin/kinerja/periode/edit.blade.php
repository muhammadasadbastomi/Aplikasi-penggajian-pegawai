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
                    <li class="breadcrumb-item active"><a href="{{route('GajiperiodeIndex')}}">Data Periode Karyawan</a></li>
                    <li class="breadcrumb-item active">Edit Data Periode Karyawan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Data Periode Karyawan - {{\carbon\carbon::parse($periode->periode)->translatedFormat('F Y')}}</h5>
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
                                <div class="form-group col-md-2">
                                    <label for="periode">Periode</label>
                                    <input type="date" id="periode" name="periode" class="form-control @error ('periode') is-invalid @enderror" placeholder="Masukkan Periode" value="{{$periode->periode}}">
                                    @error('periode')<div class="invalid-feedback"> {{$message}} </div>@enderror
                                </div>
                                <div class="form-group  col-md-3">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan" class="form-control"> {{$periode->keterangan}}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="{{route('GajiperiodeIndex')}}" class="btn btn-danger text-white"><i class="mdi mdi-back"></i>Batal</a>
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