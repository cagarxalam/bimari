<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MStok;

class Stok extends BaseController
{
    protected $model;

    function __construct(){
        $this->model = new MStok();
    }

    public function index(){
        if($this->session->user){
            $data['stok']   = 'active';
            $data['title']  = 'SIM Inventaris | Laporan Stok Inventaris';

            // select
            $data['select'] = $this->model->kategori();

            // table
            $data['rows']   = $this->model->ambil();
            return view('stok/index',$data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function show(){
        $id = $_POST['id'];

        // data
        $data = $this->model->show($id);
        echo json_encode($data);
    }

    public function tambah(){
        $query          = "select id, jenis from kategori where id = {$_POST['kategori']}";
        $show           = $this->model->query($query)[0];
        $jenis          = strtoupper(substr($show['jenis'],0,3));
        $id_kode        = str_pad($show['id'],3,'0',STR_PAD_LEFT);
        $barang         = strtoupper(substr($_POST['barang'],0,3));

        // data for database
        $data['jenis']  = $_POST['kategori'];
        $data['kode']   = "{$jenis}{$id_kode}{$barang}";
        $data['barang'] = $_POST['barang'];
        $data['merk']   = $_POST['merk'];
        $data['jumlah'] = $_POST['jumlah'];
        $data['time']   = date("Y-m-d H:i:s");

        // insert data
        $this->model->tambah($data);

        // generate tr
        $rows = $this->model->ambil();
        if(count($rows) >= 1){
            foreach($rows as $key => $val){
                $no = $key+1;
                $time = date("d-m-Y H:i:s",strtotime($val['waktu']));
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }

    public function update(){
        $id             = $_POST['id'];
        $query          = "select id, jenis from kategori where id = {$_POST['kategori']}";
        $show           = $this->model->query($query)[0];
        $jenis          = strtoupper(substr($show['jenis'],0,3));
        $id_kode        = str_pad($show['id'],3,'0',STR_PAD_LEFT);
        $barang         = strtoupper(substr($_POST['barang'],0,3));

        // data for database
        $data['jenis']  = $_POST['kategori'];
        $data['kode']   = "{$jenis}{$id_kode}{$barang}";
        $data['barang'] = $_POST['barang'];
        $data['merk']   = $_POST['merk'];
        $data['jumlah'] = $_POST['jumlah'];
        $data['time']   = date("Y-m-d H:i:s");

        // update data
        $this->model->edit($id,$data);

        // update $rows
        $rows = $this->model->ambil();
        if(count($rows) >= 1){
            foreach($rows as $key => $val){
                $no = $key+1;
                $time = date("d-m-Y H:i:s",strtotime($val['waktu']));
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }

    public function delete(){
        $id = $_POST['id'];

        //delete data
        $this->model->hapus($id);

        // generate tr
        $rows = $this->model->ambil();
        if(count($rows) >= 1){
            foreach($rows as $key => $val){
                $no = $key+1;
                $time = date("d-m-Y H:i:s",strtotime($val['waktu']));
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }
}
