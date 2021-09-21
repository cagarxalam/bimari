<?php

namespace App\Models;

use CodeIgniter\Model;

class MStok extends Model
{
    protected $db;

    function __construct(){
        $this->db = \Config\Database::connect();
    }

    function query($query){
        $data = $this->db->query($query)->getResultArray();
        return $data;
    }

    function ambil(){
        $data = 'select s.id, s.kode, s.barang, k.jenis as kategori, s.merk, concat(s.jumlah, " ",k.satuan) as jumlah, s.jenis, s.time as waktu from stok s inner join kategori k on s.jenis=k.id';
        $val  = $this->query($data);
        return $val;
    }

    function show($id){
        $data = "select id, jenis, barang, merk, jumlah from stok where id = {$id}";
        return $this->query($data)[0];
    }

    function tambah($data){
        $this->db->table('stok')->insert($data);
    }

    function edit($id,$data){
        $this->db->table('stok')->where('id',$id)->update($data);
    }

    function hapus($id){
        $this->db->table('stok')->where('id',$id)->delete();
    }

    // select kategori
    function kategori(){
        $data = 'select id, jenis from kategori';
        return $this->query($data);
    }
}
