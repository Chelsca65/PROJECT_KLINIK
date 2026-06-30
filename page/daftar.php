<?php
require_once "config/koneksi.php";

$id_dokter = $_SESSION['id_dokter'];
?>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Pasien</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];

        // Ambil id_pasien dari pendaftaran
        $data = mysqli_fetch_array(mysqli_query( $koneksi, "SELECT id_pasien FROM pendaftaran WHERE id_daftar='$kd'"));
        $id_pasien = $data['id_pasien'];
        mysqli_query($koneksi, "DELETE FROM pendaftaran WHERE id_daftar='$kd'");
        mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien='$id_pasien'");

        echo '
        <div class="alert alert-warning alert-dismissible">
            Berhasil Dihapus
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=daftar">';
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Daftar</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>jadwal</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = $query = mysqli_query($koneksi," SELECT pendaftaran.id_daftar, pendaftaran.tgl_daftar, pasien.nama_pasien,
                    dokter.nama_dokter, dokter.spesialis, jadwal.hari, jadwal.jam_praktik, pembayaran.status_bayar
                    FROM pendaftaran
                    JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien
                    JOIN jadwal ON pendaftaran.id_jadwal = jadwal.id_jadwal
                    JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
                    LEFT JOIN pembayaran ON pendaftaran.id_daftar = pembayaran.id_daftar
                    WHERE ('$_SESSION[role]'='admin' OR dokter.id_dokter='$id_dokter')
                    ORDER BY pendaftaran.id_daftar ASC
                    ");

                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_daftar']; ?></td>
                                <td><?= $result['nama_pasien']; ?></td>
                                <td><?= $result['nama_dokter']; ?></td>
                                <td><?= $result['spesialis']; ?></td>
                                <td><?= $result['hari']; ?>, <?= $result['jam_praktik']; ?></td>
                                <td><?= $result['tgl_daftar']; ?></td>
                                <td>
                                    <?php
                                    if (empty($result['status_bayar'])) {
                                        echo 'Belum Bayar';
                                    } else {
                                        echo 'Lunas';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($_SESSION['role'] == "admin") { ?>
                                        <a href="index.php?page=edit_daftar&kd=<?= $result['id_daftar'] ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="index.php?page=daftar&action=hapus&kd=<?= $result['id_daftar'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>

                                        <?php } else { ?>
                                            <span class="badge bg-info">Read Only</span>
                                        <?php } ?>
                                        </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>