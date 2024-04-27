<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Merk.php');
include('classes/Barang.php');
include('classes/Template.php');

// buat instance barang
$listBarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listBarang->open();
// tampilkan data barang
$listBarang->getBarangJoin();

// cari barang
if (isset($_POST['btn-cari'])) {
    // methode mencari data barang
    $listBarang->searchBarang($_POST['cari']);
} else {
    // method menampilkan data barang
    $listBarang->getBarangJoin();
}

// sort Barang
if (isset($_GET['btn-sort'])) {
    // methode mencari data Barang
    $listBarang->getBarangSort($_GET['sort']);
}

$data = null;

// ambil data barang
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listBarang->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-start">' .
        '<div class="card pt-4 px-2 barang-thumbnail">
        <a href="detail.php?id=' . $row['barang_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['barang_foto'] . '" class="card-img-top" alt="' . $row['barang_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text barang-nama my-0">' . $row['barang_nama'] . '</p>
                <p class="card-text jenis-nama">' . $row['jenis_nama'] . '</p>
                <p class="card-text merk-nama my-0">' . $row['merk_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listBarang->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_BARANG', $data);
$home->write();
