<?php
    SESSION_START();
    include("../database.php");
    $db = new Database();

    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($id_game)
    {
        $gamedata = $db->get("SELECT 
                game.nama_game AS nama_game,
                game.start_submit AS start_submit,
                game.last_submit AS last_submit
            from game
            WHERE 
                game.id_game = '".$id_game."' ");

        $gamedata = mysqli_fetch_assoc($gamedata);
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
       <td><a href="http://localhost/gameLeaderboard/game/">HOME</a></td>
       <td><a href="http://localhost/gameLeaderboard/game/userscore.php">USER SCORE</a></td>       
       <td><a href="http://localhost/gameLeaderboard/game/highestscore.php">HIGHEST SCORE</a></td>
       <td><a href="http://localhost/gameLeaderboard/game/level.php">LEVEL</a></td>
       <td><a href="http://localhost/gameLeaderboard/user/logout.php">LOGOUT</a></td>
   </tr>
</table>
<table border=1>
    <td align="center" colspan=6>Profile</td>
    <form action="../process/updateGame_process.php" method="POST">
        <tr><td>Nama</td><td colspan=4><input type="text" name="nama_game" value="<?php echo $gamedata['nama_game'];?>" required></td></tr>
        <tr><td>Mulai Kirim Score</td><td colspan=4><input type="text" name="start_submit" value="<?php echo $gamedata['start_submit'];?>" required></td></tr>
        <tr><td>Terakhir Kirim Score</td><td colspan=4><input type="text" name="last_submit" value="<?php echo $gamedata['last_submit'];?>" required></td></tr>
        <tr><td>Bisa Mengirim Score</td><td colspan=4>
            <?php 
                if ($gamedata['start_submit'] < date("Y-m-d H:i:s") and date("Y-m-d H:i:s") < $gamedata['last_submit']) {
                    echo "Bisa";
                }else
                    echo "Tidak";
            ?>
        </td></tr>
</table>
        <td colspan=3><input type="submit" value="UPDATE"></td>
    </form>