<?php
session_start();
require_once "../config/koneksi.php";

$id_daftar = $_POST['id_daftar'];
$id_pasien = $_POST['id_pasien'];
$pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

mysqli_query($koneksi, "
INSERT INTO konsultasi
(id_daftar,id_pasien,pengirim,pesan,waktu)
VALUES
('$id_daftar','$id_pasien','dokter','$pesan',NOW())
") or die(mysqli_error($koneksi));

header("Location: ../index.php?page=chat_dokter&id=" . $id_daftar);
exit;
