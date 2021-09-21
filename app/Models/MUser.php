<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function query($query){
        return $this->db->query($query)->getResultArray();
    }

    public function ambil($id = null){
        $q = "select * from admin";
        $q2 = "select * from admin where role = {$id}";
        if($id == null) {
            return $this->query($q);
        } else {
            return $this->query($q2);
        }
    }

    public function show($id){
        $q = "select * from admin where id = {$id}";
        return $this->query($q)[0];
    }

    public function tambah($data){
        $this->db->table('admin')->insert($data);
    }

    public function edit($id,$data){
        $this->db->table('admin')->where('id',$id)->update($data);
    }

    public function hapus($id){
        $this->db->table('admin')->where('id',$id)->delete();
    }
}
