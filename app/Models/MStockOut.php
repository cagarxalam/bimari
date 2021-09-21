<?php

namespace App\Models;

use CodeIgniter\Model;

class MStockOut extends Model
{
    protected $db;

    function __construct(){
        $this->db = \Config\Database::connect();
    }

    function query($query){
        return $this->db->query($query)->getResultArray();
    }

    function ambil(){
        $q = "select sk.id, s.kode, s.barang, s.merk, sk.pemohon, sk.admin, l.lokasi, concat(sk.jumlah,' ',k.satuan) as jumlah, sk.waktu from stok_keluar sk join stok s on sk.stok = s.id join lokasi l on sk.lokasi = l.id join kategori k on s.jenis = k.id";
        $data = $this->query($q);
        return $data;
    }

    function show($id){

    }

    function tambah($data){
        $this->db->table('stok_keluar')->insert($data);
    }

    function edit($id,$data){

    }

    function hapus($id){

    }

    // barang
    function barang(){
        $q      = "select id, concat(kode,' - ',barang) as barang from stok";
        $data   = $this->query($q);
        
        return $data;
    }

    // lokasi
    function lokasi(){
        $q      = "select * from lokasi";
        $data   = $this->query($q);
        return $data;
    }
}
