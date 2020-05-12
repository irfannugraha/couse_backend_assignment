<?php
    SESSION_START();
    include("../database.php");
    $db = new Database();

    $email = (isset($_SESSION['email'])) ? $_SESSION['email'] : "";

    if($email)
    {
        $result = $db->execute("SELECT * FROM user WHERE email = '".$email."' ");

        if(!$result)
        {
            header("Location: http://localhost/gameLeaderboard/");
        }
        
        $userdata = $db->get("SELECT user.email as email,
                            user.nama_user as nama_user
                            from user WHERE user.email = '".$email."' ");

        $userdata = mysqli_fetch_assoc($userdata);
    }
    else
    {
        header("Location: http://localhost/gameLeaderboard/");
    }

    $notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

    if($notification)
    {
        echo $notification;
        unset($_SESSION['notification']);
    }
?>

<div>PAGE : HOME</div>
<table border=1>
   <tr>
       <td>MENU</td>
       <td><a href="http://localhost/gameLeaderboard/user/">HOME</a></td>
       <td><a href="http://localhost/gameLeaderboard/user/yourscore.php">YOUR SCORE</a></td>       
       <td><a href="http://localhost/gameLeaderboard/user/leaderboard.php">LEADERBOARD</a></td>
       <td><a href="http://localhost/gameLeaderboard/user/submit.php">SUBMIT</a></td>
       <td><a href="http://localhost/gameLeaderboard/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<table border=1>
    <td align="center" colspan=5>PROFIL</td>
    <tr><td>email</td><td colspan=4><?php echo $userdata['email'];?></td></tr>
    <tr><td>Nama</td><td colspan=4><?php echo $userdata['nama_user'];?></td></tr>
</table>