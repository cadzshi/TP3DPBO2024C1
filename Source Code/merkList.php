<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Merk.php');
include('classes/Template.php');

$merk = new Merk($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$merk->open();
$merk->getMerk();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($merk->addMerk($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'Merk.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'Merk.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Merk';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Merk</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Merk';

while ($div = $merk->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['merk_nama'] . '</td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($merk->updateMerk($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'Merk.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'Merk.php';
            </script>";
            }
        }

        $merk->getMerkById($id);
        $row = $merk->getResult();

        $dataUpdate = $row['merk_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($merk->deleteMerk($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'Merk.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'Merk.php';
            </script>";
        }
    }
}

$merk->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
