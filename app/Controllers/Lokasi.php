<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MLokasi;

class Lokasi extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new MLokasi();
    }

    public function index(){
        if($this->session->user){
            $data['title']  = "SIM Inventaris | Lokasi Aset";
            $data['lokasi'] = "active";
            $data['master'] = "active";

            // list
            $data['rows']   = $this->model->ambil();

            return view('lokasi/page',$data);
        } else {
            return redirect()->to(base_url("login"));
        }
    }

    public function show(){
        $id = $_POST['id'];

        $data = $this->model->show($id);
        echo json_encode($data);
    }

    public function tambah(){
        $data['lokasi'] = $_POST['lokasi'];

        // tambah data
        $this->model->tambah($data);

        // generate rows
        $rows = $this->model->ambil();

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }

    public function update(){
        $id             = $_POST['id'];
        $data['lokasi'] = $_POST['lokasi'];

        // update data
        $this->model->edit($id,$data);
        
        // generate rows
        $rows = $this->model->ambil();

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }

    public function hapus(){
        $id = $_POST['id'];

        // delete data
        $this->model->hapus($id);

        // generate rows
        $rows = $this->model->ambil();
        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $tr[$key] = "
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
            }
        } else {
            $tr = null;
        }

        echo json_encode($tr);
    }
}
