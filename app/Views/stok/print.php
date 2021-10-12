<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/css/stok.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    </head>
    <body>
        <div id="laporan">
            <div class="header">
                <div class="column">
                    <img src="/img/smk.png" alt="logo" height="100">
                </div>
                <div class="column">
                    <h2>Laporan Stok Barang</h2>
                    <p style="text-align: right;margin-top: 20px;"><?="Madiun, {$tanggal} {$bulan} {$tahun}"?></p>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($stok as $no => $key){
                            $num = $no+1;
                            $tr = "
                                <tr>
                                    <td>{$num}</td>
                                    <td>{$key['kode']}</td>
                                    <td>{$key['barang']}</td>
                                    <td>{$key['merk']}</td>
                                    <td>{$key['jumlah']}</td>
                                </tr>        
                            ";
                            echo $tr;
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
        <script>
            var element = document.getElementById("laporan")
            var opt = {
                margin:       0,
                filename:     'laporan stok barang.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 2},
                jsPDF:        { unit: 'cm', format: [33,21.5], orientation: 'landscape' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        </script>
    </body>
</html>