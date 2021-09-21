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
            <h1>Lokasi Aset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">Master</a></li>
              <li class="breadcrumb-item active">Lokasi Aset</li>
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

          <div class="card-tools">
            <button type="button" class="btn btn-primary" onclick="tambah()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped" id="lokasi">
            <thead>
              <tr>
                <th>No.</th>
                <th>Lokasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php
                foreach ($rows as $key => $val) {
                  $no = $key + 1;
                  $tr = "
                    <tr id='rows-{$val['id']}'>
                      <td>{$no}</td>
                      <td>{$val['lokasi']}</td>
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
      </div>
      <!-- /.card -->

      <?=view('lokasi/modal')?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?=$this->endSection()?>

<?=$this->section("js")?>
  <!-- DataTables -->
  <script src="/js/jquery.dataTables.min.js"></script>
  <script src="/js/dataTables.bootstrap4.min.js"></script>
  <script src="/js/dataTables.responsive.min.js"></script>
  <script src="/js/responsive.bootstrap4.min.js"></script>
  <!-- validation -->
  <script src="/js/jquery.validate.min.js"></script>
  <?=view('lokasi/script')?>
<?=$this->endSection()?>