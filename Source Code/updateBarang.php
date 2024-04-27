<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Merk.php');
include('classes/Barang.php');
include('classes/Template.php');


$listBarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listJenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listMerk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// buka koneksi
$listBarang->open();
$listJenis->open();
$listMerk->open();

$listBarang->getBarangJoin();
$listJenis->getJenis();
$listMerk->getMerk();

$dataJenis = null;
$dataMerk = null;
$data = null;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $listBarang->getBarangById($id);
        $chara = $listBarang->getResult();
        while ($row = $listJenis->getResult()) {
            if ($row['jenis_id'] == $chara['jenis_id']) {
                $dataJenis .= '<option value="'.$row['jenis_id'].'" selected>'.$row['jenis_nama'].'</option>';
            }else {
                $dataJenis .= '<option value="'.$row['jenis_id'].'">'.$row['jenis_nama'].'</option>';
            }
        }
        while ($row = $listMerk->getResult()) {
            if ($row['merk_id'] == $chara['merk_id']) {
                $dataMerk .= '<option value="'.$row['merk_id'].'" selected>'.$row['merk_nama'].'</option>';
            }else {
                $dataMerk .= '<option value="'.$row['merk_id'].'">'.$row['merk_nama'].'</option>';
            }
        }

        $data .= '<form action="update.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="nama">Nama:</label>
        <input
          type="text"
          class="form-control"
          id="nama"
          name="nama"
          value="'.$chara['barang_nama'].'"
          required
        />
      </div>
      <div class="form-group">
        <label for="harga">Harga:</label>
        <input
          class="form-control"
          id="harga"
          name="harga"
          value="'.$chara['barang_harga'].'"
          required
        />
      </div>
      <div class="form-group">
        <label for="garansi">Garansi:</label>
        <input
          class="form-control"
          id="garansi"
          name="garansi"
          value='.$chara['barang_garansi'].'
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
      <input
        type="text"
        class="form-control"
        id="gambarlama"
        name="gambarlama"
        hidden="true"
        value="'. $chara['barang_foto'].'"
        required
      />
    </div>          
      <div class="form-group">
        <div class="form-group">
          <label for="gambar">Gambar:</label>
          <input type="file" name="gambar" id="gambar">
        </div>
      </div>
      <div class="form-group d-flex justify-content-end">
      <a href="index.php" class="btn btn-danger me-2">Cancel</a>
          <button type="submit" class="btn btn-info">Update</button>
      </div>
        <div class="form-group">
        <input
          type="text"
          class="form-control"
          id="id"
          name="id"
          hidden="true"
          value="'. $chara['barang_id'].'"
          required
        />
      </div>
      </div>
      
        </form>';
    }
}
 else {
    // Redirect ke halaman indeks jika parameter ID tidak ada
    header('location: index.php');
}


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
$form->replace('TITLEBARANG', 'Update Barang');
$form->write();