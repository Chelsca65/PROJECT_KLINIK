<?php
require_once "config/koneksi.php";

if (isset($_GET['action']) && $_GET['action'] == 'verifikasi') {

    $id_daftar = $_GET['id'];

    mysqli_query($koneksi, "
    UPDATE pembayaran
    SET status_bayar='Lunas'
    WHERE id_daftar='$id_daftar'
    ");

    echo "<script>
    alert('Pembayaran berhasil diverifikasi');
    window.location='index.php?page=pembayaran';
    </script>";
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Pembayaran</h1>
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
                            <th>Nama Pasien</th>
                            <th>Tanggal Bayar</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "
                SELECT pembayaran.*,
                       pendaftaran.id_daftar,
                       pasien.nama_pasien,
                       dokter.tarif_konsultasi,
                       pembayaran.tgl_bayar
                FROM pembayaran
                JOIN pendaftaran ON pembayaran.id_daftar = pendaftaran.id_daftar
                JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien
                JOIN jadwal ON pendaftaran.id_jadwal = jadwal.id_jadwal
                JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
                ORDER BY pendaftaran.id_daftar ASC
            ") or die(mysqli_error($koneksi));

                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['id_daftar']; ?></td>
                                <td><?= $result['nama_pasien']; ?></td>
                                <td><?= $result['tgl_bayar']; ?></td>
                                <td>
                                    Rp <?= number_format((float)$result['tarif_konsultasi'], 0, ',', '.'); ?>
                                </td>

                                <td>
                                    <?php
                                    if ($result['status_bayar'] == "Belum Bayar") {
                                        echo "<span class='badge badge-danger'>Belum Bayar</span>";
                                    } elseif ($result['status_bayar'] == "Menunggu Verifikasi") {
                                        echo "<span class='badge badge-warning'>Menunggu Verifikasi</span>";
                                    } elseif ($result['status_bayar'] == "Lunas") {
                                        echo "<span class='badge badge-success'>Lunas</span>";
                                    }
                                    ?>
                                </td>

                                <td>

                                    <?php
                                    if ($result['status_bayar'] == "Belum Bayar") {
                                    ?>

                                        <span class="badge badge-warning">
                                            Menunggu Pembayaran
                                        </span>

                                    <?php
                                    } elseif ($result['status_bayar'] == "Menunggu Verifikasi") {
                                    ?>

                                        <a href="index.php?page=pembayaran&action=verifikasi&id=<?= $result['id_daftar']; ?>"
                                            class="badge badge-info btn-sm"
                                            onclick="return confirm('Verifikasi pembayaran ini?')">
                                            Verifikasi
                                        </a>

                                    <?php
                                    } else {
                                    ?>

                                        <span class="badge badge-success">
                                            Sudah Diverifikasi
                                        </span>

                                    <?php
                                    }
                                    ?>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>
                </table>
            </div>
        </div>
    </div>