<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUser;

class User extends BaseController
{
    protected $model;

    public function __construct(){
        $this->model = new MUser();
    }

    public function index(){
        if($this->session->user && $this->session->role == 1){
            $data['title']  = "SIM Inventaris | Master User";
            $data['user']   = "active";
            $data['master'] = "active";

            // rows
            $data['rows']   = $this->model->ambil(2);

            return view('user/page',$data);
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
        $data['nama']       = $_POST['nama'];
        $data['password']   = password_hash($_POST['password'],PASSWORD_BCRYPT) ;
        $data['role']       = 2;

        // tambah data
        $this->model->tambah($data);

        // generate rows
        $rows = $this->model->ambil(2);

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $role = ($val['role'] == 2) ? "Admin Inventaris" : "Super Admin";
                $tr[$key] = "
                    <tr id='rows-{$val['id']}'>
                        <td>{$no}</td>
                        <td>{$val['nama']}</td>
                        <td>{$role}</td>
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
        $id                 = $_POST['id'];
        $data['nama']       = $_POST['nama'];
        if($_POST['password'] != "")
        {
            $data['password']   = password_hash($_POST['password'],PASSWORD_BCRYPT) ;
        }

        // update data
        $this->model->edit($id,$data);

        // generate rows
        $rows = $this->model->ambil(2);

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $role = ($val['role'] == 2) ? "Admin Inventaris" : "Super Admin";
                $tr[$key] = "
                    <tr id='rows-{$val['id']}'>
                        <td>{$no}</td>
                        <td>{$val['nama']}</td>
                        <td>{$role}</td>
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
        $id                 = $_POST['id'];

        // hapus data
        $this->model->hapus($id);

        // generate rows
        $rows = $this->model->ambil(2);

        if(count($rows) >= 1){
            foreach ($rows as $key => $val) {
                $no = $key + 1;
                $role = ($val['role'] == 2) ? "Admin Inventaris" : "Super Admin";
                $tr[$key] = "
                    <tr id='rows-{$val['id']}'>
                        <td>{$no}</td>
                        <td>{$val['nama']}</td>
                        <td>{$role}</td>
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
