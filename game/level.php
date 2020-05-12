<?php
    SESSION_START();
    include("../database.php");
    $db = new Database();

    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($id_game)
    {
        $leveldata = $db->get("SELECT 
                level.id_level AS id_level,
                level.nama_level AS nama_level
            from level
            WHERE 
                level.id_game = '".$id_game."' ");
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

<div>PAGE : LEVEL</div>
<table border=1>
   <tr>
       <td>MENU</td>
       <td><a href="http://localhost/gameLeaderboard/game/">HOME</a></td>
       <td><a href="http://localhost/gameLeaderboard/game/userscore.php">USER SCORE</a></td>       
       <td><a href="http://localhost/gameLeaderboard/game/highestscore.php">HIGHEST SCORE</a></td>
       <td><a href="http://localhost/gameLeaderboard/game/level.php">LEVEL</a></td>
       <td><a href="http://localhost/gameLeaderboard/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<table border=1>
        <tr><td>NO</td><td>NAMA</td></tr>
        <?php
            if ($leveldata) {
                foreach ($leveldata as $key => $leveldata) {
                    echo "
                        <tr>
                            <td>". ($key+1) ."</td>
                            <td>". $leveldata['nama_level'] ."</td>
                        </tr>
                    ";
                }
            }
        ?>
</table>

<br>
<form action="../process/inputLevel_process.php" method="POST">
    <table>
        <tr>
            <td>Nama Level</td><td>:</td><td><input type="text" name="nama_level" required></td>
        </tr> 
        <tr>
            <td colspan=3><input type="submit" value="TAMBAH"></td>
        </tr>      
    </table>
</form>