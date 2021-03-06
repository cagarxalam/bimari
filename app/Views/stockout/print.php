<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Pengajuan Barang</title>
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/laporan.js"></script>
    </head>
    <body>
        <div id="pages">
            <div class="header">
                <div id="yayasan">
                    <img src="/img/yayasan.png" >
                </div>
                <div id="kop">
                    <p class="kop-header">yayasan pembina lembaga pendidikan dasar dan menengah persatuan guru republik indonesia jawa timur cabang kabupaten madiun</p>
                    <h1 id="nama-sekolah">smks pgri wonoasri</h1>
                    <h2>terakreditasi a</h2>
                    <p id="alamat">Jl. Thamrin 48 Telp. (0351) 383064 Caruban Kabupaten Madiun, Kode Pos 63157</p>
                </div>
                <div id="bimari">
                    <img src="/img/smk.png" alt="logo smk">
                </div>
            </div>
            <div id="lampiran">
                <div class="nomor-surat">
                    <p><span class="pre">Nomor</span>: <?="{$print['no']}/U.1/SMK PGRI-7/{$print['romawi']}/{$print['tahun']}"?></p>
                    <p><span class="pre">Sifat</span>: Penting</p>
                    <p><span class="pre">Perihal</span>: <span class="letter-space">bukti pengeluaran barang</span></p>
                </div>
                <p class="tanggal-tempat"><?="Madiun, {$print['hari']} {$print['bulan']} {$print['tahun']}"?></p>
            </div>
            <div class="table-rows">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Merk</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?=$print['kode']?></td>
                            <td><?=$print['merk']?></td>
                            <td><?=$print['barang']?></td>
                            <td><?=$print['jumlah']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="signature">
                <div id="person1">
                    <p class="tag">Yang mengeluarkan,</p>
                    <p class="name"><?=$print['admin']?></p>
                </div>
                <div id="person2">
                    <p class="tag">Pemohon,</p>
                    <p class="name"><?=$print['pemohon']?></p>
                </div>
            </div>
        </div>

        <script>
            var element = document.querySelectorAll("#pages")[0];
            var opt = {
                margin:       0,
                filename:     '<?="{$print['no']}/U.1/SMK PGRI-7/{$print['romawi']}/{$print['tahun']}"?>.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 2},
                jsPDF:        { unit: 'mm', format: 'legal', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        </script>
    </body>
</html>