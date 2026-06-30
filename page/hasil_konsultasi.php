<?php
require_once "config/koneksi.php";

$query = mysqli_query($koneksi, "
SELECT DISTINCT
    p.id_daftar,
    p.id_pasien,
    p.tgl_daftar,
    ps.nama_pasien,
    d.nama_dokter
FROM konsultasi k
JOIN pendaftaran p ON k.id_daftar = p.id_daftar
JOIN pasien ps ON p.id_pasien = ps.id_pasien
JOIN jadwal j ON p.id_jadwal = j.id_jadwal
JOIN dokter d ON j.id_dokter = d.id_dokter
ORDER BY p.tgl_daftar DESC
");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Hasil Konsultasi</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>ID Daftar</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>

                    <?php
                    $no = 1;
                    while ($d = mysqli_fetch_assoc($query)) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['id_daftar']; ?></td>
                                <td><?= $d['nama_pasien']; ?></td>
                                <td><?= $d['nama_dokter']; ?></td>
                                <td><?= $d['tgl_daftar']; ?></td>
                                <td>
                                    <a href="index.php?page=lihat_konsultasi&id=<?= $d['id_daftar']; ?>"
                                        class="btn btn-info btn-sm">
                                        Lihat
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>