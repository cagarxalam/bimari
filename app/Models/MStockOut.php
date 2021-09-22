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
        $q = "select sk.id, s.id as id_stok, s.kode, s.barang, s.merk, sk.pemohon, sk.admin, l.lokasi, concat(sk.jumlah,' ',k.satuan) as jumlah, sk.waktu from stok_keluar sk join stok s on sk.stok = s.id join lokasi l on sk.lokasi = l.id join kategori k on s.jenis = k.id order by sk.waktu desc";
        $data = $this->query($q);
        return $data;
    }

    function show($id){
        $q = "select * from stok_keluar where id = {$id}";
        $data = $this->query($q);
        return $data[0];
    }

    function tambah($data,$stok){
        $q = "update stok set time = (select sk.waktu from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$stok} order by sk.id desc limit 1), jumlah = (select (s.jumlah - sk.jumlah) as jumlah from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$stok} order by sk.id desc limit 1) where id = {$stok}";
        
        $this->db->transBegin();
        $this->db->table('stok_keluar')->insert($data);
        $this->db->query($q);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }

    function edit($id_ambil,$prevStok,$newStok,$data){
        // reset jumlah
        $reset  = "update stok set jumlah = (select (s.jumlah + sk.jumlah) from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$prevStok} and sk.id = {$id_ambil}) where id = {$prevStok}";
        // update stok
        $stok   = "update stok set time = (select sk.waktu from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$newStok} and sk.id = {$id_ambil}) ,jumlah = (select (s.jumlah - sk.jumlah) from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$newStok} and sk.id = {$id_ambil}) where id = {$newStok}";

        // query
        $this->db->transBegin();
        $this->db->query($reset);
        $this->db->table('stok_keluar')->where('id',$id_ambil)->update($data);
        $this->db->query($stok);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }

    function hapus($id,$id_stok){
        // reset stok
        $time   = date("Y-m-d H:i:s");
        $reset  = "update stok set time = '{$time}', jumlah = (select (s.jumlah + sk.jumlah) from stok s join stok_keluar sk on s.id = sk.stok where s.id = {$id_stok} and sk.id = {$id}) where id = {$id_stok}";
    
        $this->db->transBegin();
        $this->db->query($reset);
        $this->db->table('stok_keluar')->where('id',$id)->delete();

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
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
