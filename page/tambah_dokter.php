<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Dokter</h1>
            </div>
        </div>
    </div>
</div>

<?php
//kode otomatis
$carikode = mysqli_query($koneksi, "select max(id_dokter) from dokter") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] !== null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "D-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "D-001";
}
$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {
    $id_dokter = $_POST['id_dokter'];
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $no_hp = $_POST['no_hp'];
    $tarif_konsultasi = $_POST['tarif_konsultasi'];

    // Insert ke tabel dokter
    $insert = mysqli_query($koneksi, "INSERT INTO dokter values ('$id_dokter','$nama_dokter', '$spesialis', '$no_hp','$tarif_konsultasi')");

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
             <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="id_dokter">ID Dokter</label>
                                <input type="text"name="id_dokter" value="<?= $hasilkode; ?>" placeholder="iddokter" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_dokter">Nama Dokter</label>
                                <input type="text" name="nama_dokter" id="nama_dokter" placeholder="Masukkan Nama Dokter" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="spesialis">Spesialis</label>
                                <input type="text" name="spesialis" id="spesialis" placeholder="Masukkan Spesialis Dokter" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan Nomor HP" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tarif_konsultasi">Tarif</label>
                                <input type="text" name="tarif_konsultasi" id="tarif_konsultasi" placeholder="Masukkan Tarif" class="form-control">
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
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