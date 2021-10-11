<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/css/laporan.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    </head>
    <body>
        <div id="laporan">
            <div class="header">
                <div class="column">
                    <img src="/img/smk.png" alt="logo" height="100">
                </div>
                <div class="column">
                    <h2><?="Laporan Barang Keluar {$bulan} {$tahun}"?></h2>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Barang</th>
                        <th>Merk</th>
                        <th>Pemohon</th>
                        <th>Admin</th>
                        <th>Lokasi</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($value as $key => $row) {
                            $no = $key + 1;
                            $option = "
                                <tr>
                                    <td>{$no}</td>
                                    <td>{$row['kode']}</td>
                                    <td>{$row['barang']}</td>
                                    <td>{$row['merk']}</td>
                                    <td>{$row['pemohon']}</td>
                                    <td>{$row['admin']}</td>
                                    <td>{$row['lokasi']}</td>
                                    <td>{$row['jumlah']}</td>
                                </tr>        
                            ";
                            echo $option;
                        }
                    ?>
                </tbody>
              </table>
        </div>

        <script>
            var element = document.querySelectorAll("#laporan")[0];
            var opt = {
                margin:       0,
                filename:     '<?="laporan barang keluar {$bulan} {$tahun}.pdf"?>',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 2, x: 0, y: 0, windowWidth: 33, windowHeight: 21.5, useCORS: true},
                jsPDF:        { unit: 'cm', format: [33,21.5], orientation: 'landscape' }
            };
            html2pdf().set(opt).from(element).save();
        </script>
    </body>
</html>