<?php

    $db = mysqli_connect("localhost", "root", "", "perpustakaan");

    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];

        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }

    function registrasi($data) {
        global $db;

        $user = strtolower(stripslashes($data["username"]));
        $email = $data["email"];
        $pass = mysqli_real_escape_string($db, $data["password"]);
        $re_pass = mysqli_real_escape_string($db, $data["re_password"]);

        // cek username
        $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$user'");
        if( mysqli_fetch_assoc($result) ) {
            echo "<script>
                alert('Username sudah ada, silahkan ganti!');
            </script>";
            return false;
        }

        // konfirm pass
        if( $pass != $re_pass) {
            echo "<script>
                alert('Password tidak sesuai!')
            </script>";
            return false;
        }

        // enkripsi pass
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        
        // tambah user ke db
        mysqli_query($db, "INSERT INTO users VALUES('', '$user', '$email', '$pass')");

        return mysqli_affected_rows($db);
    }

?>