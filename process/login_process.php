<?php

    SESSION_START();
    include("../database.php");
    $db = new database();
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $result = $db->get("SELECT email FROM user WHERE email= '".$email."' AND password='".$password."' ");

    if($result)
    {
        $_SESSION['notification'] = "Berhasil Login, Selamat Datang";

        $_SESSION['email'] = $email;;

        header("Location: http://localhost/gameLeaderboard/user/");
    }else{
        $_SESSION['notification'] = "Gagal Login, Coba lagi";
        header("Location: http://localhost/gameLeaderboard/");
    }

?>