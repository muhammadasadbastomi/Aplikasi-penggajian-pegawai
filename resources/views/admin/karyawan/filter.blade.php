<div class="modal fade" id="modalfilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Berdasarkan Tanggal Masuk Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{route('pegawaitglCetak')}}" target="_blank">
                    {{ method_field('put') }}
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start">Dari Tanggal</label>
                            <input type="date" name="start" id="start" class="form-control" value="{{old('start')}}">
                        </div>
                        <div class="form-group">
                            <label for="end">Sampai Tanggal</label>
                            <input type="date" name="end" id="end" class="form-control" value="{{old('end')}}">
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