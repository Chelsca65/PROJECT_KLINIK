<?php
session_start();
require_once "../config/koneksi.php";

$id_pasien = $_POST['id_pasien'];
$id_daftar = $_POST['id_daftar'];
$pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

$sql = "INSERT INTO konsultasi
(id_daftar,id_pasien,pengirim,pesan,waktu)
VALUES
('$id_daftar','$id_pasien','pasien','$pesan',NOW())";

if (mysqli_query($koneksi, $sql)) {
    header("Location: ../index.php?page=chat&id_daftar=$id_daftar");
    exit;
} else {
    echo "Error: " . mysqli_error($koneksi);
}
