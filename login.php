<?php
session_start();

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

require 'config.php';

if( isset($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");

    // cek username
    if ( mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            // session
            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPUSTAKA | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="text-center">
        <img src="assets/dist/img/AdminLTELogo.png" style="width: 100px;" alt="img">
    </div>
    <br>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>SIPUSTAKA</b></a>
            </div>
            <div class="card-body">
                
                <?php if( isset($error) ) : ?>
                    <p class="login-box-msg" style="color: red;">Username atau Password salah!</p>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="username" class="form-control" placeholder="Username" name="username" value="" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-5">
                            <button type="submit" name="login" class="btn btn-primary btn-block text-center">LOGIN</button>
                        </div>
                    </div>
                </form>
                <br>
                <p class="mb-0">
                    <p>Belum punya akun? <a href="registrasi.php" class="text-center">Registrasi</a></p>
                </p>
            </div>
        </div>
        <!-- /.card -->
    </div>
<!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>