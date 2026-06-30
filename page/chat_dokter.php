<?php
require_once "config/koneksi.php";

$id_daftar = $_GET['id'];

$query = mysqli_query($koneksi, " SELECT * FROM konsultasi WHERE id_daftar='$id_daftar' ORDER BY waktu ASC ");
?>

<div class="card">

    <div class="card-header">
        <h3>Chat Pasien</h3>
    </div>

    <div class="card-body">

        <?php while ($c = mysqli_fetch_assoc($query)) { ?>
            <?php if ($c['pengirim'] == "pasien") { ?>
                <div class="mb-3">
                    <b>Pasien</b><br>
                    <?= nl2br($c['pesan']); ?>
                    <br>
                    <small><?= $c['waktu']; ?></small>
                </div>

            <?php } else { ?>
                <div class="mb-3">
                    <b>Dokter</b><br>
                    <?= nl2br($c['pesan']); ?>
                    <br>
                    <small><?= $c['waktu']; ?></small>
                </div>  
            <?php } ?>
        <?php } ?>

        <form method="POST" action="page/proses_chat_dokter.php">

            <input type="hidden"
                name="id_daftar"
                value="<?= $id_daftar; ?>">

            <textarea
                name="pesan"
                class="form-control"
                required placeholder="Tulis Pesan..."></textarea>

            <br>

            <button class="btn btn-primary">
                Balas
            </button>

        </form>
    </div>
</div>