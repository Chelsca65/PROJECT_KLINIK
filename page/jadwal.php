<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal where id_jadwal = '$kd' ");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil Di Hapus</div>';
            echo '<meta http-equiv="refersh" content=1;url=index.php?page=jadwal">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-3">
                    Tambah Jadwal </a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Jadwal</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Hari</th>
                            <th>Jam Praktik</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, " SELECT jadwal.id_jadwal,jadwal.hari,jadwal.jam_praktik,
                    dokter.nama_dokter,dokter.spesialis FROM jadwal
                    JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
                    ");
                    while ($result = mysqli_fetch_assoc($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_jadwal']; ?></td>
                                <td><?= $result['nama_dokter']; ?></td>
                                <td><?= $result['spesialis']; ?></td>
                                <td><?= $result['hari']; ?></td>
                                <td><?= $result['jam_praktik']; ?></td>
                                <td>
                                    <?php if ($_SESSION['role'] == "admin") { ?>
                                        <a href="index.php?page=edit_jadwal&kd=<?= $result['id_jadwal'] ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?page=jadwal&action=hapus&kd=<?= $result['id_jadwal'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>

                                        <?php } else { ?>
                                            <span class="badge bg-info">Read Only</span>
                                        <?php } ?>
                                        </a>
                                </td>
                            </tr>
                        <?php
                    }
                        ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>