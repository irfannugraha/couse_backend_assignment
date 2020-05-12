<?php
    SESSION_START();
    include("../database.php");
    $db = new Database();

    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($id_game)
    {

        $statisticdata = $db->get("SELECT 
                level.nama_level as nama_level,
                user.nama_user as nama_user,
                score.score as score,
                score.input_date as input_date
            FROM score, game, level, user
            WHERE 
                user.id_user = score.id_user
                AND score.id_level = level.id_level
                AND level.id_game = ".$id_game."
            GROUP BY score.id_score
            ");

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

PAGE : USER SCORE
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
   <tr><td align="center" colspan=5>USER SCORE</td></tr>
   <tr><td>NAMA LEVEL</td><td>NAMA USER</td><td>SCORE</td><td>SUBMIT DATE</td></tr>
   <?php
       while($row = mysqli_fetch_assoc($statisticdata))
       {
           ?>
           <tr>
               <td><?php echo $row['nama_level']?></td>
               <td><?php echo $row['nama_user']?></td>
               <td><?php echo $row['score']?></td>
               <td><?php echo $row['input_date']?></td>
           </tr>
           <?php
       }
   ?>
</table>