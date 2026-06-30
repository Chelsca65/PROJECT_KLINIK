<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Dokter</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter='$kd' "));

if (isset($_POST['tambah'])) {
    $id_dokter = $_POST['id_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $no_hp = $_POST['no_hp'];
    $tarif_konsultasi = $_POST['tarif_konsultasi'];

    $insert = mysqli_query($koneksi, "UPDATE dokter SET nama_dokter='$nama_dokter', spesialis='$spesialis', no_hp='$no_hp', tarif_konsultasi='$tarif_konsultasi' WHERE id_dokter='$id_dokter' ");
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
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_dokter">ID Dokter</label>
                            <input type="text" name="id_dokter" value="<?= $edit['id_dokter']; ?>" placeholder="Id Kat" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_dokter">Nama Dokter</label>
                            <input type="text" name="nama_dokter" id="nama_dokter" value="<?= $edit['nama_dokter']; ?>" placeholder="Masukkan Nama Dokter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="spesialis">Spesialis</label>
                            <input type="text" name="spesialis" id="spesialis" value="<?= $edit['spesialis']; ?>" placeholder="Masukkan Spesialis Dokter" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomor Hp</label>
                            <input type="text" name="no_hp" id="no_hp" value="<?= $edit['no_hp']; ?>" placeholder="Masukkan Nomor HP" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tarif_konsultasi">Tarif</label>
                            <input type="text" name="tarif_konsultasi" id="no_hp" value="<?= $edit['tarif_konsultasi']; ?>" placeholder="Masukkan Tarif" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>