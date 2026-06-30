<?php
require_once("config/koneksi.php");
?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Jadwal</h1>
    </div>
</div>

<?php
// KODE OTOMATIS
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal");
$datakode = mysqli_fetch_array($carikode);

if ($datakode[0]) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "J-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "J-001";
}

$_SESSION['KODE'] = $hasilkode;

// SIMPAN DATA
if (isset($_POST['tambah'])) {

    $id_jadwal = $_POST['id_jadwal'];
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_praktik = $_POST['jam_praktik'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO jadwal (id_jadwal, id_dokter, hari, jam_praktik)
        VALUES ('$id_jadwal', '$id_dokter', '$hari', '$jam_praktik')
    ");

    if($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=dokter">';
    } else {
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal menyimpan sebagian atau seluruh data. </h4></div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST">

                    <!-- ID JADWAL -->
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" name="id_jadwal" value="<?= $hasilkode; ?>" class="form-control" readonly>
                    </div>

                    <!-- DOKTER -->
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <select name="id_dokter" class="form-control" required>
                            <option disabled selected>-- Pilih Dokter --</option>

                            <?php
                            $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                            while ($d = mysqli_fetch_assoc($dokter)) {
                                echo "<option value='{$d['id_dokter']}'>{$d['nama_dokter']} - {$d['spesialis']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- HARI -->
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                            <option disabled selected>-- Pilih Hari --</option>
                            <option>Senin</option>
                            <option>Selasa</option>
                            <option>Rabu</option>
                            <option>Kamis</option>
                            <option>Jumat</option>
                            <option>Sabtu</option>
                        </select>
                    </div>

                    <!-- JAM -->
                    <div class="form-group">
                        <label>Jam Praktik</label>
                        <select name="jam_praktik" class="form-control" required>
                            <option disabled selected>-- Pilih Jam --</option>
                            <option>08.00-10.00</option>
                            <option>10.00-12.00</option>
                            <option>12.00-14.00</option>
                            <option>14.00-16.00</option>
                            <option>16.00-18.00</option>
                            <option>19.00-21.00</option>
                        </select>
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary">
                        Simpan
                    </button>

                </form>

            </div>
        </div>
    </div>
</section>