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

        $statisticdata = $db->get("SELECT 
                game.nama_game as nama_game,
                level.nama_level as nama_level, 
                score.score as score,
                score.input_date as input_date
            FROM score, game, level, user
            WHERE 
                level.id_game = game.id_game
                AND score.id_level = level.id_level
                AND score.id_user = user.id_user
                AND user.email = '".$email."'
            ORDER BY input_date DESC
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

PAGE : YOUR SCORE
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
   <tr><td align="center" colspan=5>USER YOUR SCORE SKOR GAME</td></tr>
   <tr><td>GAME</td><td>NAMA LEVEL</td><td>SCORE</td><td>SUBMIT DATE</td></tr>
   <?php
       while($row = mysqli_fetch_assoc($statisticdata))
       {
           ?>
           <tr>
               <td><?php echo $row['nama_game']?></td>
               <td><?php echo $row['nama_level']?></td>
               <td><?php echo $row['score']?></td>
               <td><?php echo $row['input_date']?></td>
           </tr>
           <?php
       }
   ?>
</table>