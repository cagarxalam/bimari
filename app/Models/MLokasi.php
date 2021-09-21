<?php

namespace App\Models;

use CodeIgniter\Model;

class MLokasi extends Model
{
    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function query($query){
        return $this->db->query($query)->getResultArray();
    }

    public function ambil(){
        $query = "select * from lokasi";
        $data = $this->query($query);
        return $data;
    }

    public function show($id){
        $query = "select * from lokasi where id = {$id}";
        $data = $this->query($query);
        return $data[0];
    }

    public function tambah($data){
        $this->db->table("lokasi")->insert($data);
    }

    public function edit($id,$data){
        $this->db->table("lokasi")->where('id',$id)->update($data);
    }

    public function hapus($id){
        $this->db->table("lokasi")->where('id',$id)->delete();
    }
}
