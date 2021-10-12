<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MKategori;

class Kategori extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new MKategori();
    }

    public function index(){
        if($this->session->user){
            $data['kategori']   = 'active';
            $data['master']     = 'active';
            $data['title']      = 'Kategori | Sistem Informasi Manajemen Aset';

            // data kategori
            $data['value']      = $this->model->ambil();
            return view("kategori/page",$data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function show(){
        $id = $_POST['id'];

        $data = $this->model->show($id)[0];
        echo json_encode($data);
    }

    public function tambah(){
        $data['jenis']  = $_POST['jenis'];
        $data['satuan'] = $_POST['satuan'];

        // tambah data
        $this->model->tambah($data);

        // tampilkan tabel
        $tabel = $this->model->ambil();
        foreach($tabel as $num => $val){
            $tr[$num] = "
                <tr id='rows-{$val['id']}'>
                    <td>{$val['jenis']}</td>
                    <td>{$val['satuan']}</td>
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
        echo json_encode($tr);
    }

    public function update(){
        $id             =   $_POST['id'];
        $data['jenis']  =   $_POST['jenis'];
        $data['satuan'] =   $_POST['satuan'];

        // update data
        $this->model->edit($id,$data);

        // change row
        $rows = $this->model->show($id)[0];
        $tr   = "
            <tr id='rows-{$rows['id']}'>
                <td>{$rows['jenis']}</td>
                <td>{$rows['satuan']}</td>
                <td>
                    <button class='btn btn-primary' onclick='edit({$rows['id']})'>
                        <i class='fa fa-pencil-alt'></i>
                    </button>
                    <button class='btn btn-danger' onclick='hapus({$rows['id']})'>
                        <i class='fa fa-trash'></i>
                    </button>
                </td>
            </tr>
        ";
        echo json_encode(['tr' => $tr, 'id' => $id]);
    }

    public function hapus(){
        $id = $_POST['id'];

        // hapus data
        $this->model->hapus($id);

        // draw table
        $data = $this->model->ambil();
        if(count($data) >= 1){
            foreach ($data as $key => $val) {
                $tr[$key] = "
                    <tr id='rows-{$val['id']}'>
                        <td>{$val['jenis']}</td>
                        <td>{$val['satuan']}</td>
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
