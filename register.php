<?php

    SESSION_START();
    include("database.php");
    $db = new database();

    $notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
    
    if($notification){
        echo $notification;
        unset($_SESSION['notification']);
    }

?>

<div>PAGE : REGISTER</div>
<form action="process/register_process.php" method="POST">
    <table>
        <tr>
            <td>nama</td><td>:</td><td><input type="text" name="nama" required></td>
        </tr>        
        <tr>
            <td>email</td><td>:</td><td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>password</td><td>:</td><td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>password(again)</td><td>:</td><td><input type="password" name="password2" required></td>
        </tr>  
        <tr>
            <td colspan=3><input type="submit" value="REGISTER"></td>
        </tr>      
    </table>
</form>
<button><a href="http://localhost/gameLeaderboard/">BACK TO LOGIN</button>