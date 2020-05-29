<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form role="form" method="post">
          {{method_field('PUT')}}
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input disabled type="text" id="nama" name="nama" class="form-control">
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input disabled type="text" id="nik" name="nik" class="form-control">
          </div>
          <!-- <div class="form-group">
            <label>Disiplin <span class="badge badge-primary"><output for="disiplinn" id="disiplinn"></output></span></label>
            <input type="range" min="0" max="100" id="disiplinn" name="disiplin" class="form-control-range" oninput="nilaidisiplin(value)">
          </div> -->
          <div class="form-group">
            <label>Ketepatan Waktu</label> <span class="badge badge-primary"><output for="waktuu" id="waktuu"></output></span>
            <input type="range" min="0" max="100" id="waktuu" name="waktu" class="form-control-range" oninput="nilaiwaktu(value)">
          </div>
          <div class="form-group">
            <label>Penyelesaian Pekerjaan <span class="badge badge-primary"><output for="penyelesaiann" id="penyelesaiann"></output></span></label>
            <input type="range" min="0" max="100" id="penyelesaiann" name="penyelesaian" class="form-control-range" oninput="nilaipenyelesaian(value)">
          </div>
          <div class="form-group">
            <label>Inisiatif <span class="badge badge-primary"><output for="inisiatiff" id="inisiatiff"></output></span></label>
            <input type="range" min="0" max="100" id="inisiatiff" name="inisiatif" class="form-control-range" oninput="nilaiinisiatif(value)">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan Keterangan"></textarea>
          </div>
      </div>
      <!-- /.card-body -->
      <div class=" modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </div>
      </form>
    </div>
  </div>
</div>