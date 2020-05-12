<?php
    SESSION_START();
    include("database.php");
    $db = new database();
    
    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";
    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($email)
    {
        $result = $db->execute("SELECT * FROM user WHERE email = '".$email."' ");
        if($result)
        {
            header("Location: http://localhost/gameLeaderboard/user");
        }
    }elseif ($id_game) {
        $result = $db->execute("SELECT * FROM game WHERE id_game = '".$id_game."' ");
        if($result)
        {
            header("Location: http://localhost/gameLeaderboard/game");
        }
    }

    $notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
    if($notification){
        echo $notification;
        unset($_SESSION['notification']);
    }

?>

<div>PAGE : LOGIN</div>
<form action="process/login_process.php" method="POST">
<table>
   <tr>
       <td>email</td>
       <td>:</td>
       <td><input type="email" name="email" required></td>
   </tr>
   <tr>
       <td>password</td>
       <td>:</td>
       <td><input type="password" name="password" required></td>
   </tr>
   <tr>
       <td colspan=3><input type="submit" value="LOGIN"></td>
   </tr>
   </form>
   <tr>
   <td colspan=3><button><a href="gameLogin.php">KELOLA GAME</a></button></td>
   </tr>
   <tr>
       <td colspan=3><button><a href="register.php">REGISTER</a></button></td>
   </tr>
</table>