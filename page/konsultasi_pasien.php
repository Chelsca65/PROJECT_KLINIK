<?php
require_once "config/koneksi.php";

$id_pasien = $_SESSION['id_pasien'];

$query = mysqli_query($koneksi, "
SELECT
    p.id_daftar,
    p.tgl_daftar,
    d.nama_dokter,
    pb.status_bayar
FROM pendaftaran p
JOIN jadwal j ON p.id_jadwal = j.id_jadwal
JOIN dokter d ON j.id_dokter = d.id_dokter
LEFT JOIN pembayaran pb ON p.id_daftar = pb.id_daftar
WHERE p.id_pasien='$id_pasien'
")
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Konsultasi</h1>
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
                            <th>Tanggal</th>
                            <th>Dokter</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>

                    <tbody>

                        <?php
                        $no = 1;
                        while ($d = mysqli_fetch_assoc($query)) {
                        ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['tgl_daftar']; ?></td>
                                <td><?= $d['nama_dokter']; ?></td>

                                <td>
                                    <?php
                                    if ($d['status_bayar'] == "Lunas") {
                                        echo "<span class='badge badge-success'>Lunas</span>";
                                    } else {
                                        echo "<span class='badge badge-danger'>Belum Lunas</span>";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php if ($d['status_bayar'] == "Lunas") { ?>
                                        <a href="index.php?page=chat&id_daftar=<?= $d['id_daftar']; ?>" class="btn btn-primary btn-sm">
                                            Chat
                                        </a>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>
    </div>