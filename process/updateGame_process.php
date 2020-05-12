<?php

    SESSION_START();
    include("../database.php");
    $db = new database();
    
    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";
    $nama_game = $_POST['nama_game'];
    $start_submit = $_POST['start_submit'];
    $last_submit = $_POST['last_submit'];

    if($id_game && $nama_game && $start_submit && $last_submit){
            $result = $db->execute("UPDATE game SET 
                        nama_game = '".$nama_game."',
                        start_submit = '".$start_submit."',
                        last_submit = '".$last_submit."'
                    WHERE id_game = '".$id_game."'
                ;");

            if($result){    $_SESSION["notification"] = "Update Game Berhasil";    }
            else{    $_SESSION["notification"] = "Update Game Gagal";     }
        }
    else
        $_SESSION["notification"] = "Data tidak lengkap";

    header("Location: http://localhost/gameLeaderboard/");

?>