<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Jadwal</h1>
    </div>
</div>

<?php
$kd = $_GET['kd'];

// ambil data jadwal
$edit = mysqli_fetch_array(mysqli_query($koneksi, "
SELECT * FROM jadwal WHERE id_jadwal='$kd'
"));

if (isset($_POST['edit'])) {

    $id_jadwal = $_POST['id_jadwal'];
    $id_dokter = $_POST['id_dokter'];
    $hari = $_POST['hari'];
    $jam_praktik = $_POST['jam_praktik'];

    $insert = mysqli_query($koneksi, " UPDATE jadwal SET id_dokter='$id_dokter', hari='$hari', 
    jam_praktik='$jam_praktik' WHERE id_jadwal='$id_jadwal'");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=dokter">';
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

                    <!-- ID JADWAL -->
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" name="id_jadwal"
                            value="<?= $edit['id_jadwal']; ?>"
                            class="form-control" readonly>
                    </div>

                    <!-- DOKTER -->
                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <select name="id_dokter" class="form-control" required>

                            <option disabled>-- Pilih Dokter --</option>

                            <?php
                            $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");

                            while ($d = mysqli_fetch_assoc($dokter)) {

                                $selected = ($d['id_dokter'] == $edit['id_dokter']) ? "selected" : "";

                                echo "<option value='{$d['id_dokter']}' $selected>
                        {$d['nama_dokter']} - {$d['spesialis']}
                      </option>";
                            }
                            ?>

                        </select>
                    </div>

                    <!-- HARI -->
                    <div class="form-group">
                        <label>Hari</label>
                        <select name="hari" class="form-control" required>
                            <option disabled>-- Pilih Hari --</option>
                            <option <?= ($edit['hari'] == "Senin") ? "selected" : ""; ?>>Senin</option>
                            <option <?= ($edit['hari'] == "Selasa") ? "selected" : ""; ?>>Selasa</option>
                            <option <?= ($edit['hari'] == "Rabu") ? "selected" : ""; ?>>Rabu</option>
                            <option <?= ($edit['hari'] == "Kamis") ? "selected" : ""; ?>>Kamis</option>
                            <option <?= ($edit['hari'] == "Jumat") ? "selected" : ""; ?>>Jumat</option>
                            <option <?= ($edit['hari'] == "Sabtu") ? "selected" : ""; ?>>Sabtu</option>
                        </select>
                    </div>

                    <!-- JAM PRAKTIK -->
                    <div class="form-group">
                        <label>Jam Praktik</label>
                        <select name="jam_praktik" class="form-control" required>
                            <option disabled>-- Pilih Jam --</option>
                            <option <?= ($edit['jam_praktik'] == "08.00-10.00") ? "selected" : ""; ?>>08.00-10.00</option>
                            <option <?= ($edit['jam_praktik'] == "10.00-12.00") ? "selected" : ""; ?>>10.00-12.00</option>
                            <option <?= ($edit['jam_praktik'] == "12.00-14.00") ? "selected" : ""; ?>>12.00-14.00</option>
                            <option <?= ($edit['jam_praktik'] == "14.00-16.00") ? "selected" : ""; ?>>14.00-16.00</option>
                            <option <?= ($edit['jam_praktik'] == "16.00-18.00") ? "selected" : ""; ?>>16.00-18.00</option>
                            <option <?= ($edit['jam_praktik'] == "19.00-21.00") ? "selected" : ""; ?>>19.00-21.00</option>
                        </select>
                    </div>

                    <button type="submit" name="edit" class="btn btn-primary">
                        Update
                    </button>

                </form>

            </div>
        </div>
    </div>
</section>