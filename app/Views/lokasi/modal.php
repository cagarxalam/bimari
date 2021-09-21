<div class="modal fade" id="tambah_lokasi" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Lokasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" placeholder="Lokasi" class="form-control">
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

<div class="modal fade" id="edit_lokasi" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Lokasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="javascript:void(0)" method="post">
        <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" placeholder="Lokasi" class="form-control">
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