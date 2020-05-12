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

        if (!$_GET) {
            $_GET['id_game'] = 1;
        }

        $gamedata = $db->get("SELECT id_game, nama_game FROM game WHERE start_submit < CURRENT_TIMESTAMP AND last_submit > CURRENT_TIMESTAMP");
        $leveldata = $db->get("SELECT id_level, nama_level FROM level WHERE id_game = ".$_GET['id_game']."");

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

PAGE : SUBMIT SCORE
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
<form action="../process/inputScore_process.php" method="POST">
    <table>
        <tr>
            <td>Game</td>
            <td>:</td>
            <td>
                <select name="game" id="game" onchange="change_idLevel()">
                    <?php
                        foreach ($gamedata as $key => $gamedata) {
                            if ($key+1 == $_GET['id_game'] )
                                echo "<option value=".$gamedata['id_game'] ." selected>".$gamedata['nama_game']."</option>";
                            else
                                echo "<option value=".$gamedata['id_game'] .">".$gamedata['nama_game']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Level</td>
            <td>:</td>
            <td>
                <select name="level">
                    <?php
                        foreach ($leveldata as $leveldata) {
                            echo "<option value=".$leveldata['id_level'] .">".$leveldata['nama_level']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Score</td>
            <td>:</td>
            <td><input type="number" name="score" required></td>
        </tr>
        <tr>
            <td colspan=3><input type="submit" value="SUBMIT"></td>
        </tr>
    </table>
</form>

<script>

    function change_idLevel() {
        id_game = document.getElementById('game').value;
        location.href = ("submit.php?id_game="+id_game);
    }

</script>
