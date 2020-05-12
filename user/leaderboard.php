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

        $gamedata = $db->get("SELECT id_game, nama_game FROM game");

        if (!$_GET) {
            $_GET['id_game'] = 1;
        }

        $leaderboarddata = $db->get("SELECT 
                user.nama_user AS nama,
                (
                    SELECT
                        SUM(score.score)
                    FROM score, user, level
                    WHERE
                        score.id_user = user.id_user
                        AND user.nama_user = nama
                        AND score.id_level = level.id_level
                        AND level.id_game = ".$_GET['id_game']."
                ) AS total,
                MAX(score.input_date) as date_submit
            FROM user, score, level
            WHERE 
                user.id_user = score.id_user
                AND score.id_level = level.id_level
                AND level.id_game = ".$_GET['id_game']."
            GROUP BY total
            ORDER BY total DESC
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

    PAGE : LEADERBOARD
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
    <br>
        <form action="http://localhost/gameLeaderboard/user/leaderboard.php" method='GET'>
            Pilih Game
            <select name="id_game" id="game" onchange="change_id()">
                <?php
                    foreach ($gamedata as $key => $gamedata) {
                        if ($key+1 == $_GET['id_game'] )
                            echo "<option value=".$gamedata['id_game'] ." selected>".$gamedata['nama_game']."</option>";
                        else
                            echo "<option value=".$gamedata['id_game'] .">".$gamedata['nama_game']."</option>";
                    }
                ?>
            </select>
        </form>

    <?php
    if(isset($_GET['id_game']))
    {
        echo "LEADERBOARD GAME ID :".$_GET['id_game'];
    ?>

    <table border=1>
        <tr><td>NO</td><td>NAMA</td><td>TOTAL</td><td>LASTEST DATE SUBMIT</td></tr>
        <?php
            if ($leaderboarddata) {                
                foreach ($leaderboarddata as $key => $leaderboarddata) {
                    echo "
                        <tr>
                            <td>". ($key+1) ."</td>
                            <td>". $leaderboarddata['nama'] ."</td>
                            <td>". $leaderboarddata['total'] ."</td>
                            <td>". $leaderboarddata['date_submit'] ."</td>
                        </tr>
                    ";
                }
            }
        ?>
    </table>
    <?php
        }
    ?>

<script>

    function change_id() {
        id_game = document.getElementById('game').value;
        location.href = ("leaderboard.php?id_game="+id_game);
    }

</script>    