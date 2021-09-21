<div class="modal fade" id="tambah_barang" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
              <option value="">Pilih Kategori</option>
              <?php
                foreach ($select as $key) {
                  $opt = "
                    <option value='{$key['id']}'>{$key['jenis']}</option>
                  ";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="barang" placeholder="Nama Barang" class="form-control">
          </div>
          <div class="form-group">
            <label>Merk</label>
            <input type="text" name="merk" placeholder="Merk" class="form-control">
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

<div class="modal fade" id="edit_barang" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
              <option value="">Pilih Kategori</option>
              <?php
                foreach ($select as $key) {
                  $opt = "
                    <option value='{$key['id']}'>{$key['jenis']}</option>
                  ";
                  echo $opt;
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="barang" placeholder="Nama Barang" class="form-control">
          </div>
          <div class="form-group">
            <label>Merk</label>
            <input type="text" name="merk" placeholder="Merk" class="form-control">
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