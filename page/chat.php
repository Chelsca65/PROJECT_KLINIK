<?php
require_once "config/koneksi.php";

$id_pasien = $_SESSION['id_pasien'];
$id_daftar = $_GET['id_daftar'];

$query = mysqli_query($koneksi," SELECT * FROM konsultasi WHERE id_daftar='$id_daftar' ORDER BY waktu ASC ");
?>

<div class="card">
    <div class="card-header">
        <h3>Chat Konsultasi</h3>
    </div>

    <div class="card-body">

        <!-- CHAT LIST -->
        <?php while($d = mysqli_fetch_assoc($query)) { ?>

            <div class="mb-3">

                <b>
                    <?= ucfirst($d['pengirim']); ?>
                </b>

                <br>

                <?= nl2br($d['pesan']); ?>

                <br>

                <small class="text-muted">
                    <?= $d['waktu']; ?>
                </small>

                <hr>

            </div>

        <?php } ?>

        <!-- FORM CHAT -->
        <form method="POST" action="page/proses_chat.php">

            <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
            <input type="hidden" name="id_daftar" value="<?= $id_daftar; ?>">

            <textarea
                name="pesan"
                class="form-control"
                required
                placeholder="Tulis pesan..."></textarea>

            <br>

            <button class="btn btn-primary">
                Kirim
            </button>

        </form>

    </div>
</div>