<?php

    SESSION_START();
    include("../database.php");
    $db = new database();

    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);   

    if($password == $password2){
        if($email && $nama && $password && $password2){
                $result = $db->execute("INSERT INTO user(
                                                            nama_user,
                                                            password,
                                                            email
                                                        ) VALUES(
                                                            '".$nama."',
                                                            '".$password."',
                                                            '".$email."'
                                                        )");
                if($result){    $_SESSION["notification"] = "Register User Berhasil";    }
                else{    $_SESSION["notification"] = "Register User Gagal";     }
            }
        else
            $_SESSION["notification"] = "Data tidak lengkap";
    }
    header("Location: http://localhost/gameLeaderboard/");
?>