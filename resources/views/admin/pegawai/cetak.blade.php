<!--Basic Modal -->
<div class="modal fade text-left" id="modalcetak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel3">Cetak Berdasarkan Tanggal Masuk</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{route('pegawaitglCetak')}}" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="start">Dari Tanggal</label>
                        <input type="date" class="form-control" id="start" name="start" value="{{old('start')}}">
                    </div>
                    <div class="form-group">
                        <label for="end">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="end" name="end" value="{{old('end')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ml-1">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
