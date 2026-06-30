<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pasien</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        if ($_SESSION['role'] != "admin") {
            die("Tidak diizinkan");
        }

        $kd = $_GET['kd'];
        mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id_pasien='$kd'");
        mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien='$kd'");

        echo '<div class="alert alert-warning alert-dismissible">
                Berhasil Dihapus
              </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=pasien">';
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <?php if ($_SESSION['role'] == "admin") { ?>
                    <a href="index.php?page=tambah_pasien" class="btn btn-primary btn-sm mb-3">
                        Tambah Pasien </a>
                <?php } ?>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM pasien");
                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_pasien']; ?></td>
                                <td><?= $result['nama_pasien']; ?></td>
                                <td><?= $result['jenkel']; ?></td>
                                <td><?= $result['alamat']; ?></td>
                                <td><?= $result['no_hp']; ?></td>
                                <td>
                                    <?php if ($_SESSION['role'] == "admin") { ?>

                                        <a href="index.php?page=edit_pasien&kd=<?= $result['id_pasien'] ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="index.php?page=pasien&action=hapus&kd=<?= $result['id_pasien'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    <?php } else { ?>
                                        <span class="badge bg-info">Read Only</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>