<?php

include "../config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$id_user = "U-" . rand(100,999);

/* Membuat ID Pasien Otomatis */
$query = mysqli_query($koneksi, "SELECT MAX(id_pasien) as maxid FROM users");
$data = mysqli_fetch_assoc($query);

$urutan = 0;

if($data['maxid'] != ""){
    $urutan = (int) substr($data['maxid'], 2);
}

$urutan++;

$id_pasien = "P-" . str_pad($urutan, 3, "0", STR_PAD_LEFT);

/* Simpan Data */
$simpan = mysqli_query($koneksi,"
INSERT INTO users
(id_user,id_pasien,username,password,role)
VALUES
('$id_user','$id_pasien','$username','$password','pasien')
");

if($simpan){
    echo "
    <script>
        alert('Registrasi Berhasil');
        window.location='../login.php';
    </script>
    ";
}else{
    echo "
    <script>
        alert('Registrasi Gagal');
        history.back();
    </script>
    ";
}

?>