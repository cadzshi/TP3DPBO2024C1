<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Barang.php');

// Buat instance Barang
$listBarang = new Barang($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi
$listBarang->open();

// Ambil data Barang
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    
    if (isset($_FILES['gambar'])) {
        $file = $_FILES['gambar'];
        
        // Periksa apakah ada error dalam upload gambar
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filePath = 'assets/images/' . $data["gambarlama"];
            
            // Periksa apakah file gambar yang akan dihapus ada
            if (file_exists($filePath)) {
                unlink($filePath);
                
                $filename = time() . $file['name'];
                $tempFilePath = $file['tmp_name'];
    
                // Pindahkan file gambar ke direktori tujuan
                $targetDir = 'assets/images/';
                $targetPath = $targetDir . $filename;
                move_uploaded_file($tempFilePath, $targetPath);
    
                $result = $listBarang->updateData($data, $filename);
                
                if ($result == 0) {
                    // Data berhasil diupdate
                    $message = 'Data berhasil diupdate';
                } else {
                    // Gagal mengupdate data
                    $message = 'Terjadi kesalahan saat mengupdate data';
                }
            } else {
                $message = 'File tidak ditemukan.';
            }
        }
    }
    else {
        $result = $listBarang->updateData($data, $filename);
    }
} else {
    // Redirect ke halaman form jika form tidak dikirimkan
    header('location: formBarang.php');

}

// Redirect ke halaman indeks dengan pesan sebagai parameter URL
header('location: index.php?message=' . urlencode($message));


// Tutup koneksi
$listBarang->close();
