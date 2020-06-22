<div class="modal fade" id="modalfilterpenyelesaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Berdasarkan Penyelesaian Pekerjaan Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{route('kinerjapenyelesaianpegawaiCetak', ['id' => $periode->uuid])}}" target="_blank">
                    {{ method_field('put') }}
                    @csrf
                    <div class="modal-body">
                        <label class="float-left" style="float: left;" for="pegawai">Pilih Nama Pegawai</label>
                        <div class="form-group">
                            <select class="form-control" name="pegawai" id="pegawai">
                                @foreach($pegawai as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"> </i> Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>