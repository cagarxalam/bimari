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

    public function tambah(){
        $data['stok'] = $_POST['barang'];
        $data['admin'] = $_POST['admin'];
        $data['pemohon'] = $_POST['pemohon'];
        $data['lokasi'] = $_POST['lokasi'];
        $data['jumlah'] = $_POST['jumlah'];
        $data['waktu'] = date("Y-m-d H:i:s");

        // tambah data
        $this->model->tambah($data);
        echo json_encode($data);
    }
}
