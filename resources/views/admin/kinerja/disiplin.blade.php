<div class="modal fade" id="modaldisiplin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kehadiran {{$d->pegawai->nama}}, Bulan {{carbon\carbon::parse($d->gajiperiode->periode)->translatedFormat('F Y')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Hadir : {{$d->disiplin_detail->hadir}} Hari
                <hr>Sakit : {{$d->disiplin_detail->sakit}} Hari
                <hr>Izin : {{$d->disiplin_detail->izin}} Hari
                <hr>Alfa : {{$d->disiplin_detail->alfa}} Hari
            </div>
        </div>
    </div>
</div>