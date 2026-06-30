<?php
require_once "config/koneksi.php";

if (isset($_POST['id_daftar']) && isset($_POST['metode_bayar'])) {

    $id_daftar = $_POST['id_daftar'];
    $metode_bayar = $_POST['metode_bayar'];
    $tgl_bayar = date('Y-m-d');

    $query = mysqli_query($koneksi, "
        INSERT INTO pembayaran (id_daftar, tgl_bayar, metode_bayar, status_bayar)
        VALUES ('$id_daftar', '$tgl_bayar', '$metode_bayar', 'Menunggu Verifikasi')
    ");

    if ($query) {
        echo "<script>
        alert('Pembayaran berhasil. Menunggu verifikasi admin.');
        window.location='index.php?page=proses_daftar';
        </script>";
    } else {
        die("Error: " . mysqli_error($koneksi));
    }

} else {
    echo "<script>
            alert('Data tidak lengkap.');
            history.back();
          </script>";
}
?>