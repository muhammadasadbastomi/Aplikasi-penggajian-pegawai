<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="karyawan">Nama Karyawan</label>
                            <select class="custom-select" name="karyawan" id="karyawan">
                                @foreach($karyawan as $d)
                                <option value="{{$d->id}}">{{ $d->nama}} {{$d->nik}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pekerja">Status Pekerja</label>
                            <input selected disabled value type="text" id="pekerja" class="form-control" placeholder="Karyawan">
                        </div>
                        <div class="form-group">
                            <label>Ketepatan Waktu</label> <span class="badge badge-primary float-right"><output for="waktuuu" id="waktuuu">50</output></span>
                            <input type="range" min="0" max="100" id="waktuuu" name="waktu" class="form-control-range" oninput="nilaiwaktuu(value)">
                        </div>
                        <div class="form-group">
                            <label>Penyelesaian Pekerjaan</label> <span class="badge badge-primary float-right"><output for="penyelesaiannn" id="penyelesaiannn">50</output></span>
                            <input type="range" min="0" max="100" id="penyelesaiannn" name="penyelesaian" class="form-control-range" oninput="nilaipenyelesaiann(value)">
                        </div>
                        <div class="form-group">
                            <label>Inisiatif</label> <span class="badge badge-primary float-right"><output for="inisiatifff" id="inisiatifff">50</output></span>
                            <input type="range" min="0" max="100" id="inisiatifff" name="inisiatif" class="form-control-range" oninput="nilaiinisiatiff(value)">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea type="text" name="keterangan" id="keterangan" class="form-control">{{old('keterangan')}}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>