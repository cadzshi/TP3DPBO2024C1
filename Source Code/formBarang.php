<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Merk.php');
include('classes/Barang.php');
include('classes/Template.php');

// buat instance Barang
$listBarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listJenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listMerk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// buka koneksi
$listBarang->open();
$listJenis->open();
$listMerk->open();
// tampilkan data Barang
$listBarang->getBarangJoin();
$listJenis->getJenis();
$listMerk->getMerk();

$dataJenis = null;
$dataMerk = null;
$data = null;
// ambil data Barang
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listJenis->getResult()) {
    $dataJenis .= '<option value="'.$row['jenis_id'].'">'.$row['jenis_nama'].'</option>';
}
while ($row = $listMerk->getResult()) {
    $dataMerk .= '<option value="'.$row['merk_id'].'">'.$row['merk_nama'].'</option>';
}

$data .= '<form action="add.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label for="nama">Nama:</label>
  <input
    type="text"
    class="form-control"
    id="nama"
    name="nama"
    required
  />
</div>
<div class="form-group">
  <label for="harga">Harga:</label>
  <input
    
    class="form-control"
    id="harga"
    name="harga"
    required
  />
</div>
<div class="form-group">
  <label for="garansi">Garansi:</label>
  <input

    class="form-control"
    id="garansi"
    name="garansi"
    required
  />
</div>
<div class="form-group">
  <div class="form-group">
    <label for="jenis">Jenis:</label>
    <select class="form-control" id="jenis" name="jenis">
       '.$dataJenis.'
    </select>
</div>
</div>          
<div class="form-group">
  <div class="form-group">
    <label for="merk">Merk:</label>
    <select class="form-control" id="merk" name="merk">
    '.$dataMerk.'
    </select>
</div>
</div>          
<div class="form-group">
  <div class="form-group">
    <label for="gambar">Gambar:</label>
    <input type="file" name="gambar" id="gambar">
  </div>
</div>
<div class="form-group d-flex justify-content-end">
<a href="index.php" class="btn btn-danger me-2">Cancel</a>
    <button type="submit" class="btn btn-primary">Add</button>
</div>
</form>';



if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo '<div class="alert alert-success">' . $message . '</div>';
}

// tutup koneksi
$listBarang->close();
$listJenis->close();
$listMerk->close();

// buat instance template
$form = new Template('templates/skinform.html');

// simpan data ke template
$form->replace('FORMBARANG', $data);
$form->replace('TITLEBARANG', 'Menambahkan Barang');
$form->write();