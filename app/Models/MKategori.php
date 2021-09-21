<?php

namespace App\Models;

use CodeIgniter\Model;

class MKategori extends Model
{
    protected $db;

    function __construct(){
        $this->db = \Config\Database::connect();
    }

    protected function query($query){
        $data = $this->db->query($query)->getResultArray();
        return $data;
    }

    function ambil(){
        $data = $this->query("select * from kategori");
        return $data;
    }

    function show($id){
        $data = $this->query("select * from kategori where id={$id}");
        return $data;
    }

    function tambah($data){
        $this->db->table('kategori')->insert($data);
    }

    function edit($id,$data){
        $this->db->table('kategori')->where('id',$id)->update($data);
    }

    function hapus($id){
        $this->db->table('kategori')->where('id',$id)->delete();
    }
}
