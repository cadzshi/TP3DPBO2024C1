<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Barang.php');

// buat instance Barang
$listBarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listBarang->open();

// periksa apakah parameter ID ada dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        # code...
            $result = $listBarang->deleteData($id);
            
            if ($result == 0) {
                // Data berhasil dihapus
                $message = 'Data berhasil dihapus';
            } else {
            // Gagal menghapus data
            $message = 'Terjadi kesalahan saat menghapus data';
        }
    
        // Redirect ke halaman indeks dengan pesan sebagai parameter URL
        header('location: index.php?message=' . urlencode($message));
    }
} else {
    // Redirect ke halaman indeks jika parameter ID tidak ada
    header('location: index.php');
}

// tutup koneksi
$listBarang->close();