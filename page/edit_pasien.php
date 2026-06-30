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
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$kd' "));

if (isset($_POST['tambah'])) {
    $id_pasien = $_POST['id_pasien'];
    $nama_pasien = $_POST['nama_pasien'];
    $jenkel = $_POST['jenkel'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $insert = mysqli_query($koneksi, "UPDATE pasien SET nama_pasien='$nama_pasien', jenkel='$jenkel', alamat='$alamat', no_hp='$no_hp' WHERE id_pasien='$id_pasien' ");
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" contents="1;url=index.php?page=pasien">';
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
                            <label for="id_pasien">ID Pasien</label>
                            <input type="text" name="id_pasien" value="<?= $edit['id_pasien']; ?>" placeholder="Masukkan ID pasien" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" name="nama_pasien" id="nama_pasien" value="<?= $edit['nama_pasien']; ?>" placeholder="Nama Siswa" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="jenkel">jenis kelamin</label>
                            <input type="text" name="jenkel" id="jenkel" value="<?= $edit['jenkel']; ?>" placeholder="jenis kelamin" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="<?= $edit['alamat']; ?>" placeholder="Hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="text" name="no_hp" id="no_hp" value="<?= $edit['no_hp']; ?>" placeholder="Hp" class="form-control">
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