<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Merk.php');
include('classes/Barang.php');
include('classes/Template.php');

$barang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$barang->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $barang->getBarangById($id);
        $row = $barang->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['barang_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['barang_foto'] . '" class="img-thumbnail" alt="' . $row['barang_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['barang_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>' . $row['barang_harga'] . '</td>
                                </tr>
                                <tr>
                                    <td>Garansi</td>
                                    <td>:</td>
                                    <td>' . $row['barang_garansi'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>:</td>
                                    <td>' . $row['jenis_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Merk</td>
                                    <td>:</td>
                                    <td>' . $row['merk_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="updateBarang.php?id=' . $row['barang_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="delete.php?id=' . $row['barang_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$barang->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_BARANG', $data);
$detail->write();
