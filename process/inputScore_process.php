<?php

    SESSION_START();
    include("../database.php");
    $db = new database();
    
    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
    $id_level = $_POST['level'];
    $score = $_POST['score'];
    
    if($email && $id_level && $score){
            $result = $db->execute("INSERT INTO score(
                    id_score,
                    id_user,
                    id_level,
                    input_date,
                    score
                ) VALUES(
                    null,
                    ( SELECT id_user FROM user WHERE email = '". $email ."' ),
                    '".$id_level."',
                    null,
                    '".$score."'
                )");

            if($result){    $_SESSION["notification"] = "Submit score User Berhasil";    }
            else{    $_SESSION["notification"] = "Submit score User Gagal";     }
        }
    else
        $_SESSION["notification"] = "Data tidak lengkap";

    header("Location: http://localhost/gameLeaderboard/");

?>