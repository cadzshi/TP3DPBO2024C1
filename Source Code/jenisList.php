<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Jenis.php');
include('classes/Template.php');

$jenis = new Jenis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jenis->open();
$jenis->getJenis();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($jenis->addJenis($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'Jenis.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'Jenis.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Jenis';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Jenis</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Jenis';

while ($div = $jenis->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['jenis_nama'] . '</td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($jenis->updateJenis($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'Jenis.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'Jenis.php';
            </script>";
            }
        }

        $jenis->getJenisById($id);
        $row = $jenis->getResult();

        $dataUpdate = $row['jenis_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($jenis->deleteJenis($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'Jenis.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'Jenis.php';
            </script>";
        }
    }
}

$jenis->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
