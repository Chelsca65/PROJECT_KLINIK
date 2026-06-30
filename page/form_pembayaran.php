<?php
require_once "config/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID Pendaftaran tidak ditemukan");
}

$id_daftar = $_GET['id'];

$query = mysqli_query($koneksi, "
SELECT
    pendaftaran.id_daftar,
    pasien.nama_pasien,
    dokter.nama_dokter,
    dokter.spesialis,
    dokter.tarif_konsultasi
FROM pendaftaran
JOIN pasien ON pendaftaran.id_pasien = pasien.id_pasien
JOIN jadwal ON pendaftaran.id_jadwal = jadwal.id_jadwal
JOIN dokter ON jadwal.id_dokter = dokter.id_dokter
WHERE pendaftaran.id_daftar='$id_daftar'
");

$data = mysqli_fetch_array($query);

if (!$data) {
    die("Data tidak ditemukan");
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Pembayaran</h3>
            </div>

            <form action="index.php?page=proses_bayar" method="POST">

                <div class="card-body">

                    <input type="hidden" name="id_daftar" value="<?= $data['id_daftar']; ?>">

                    <div class="form-group">
                        <label>ID Daftar</label>
                        <input type="text"
                            class="form-control"
                            value="<?= $data['id_daftar']; ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text"
                            class="form-control"
                            value="<?= $data['nama_pasien']; ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Dokter</label>
                        <input type="text"
                            class="form-control"
                            value="<?= $data['nama_dokter']; ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Spesialis</label>
                        <input type="text"
                            class="form-control"
                            value="<?= $data['spesialis']; ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Total Bayar</label>
                        <input type="text"
                            class="form-control"
                            value="Rp <?= number_format((float)$data['tarif_konsultasi'], 0, ',', '.'); ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select name="metode_bayar" class="form-control" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="QRIS">QRIS</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <input type="text"
                            class="form-control"
                            value="Belum Bayar"
                            readonly>
                    </div>

                    <div class="alert alert-info">
                        Setelah menekan tombol <b>Bayar</b>, status pembayaran akan berubah menjadi
                        <b>Menunggu Verifikasi</b>. Anda dapat melakukan konsultasi setelah pembayaran
                        diverifikasi oleh admin.
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        Bayar
                    </button>

                    <a href="index.php?page=proses_daftar"
                        class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>