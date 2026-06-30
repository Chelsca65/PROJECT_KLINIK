<?php
require_once "config/koneksi.php";
?>

<?php

if (isset($_POST['tambah'])) {
    $nama_pasien = $_POST['nama_pasien'];
    $jenkel = $_POST['jenkel'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $tgl_daftar = $_POST['tgl_daftar'];
    $id_jadwal = $_POST['id_jadwal'];

    $carikode = mysqli_query($koneksi, "select max(id_pasien) from pasien") or die(mysqli_error($koneksi));
    $datakode = mysqli_fetch_array($carikode);
    if ($datakode) {
        $nilaikode = substr($datakode[0], 2);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
    } else {
        $kode = "1";
    }
    $id_pasien = "P-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
    $_SESSION["KODE"] = $id_pasien;

    // simpan pasien
    $pasien = mysqli_query($koneksi, "INSERT INTO pasien SET
        id_pasien='$id_pasien',
        nama_pasien='$nama_pasien',
        jenkel='$jenkel',
        alamat='$alamat',
        no_hp='$no_hp'
    ");

    if (!$pasien) {
        die("Error pasien: " . mysqli_error($koneksi));
    }

    if ($pasien) {
        $carikode = mysqli_query($koneksi, "select max(id_daftar) from pendaftaran") or die(mysqli_error($koneksi));
        $datakode = mysqli_fetch_array($carikode);
        if ($datakode) {
            $nilaikode = substr($datakode[0], 2);
            $kode = (int) $nilaikode;
            $kode = $kode + 1;
            $id_daftar = "D-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
        } else {
            $id_daftar = "D-001";
        }

        $_SESSION["KODE"] = $id_pasien;
        $insert = mysqli_query($koneksi, "INSERT INTO pendaftaran SET
        id_daftar='$id_daftar',
        id_pasien='$id_pasien',
        id_jadwal='$id_jadwal',
        tgl_daftar='$tgl_daftar'
    ");

        if ($insert) {
            echo "<script>
        window.location.href='index.php?page=form_pembayaran&id=$id_daftar';
    </script>";
            exit;
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible">Gagal simpan pendaftaran</div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Form Pendaftaran Pasien</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-body p-2">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama_pasien">Nama Pasien</label>
                        <input type="text" name="nama_pasien" id="nama_pasien" placeholder="Masukkan Nama Anda" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select name="jenkel" id="jenkel" class="form-control" required>
                            <option value="" disabled selected>--Pilih Jenis Kelamin--</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_daftar">Tanggal Daftar</label>
                        <input type="date" name="tgl_daftar" id="tgl_daftar" placeholder="Masukkan Tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">alamat</label>
                        <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan Nomor Hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_jadwal">Nama Dokter</label>
                        <select name="id_jadwal" id="id_jadwal" class="form-control" required>

                            <option selected disabled>--Pilih Dokter--</option>

                            <?php
                            $jadwal = mysqli_query($koneksi, " SELECT 
                            jadwal.id_jadwal, jadwal.hari, jadwal.jam_praktik,
                            dokter.nama_dokter, dokter.spesialis FROM jadwal
                            JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
                            ");

                            while ($d = mysqli_fetch_assoc($jadwal)) {
                                echo "<option value='{$d['id_jadwal']}'>
                    {$d['nama_dokter']} - {$d['spesialis']} - {$d['hari']} ({$d['jam_praktik']})
                  </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Daftar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</table>
</div>
</div>
</div>
</div>