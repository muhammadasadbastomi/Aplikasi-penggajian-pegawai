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
                    <li class="breadcrumb-item"><a href="{{route('pegawaiIndex')}}">Data Pegawai</a></li>
                    <li class="breadcrumb-item active">PDF Filter</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="container-fluid">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Filter PDF</h5>
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
                                    <label for="pegawai_id">Option</label>
                                    <select class="custom-select" name="pegawai_id" id="pegawai_id">

                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <input type="date" name="periode" id="periode" class="form-control"
                                        placeholder="Masukkan Periode" value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('absensiIndex')}}" class="btn btn-danger text-white"><i
                                        class="mdi mdi-back"></i>Batal</a>
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
