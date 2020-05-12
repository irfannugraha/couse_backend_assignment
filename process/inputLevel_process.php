<?php

    SESSION_START();
    include("../database.php");
    $db = new database();
    
    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";
    $nama_level = $_POST['nama_level'];

    if($id_game && $nama_level){
            $result = $db->execute("INSERT INTO level(
                    id_level,
                    id_game,
                    nama_level
                ) VALUES(
                    null,
                    '".$id_game."',
                    '".$nama_level."'
                )");

            if($result){    $_SESSION["notification"] = "Submit level Berhasil";    }
            else{    $_SESSION["notification"] = "Submit level Gagal";     }
        }
    else
        $_SESSION["notification"] = "Data tidak lengkap";

    header("Location: http://localhost/gameLeaderboard/");

?>