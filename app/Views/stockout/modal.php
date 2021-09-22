<div class="modal fade" id="tambah_izin" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Barang</label>
            <select name="barang" class="form-control">
              <option value="">Pilih Barang</option>
              <?php
                foreach ($barang as $key) {
                  $opt = "
                    <option value='{$key['id']}'>{$key['barang']}</option>
                  ";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Admin</label>
            <input type="text" value="<?=$admin?>" name="admin" placeholder="Admin" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Pemohon</label>
            <input type="text" name="pemohon" placeholder="Pemohon" class="form-control">
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <select name="lokasi" class="form-control">
              <option value="">Pilih Lokasi</option>
              <?php
                foreach ($lok as $key) {
                  $opt = "<option value='{$key['id']}'>{$key['lokasi']}</option>";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" name="jumlah" placeholder="Jumlah" class="form-control">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- modal -->

<div class="modal fade" id="edit_izin" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <input type="hidden" name="id">
        <input type="hidden" name="prevStok">
        <div class="modal-body">
          <div class="form-group">
            <label>Barang</label>
            <select name="barang" class="form-control">
              <option value="">Pilih Barang</option>
              <?php
                foreach ($barang as $key) {
                  $opt = "
                    <option value='{$key['id']}'>{$key['barang']}</option>
                  ";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pemohon</label>
            <input type="text" name="pemohon" placeholder="Pemohon" class="form-control">
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <select name="lokasi" class="form-control">
              <option value="">Pilih Lokasi</option>
              <?php
                foreach ($lok as $key) {
                  $opt = "<option value='{$key['id']}'>{$key['lokasi']}</option>";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" name="jumlah" placeholder="Jumlah" class="form-control">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- modal -->