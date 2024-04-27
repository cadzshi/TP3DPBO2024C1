<?php

class Barang extends DB
{
    function getBarangJoin()
    {
        $query = "SELECT * FROM barang JOIN jenis ON barang.jenis_id=jenis.jenis_id JOIN merk ON barang.merk_id=merk.merk_id ORDER BY barang.barang_id";

        return $this->execute($query);
    }

    function getBarang()
    {
        $query = "SELECT * FROM barang";
        return $this->execute($query);
    }

    function getBarangById($id)
    {
        $query = "SELECT * FROM barang JOIN jenis ON barang.jenis_id=jenis.jenis_id JOIN merk ON barang.merk_id=merk.merk_id WHERE barang_id=$id";
        return $this->execute($query);
    }

    function searchBarang($keyword)
    {
        $query = "SELECT * FROM barang JOIN jenis ON barang.jenis_id=jenis.jenis_id JOIN merk ON barang.merk_id=merk.merk_id WHERE barang_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function getBarangSort($sort)
    {
        $query = "SELECT * FROM barang JOIN jenis ON barang.jenis_id=jenis.jenis_id JOIN merk ON barang.merk_id=merk.merk_id ORDER BY barang.barang_nama $sort";

        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $nama = $data['nama'];
        $harga = $data['harga'];
        $garansi = $data['garansi'];
        $merk = $data['merk'];
        $jenis = $data['jenis'];
        $query = "INSERT INTO barang VALUES('','$nama', '$harga', '$garansi', '$merk', '$jenis', '$file')";
        return $this->executeAffected($query);
    }

    function updateData($data, $file)
    {
        $id = $data['id'];
        $nama = $data['nama'];
        $harga = $data['harga'];
        $garansi = $data['garansi'];
        $merk = $data['merk'];
        $jenis = $data['jenis'];
        $query = "UPDATE barang SET barang_nama = '$nama', barang_harga = '$harga', barang_garansi = '$garansi', merk_id = '$merk', jenis_id = '$jenis', barang_foto='$file' WHERE barang_id = $id";
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM barang WHERE barang_id = ".$id;
        return $this->executeAffected($query);
    
    }
}
