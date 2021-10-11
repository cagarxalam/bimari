<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MStockOut;
use Dompdf\Dompdf;

class StockOut extends BaseController
{
    protected $model;
    public $bulan;
    public $tahun;

    public function __construct(){
        $this->model = new MStockOut();
        $this->bulan = date("m");
        $this->tahun = date("Y");
    }

    public function index(){
        if($this->session->user){
            $data['title']      = "SIM Inventaris | Laporan Pengajuan Barang";
            $data['stockout']   = "active";
            $data['admin']      = $this->session->user;

            // barang dan lokasi
            $data['barang']     = $this->model->barang();
            $data['lok']        = $this->model->lokasi();
            $data['lists']      = $this->model->kategori();

            // data bulan
            $data['bulan']      = $this->model;
            $data['these']       = $this;

            //data
            $data['rows']       = $this->model->ambil($this->bulan,$this->tahun);
            return view('stockout/stock',$data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function show(){
        $id     = $_POST['id'];
        $data   = $this->model->show($id);

        $kategori = $this->model->kategori();
        $barang   = $this->model->barang();

        $opt1[0] = '<option value="--">Pilih Kategori</option>';
        $opt2[0] = '<option value="">Pilih Barang</option>';
        foreach($kategori as $num => $rows){
            $selected = ($data['cat'] == $rows['id']) ? "selected='selected'" : null;
            $no = $num+1;
            $opt1[$no] = "<option value='cat-{$rows['id']}' {$selected}>{$rows['jenis']}</option>";
        }

        foreach($barang as $num => $rows){
            $selected = ($data['stok'] == $rows['id']) ? "selected='selected'" : null;
            $no = $num + 1;
            $opt2[$no] = "<option value='{$rows['id']}' data-chained='cat-{$rows['jenis']}' {$selected}>{$rows['barang']}</option>";
        }

        // retrieve to json;
        $data['kategori'] = $opt1;
        $data['barang']   = $opt2;

        echo json_encode($data);
    }

    public function tambah(){
        $stok = $_POST['barang'];

        // get jumlah stok
        $jumlah = $this->model->query("select jumlah from stok where id = {$stok}")[0]['jumlah'];
        $sisa   = $jumlah - $_POST['jumlah'];

        if($sisa >= 0){
            $data['stok'] = $stok;
            $data['admin'] = $_POST['admin'];
            $data['pemohon'] = $_POST['pemohon'];
            $data['lokasi'] = $_POST['lokasi'];
            $data['jumlah'] = $_POST['jumlah'];
            $data['waktu'] = date("Y-m-d H:i:s");

            // tambah data
            $this->model->tambah($data,$stok);

            // generate rows
            $rows = $this->model->ambil($this->bulan,$this->tahun);
            $tr   = null;

            if(count($rows) >= 1){
                foreach ($rows as $key => $val) {
                    $no = $key + 1;
                    $waktu = date("d-m-Y H:i:s",strtotime($val['waktu']));
                    $tr[$key] = "
                        <tr>
                            <td>{$no}</td>
                            <td>{$val['kode']}</td>
                            <td>{$val['barang']}</td>
                            <td>{$val['merk']}</td>
                            <td>{$val['pemohon']}</td>
                            <td>{$val['lokasi']}</td>
                            <td>{$val['jumlah']}</td>
                            <td>{$waktu}</td>
                            <td>
                                <button class='btn btn-primary' onclick='edit({$val['id']})'>
                                    <i class='fa fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger' onclick='hapus({$val['id']},{$val['id_stok']})'>
                                    <i class='fa fa-trash'></i>
                                </button>
                                <a href='pengajuan-barang/print/{$val['id']}' class='btn btn-success'>
                                    <i class='fa fa-print'></i>
                                </a>
                            </td>
                        </tr>
                    ";
                }
            }

            // message
            $msg = null;
        } else {
            $msg = "tidak bisa mengajukan barang lebih dari {$jumlah}";
            $tr  = null;
        }
        echo json_encode(['tr' => $tr, 'msg' => $msg]);
    }

    public function update(){
        // parameter
        $id         = $_POST['id'];
        $prevStok   = $_POST['prevStok'];
        $newStok    = $_POST['barang'];

        // get jumlah stok
        if($prevStok == $newStok){
            $query  = "select (s.jumlah + k.jumlah) as jumlah from stok s join stok_keluar k on s.id=k.stok where k.id = {$id}"; 
            $jumlah = $this->model->query($query)[0]['jumlah'];
        } else {
            $query  = "select jumlah from stok where id = {$newStok}";
            $jumlah = $this->model->query($query)[0]['jumlah'];
        }
        $sisa = $jumlah - $_POST['jumlah'];

        if($sisa >= 0){
            // data update
            $data['stok']       = $newStok;
            $data['pemohon']    = $_POST['pemohon'];
            $data['lokasi']     = $_POST['lokasi'];
            $data['jumlah']     = $_POST['jumlah'];
            $data['waktu']      = date("Y-m-d H:i:s");

            // update
            $this->model->edit($id,$prevStok,$newStok,$data);

            // generate rows
            $rows = $this->model->ambil($this->bulan,$this->tahun);
            $tr   = null;

            if(count($rows) >= 1){
                foreach ($rows as $key => $val) {
                    $no = $key + 1;
                    $waktu = date("d-m-Y H:i:s",strtotime($val['waktu']));
                    $tr[$key] = "
                        <tr>
                            <td>{$no}</td>
                            <td>{$val['kode']}</td>
                            <td>{$val['barang']}</td>
                            <td>{$val['merk']}</td>
                            <td>{$val['pemohon']}</td>
                            <td>{$val['lokasi']}</td>
                            <td>{$val['jumlah']}</td>
                            <td>{$waktu}</td>
                            <td>
                                <button class='btn btn-primary' onclick='edit({$val['id']})'>
                                    <i class='fa fa-pencil-alt'></i>
                                </button>
                                <button class='btn btn-danger' onclick='hapus({$val['id']},{$val['id_stok']})'>
                                    <i class='fa fa-trash'></i>
                                </button>
                                <a href='pengajuan-barang/print/{$val['id']}' class='btn btn-success'>
                                    <i class='fa fa-print'></i>
                                </a>
                            </td>
                        </tr>
                    ";
                }
            }

            $msg = null;
        } else {
            $msg = "tidak bisa mengajukan barang lebih dari {$jumlah}";
            $tr  = null;
        }

        echo json_encode(['tr' => $tr, 'msg' => $msg]);
    }

    public function hapus(){
        $id_ambil = $_POST['id'];
        $id_stok  = $_POST['id_stok'];

        // hapus data
        $this->model->hapus($id_ambil,$id_stok);

        // generate rows
        $rows = $this->model->ambil($this->bulan,$this->tahun);
        $tr   = null;

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $waktu = date("d-m-Y H:i:s",strtotime($val['waktu']));
                $tr[$key] = "
                    <tr>
                        <td>{$no}</td>
                        <td>{$val['kode']}</td>
                        <td>{$val['barang']}</td>
                        <td>{$val['merk']}</td>
                        <td>{$val['pemohon']}</td>
                        <td>{$val['lokasi']}</td>
                        <td>{$val['jumlah']}</td>
                        <td>{$waktu}</td>
                        <td>
                            <button class='btn btn-primary' onclick='edit({$val['id']})'>
                                <i class='fa fa-pencil-alt'></i>
                            </button>
                            <button class='btn btn-danger' onclick='hapus({$val['id']},{$val['id_stok']})'>
                                <i class='fa fa-trash'></i>
                            </button>
                            <a href='pengajuan-barang/print/{$val['id']}' class='btn btn-success'>
                                <i class='fa fa-print'></i>
                            </a>
                        </td>
                    </tr>
                ";
            }
        }

        echo json_encode($tr);
    }

    // print pdf
    public function print($id){
        $data['print'] = $this->model->printData($id);
        return view('stockout/print',$data);
    }

    // print laporan barang keluar
    public function generate(){
        $bulan  = $_POST['bulan'];
        $tahun  = $_POST['tahun'];
        $result = $this->model->ambil($bulan,$tahun);

        if(count($result) == 0){
            $tr     = null;
        } else {
            foreach($result as $num => $key){
                $no = $num + 1;
                $waktu = date("d-m-Y H:i:s",strtotime($key['waktu']));
                $tr[$num] = "
                <tr>
                    <td>{$no}</td>
                    <td>{$key['kode']}</td>
                    <td>{$key['barang']}</td>
                    <td>{$key['merk']}</td>
                    <td>{$key['pemohon']}</td>
                    <td>{$key['lokasi']}</td>
                    <td>{$key['jumlah']}</td>
                    <td>{$waktu}</td>
                    <td>
                    <button class='btn btn-primary' onclick='edit({$key['id']})'>
                        <i class='fa fa-pencil-alt'></i>
                    </button>
                    <button class='btn btn-danger' onclick='hapus({$key['id']},{$key['id_stok']})'>
                        <i class='fa fa-trash'></i>
                    </button>
                    <a href='pengajuan-barang/print/{$key['id']}' class='btn btn-success'>
                        <i class='fa fa-print'></i>
                    </a>
                    </td>
                </tr>
                ";
            }
        }

        echo json_encode(['bulan' => $bulan, 'tahun' => $tahun, 'val' => $tr]);
    }

    public function laporan_keluar($bulan,$tahun){
        $data['value'] = $this->model->laporan_generate($bulan,$tahun);
        $data['bulan'] = $this->model->bulan($bulan)['bulan'];
        $data['tahun'] = $tahun;
        return view('stockout/laporan',$data);
    }
}
