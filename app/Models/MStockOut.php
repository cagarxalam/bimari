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
        $q = "select k.*, j.id as cat, j.jenis from stok_keluar k join stok s on k.stok=s.id join kategori j on s.jenis=j.id where k.id={$id}";
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

    // kategori
    function kategori(){
        $q = "select id, jenis from kategori";
        $data = $this->query($q);
        return $data;
    }

    // barang
    function barang(){
        $q      = "select id, concat(kode,' - ',barang) as barang, jenis from stok";
        $data   = $this->query($q);
        
        return $data;
    }

    // lokasi
    function lokasi(){
        $q      = "select * from lokasi";
        $data   = $this->query($q);
        return $data;
    }

    // print
    function printData($id){
        $query = "with keluar as ( select *, row_number() over (order by id) as no from stok_keluar ) select k.no, s.kode, s.barang, s.merk, k.admin, k.pemohon, l.lokasi, concat(k.jumlah,' ',j.satuan) as jumlah, month(k.waktu) as bulan, year(k.waktu) as tahun, k.waktu from keluar k join stok s on k.stok=s.id join kategori j on j.id=s.jenis join lokasi l on k.lokasi=l.id where k.id={$id}";
        $data = $this->query($query)[0];
        
        $result['no'] = str_pad($data['no'], 3, '0', STR_PAD_LEFT);
        $result['kode'] = $data['kode'];
        $result['barang'] = $data['barang'];
        $result['merk'] = $data['merk'];
        $result['admin'] = $data['admin'];
        $result['pemohon'] = $data['pemohon'];
        $result['lokasi'] = $data['lokasi'];
        $result['jumlah'] = $data['jumlah'];
        $result['tahun'] = $data['tahun'];
        $result['hari'] = date("d",strtotime($data['waktu']));
        $result['bulan'] = $this->bulan($data['bulan'])['bulan'];
        $result['romawi'] = $this->bulan($data['bulan'])['romawi'];

        return $result;
    }

    function bulan($bulan){
        $array1 = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        $array2 = [
            '1' => 'I',
            '2' => 'II',
            '3' => 'III',
            '4' => 'IV',
            '5' => 'V',
            '6' => 'VI',
            '7' => 'VII',
            '8' => 'VIII',
            '9' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
        ];

        $data['bulan']  = (isset($bulan)) ? $array1[$bulan] : null;
        $data['romawi'] = (isset($bulan)) ? $array2[$bulan] : null;

        return $data;
    }

    function laporan_generate($bulan,$tahun){
        $query = "select sk.id, s.kode, s.barang, s.merk, sk.pemohon, sk.admin, l.lokasi, concat(sk.jumlah,' ',k.satuan) as jumlah from stok_keluar sk join stok s on sk.stok = s.id join lokasi l on sk.lokasi = l.id join kategori k on s.jenis = k.id where month(sk.waktu) = {$bulan} and year(sk.waktu) = {$tahun} order by sk.waktu asc";
        $data  = $this->query($query);
        return $data;
    }
}
