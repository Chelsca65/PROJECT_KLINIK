<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pasien</title>

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">

    <div class="login-logo">
        <b>Registrasi</b> Pasien
    </div>

    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Daftar akun pasien baru
            </p>

            <form action="proses_register.php" method="POST">

                <div class="input-group mb-3">
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Username"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Password"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Daftar
                </button>

            </form>

            <br>

            <p class="text-center">
                <a href="../login.php">
                    Kembali ke Login
                </a>
            </p>

        </div>
    </div>

</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>