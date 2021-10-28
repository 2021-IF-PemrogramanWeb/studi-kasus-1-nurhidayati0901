<?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username === "nurhidayati" && $password == "123456"){
        echo "LOGIN BERHASIL";
    }
    else {
        echo "Username atau Password Anda salah";
    }
?>