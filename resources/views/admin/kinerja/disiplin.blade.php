<div class="modal fade" id="modaldisiplin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5> Detail Kehadiran {{carbon\carbon::parse($d->periode->periode)->translatedFormat('F Y')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-left"> Nama Pegawai : <input type="button" style="background-color:Transparent; outline:none; border:none; cursor:pointer; overflow:hidden;" name="nama" id="nama"></h5>
                <hr>Hadir : <input type="submit" style="background-color:Transparent; outline:none; border:none; cursor:pointer; overflow:hidden;" id="hadir">Hari
                <hr>Sakit : <input type="submit" style="background-color:Transparent; outline:none; border:none; cursor:pointer; overflow:hidden;" id="sakit">Hari
                <hr>Izin : <input type="submit" style="background-color:Transparent; outline:none; border:none; cursor:pointer; overflow:hidden;" id="izin">Hari
                <hr>Alfa : <input type="submit" style="background-color:Transparent; outline:none; border:none; cursor:pointer; overflow:hidden;" id="alfa">Hari
            </div>
        </div>
    </div>
</div>