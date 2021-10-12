<?=$this->extend('dashboard')?>

<?=$this->section('css')?>
  <!-- DataTables -->
  <link rel="stylesheet" href="/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/css/responsive.bootstrap4.min.css">
<?=$this->endSection()?>

<?=$this->section('wrapper')?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Aset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-primary" onclick="tambah()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Jumlah</th>
                <th>Waktu Update</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id='tbody'>
              <?php
                foreach($rows as $key => $val){
                  $no = $key+1;
                  $time = date("d-m-Y H:i:s",strtotime($val['waktu']));
                  $tr = "
                    <tr id='rows-{$val['id']}'>
                      <td>{$no}</td>
                      <td>{$val['kode']}</td>
                      <td>{$val['barang']}</td>
                      <td>{$val['kategori']}</td>
                      <td>{$val['merk']}</td>
                      <td>{$val['jumlah']}</td>
                      <td>{$time}</td>
                      <td>
                        <button class='btn btn-primary' onclick='edit({$val['id']})'>
                          <i class='fa fa-pencil-alt'></i>
                        </button>
                        <button class='btn btn-danger' onclick='hapus({$val['id']})'>
                          <i class='fa fa-trash'></i>
                        </button>
                      </td>
                    </tr>
                  ";
                  echo $tr;
                }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="/print-laporan-stok" class="btn btn-primary">
            <i class="fa fa-print"></i> Print Laporan Barang
          </a>
        </div>
      </div>
      <!-- /.card -->

      <?=view("stok/modal")?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?=$this->endSection()?>

<?=$this->section('js')?>
  <!-- DataTables -->
  <script src="/js/jquery.dataTables.min.js"></script>
  <script src="/js/dataTables.bootstrap4.min.js"></script>
  <script src="/js/dataTables.responsive.min.js"></script>
  <script src="/js/responsive.bootstrap4.min.js"></script>
  <!-- jquery validation -->
  <script src="/js/jquery.validate.min.js"></script>
  <?=view('stok/script')?>
<?=$this->endSection()?>