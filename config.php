<?php

    $db = mysqli_connect("localhost", "root", "", "Perpustakaan");

    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];

        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }


?>