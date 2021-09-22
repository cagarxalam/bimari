<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MStockOut;

class StockOut extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new MStockOut();
    }

    public function index(){
        if($this->session->user){
            $data['title']      = "SIM Inventaris | Laporan Pengajuan Barang";
            $data['stockout']   = "active";
            $data['admin']      = $this->session->user;

            // barang dan lokasi
            $data['barang']     = $this->model->barang();
            $data['lok']        = $this->model->lokasi();

            //data
            $data['rows']       = $this->model->ambil();
            return view('stockout/stock',$data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function show(){
        $id     = $_POST['id'];
        $data   = $this->model->show($id);

        echo json_encode($data);
    }

    public function tambah(){
        $stok = $_POST['barang'];

        $data['stok'] = $stok;
        $data['admin'] = $_POST['admin'];
        $data['pemohon'] = $_POST['pemohon'];
        $data['lokasi'] = $_POST['lokasi'];
        $data['jumlah'] = $_POST['jumlah'];
        $data['waktu'] = date("Y-m-d H:i:s");

        // tambah data
        $this->model->tambah($data,$stok);

        // generate rows
        $rows = $this->model->ambil();
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
                        </td>
                    </tr>
                ";
            }
        }
        echo json_encode($tr);
    }

    public function update(){
        // parameter
        $id         = $_POST['id'];
        $prevStok   = $_POST['prevStok'];
        $newStok    = $_POST['barang'];

        // data update
        $data['stok']       = $newStok;
        $data['pemohon']    = $_POST['pemohon'];
        $data['lokasi']     = $_POST['lokasi'];
        $data['jumlah']     = $_POST['jumlah'];
        $data['waktu']      = date("Y-m-d H:i:s");

        // update
        $this->model->edit($id,$prevStok,$newStok,$data);

        // generate rows
        $rows = $this->model->ambil();
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
                        </td>
                    </tr>
                ";
            }
        }

        echo json_encode($tr);
    }

    public function hapus(){
        $id_ambil = $_POST['id'];
        $id_stok  = $_POST['id_stok'];

        // hapus data
        $this->model->hapus($id_ambil,$id_stok);

        // generate rows
        $rows = $this->model->ambil();
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
                        </td>
                    </tr>
                ";
            }
        }

        echo json_encode($tr);
    }
}
