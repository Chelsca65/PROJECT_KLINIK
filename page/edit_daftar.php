<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pasien</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, " SELECT pendaftaran.*, pasien.nama_pasien, dokter.nama_dokter, dokter.spesialis, jadwal.hari
        FROM pendaftaran JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien JOIN jadwal ON pendaftaran.id_jadwal = jadwal.id_jadwal
        JOIN dokter ON jadwal.id_dokter = dokter.id_dokter WHERE pendaftaran.id_daftar='$kd' "));

if (isset($_POST['tambah'])) {
    $id_daftar = $_POST['id_daftar'];
    $id_pasien = $_POST['id_pasien'];
    $id_jadwal = $_POST['id_jadwal'];
    $tgl_daftar = $_POST['tgl_daftar'];

    $insert = mysqli_query($koneksi, "UPDATE pendaftaran SET id_pasien ='$id_pasien', id_jadwal ='$id_jadwal', tgl_daftar ='$tgl_daftar'
    WHERE id_daftar ='$id_daftar' ");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=daftar">';
    } else {
        echo 'div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">

                    <div class="form-group"> <label>ID Daftar</label>
                        <input type="text" name="id_daftar" value="<?= $edit['id_daftar']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <select name="id_pasien" class="form-control" required>

                            <option disabled>-- Pilih Pasien --</option>

                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                            while ($p = mysqli_fetch_assoc($pasien)) {
                                $selected = ($p['id_pasien'] == $edit['id_pasien']) ? "selected" : "";
                                echo "<option value='{$p['id_pasien']}' $selected>
                                        {$p['nama_pasien']}
                                    </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group"> <label>Jadwal</label>
                        <select name="id_jadwal" class="form-control" required>

                            <option disabled>-- Pilih Jadwal --</option>

                            <?php
                            $jadwal = mysqli_query($koneksi, " SELECT jadwal.id_jadwal, dokter.nama_dokter, dokter.spesialis,
                            jadwal.hari,jadwal.jam_praktik FROM jadwal JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
                            ");

                            while ($j = mysqli_fetch_assoc($jadwal)) {
                                $selected = ($j['id_jadwal'] == $edit['id_jadwal']) ? "selected" : "";
                                echo "<option value='{$j['id_jadwal']}' $selected>
                                        {$j['nama_dokter']} - {$j['spesialis']} - {$j['hari']} ({$j['jam_praktik']})
                                    </option>";
                            }
                            ?>

                        </select>
                    </div>

                    <div class="form-group"> <label>Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" value="<?= $edit['tgl_daftar']; ?>" class="form-control">
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary">
                        Update
                    </button>

                </form>
            </div>
        </div>
    </div>
</section>