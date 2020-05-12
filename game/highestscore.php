<?php
    SESSION_START();
    include("../database.php");
    $db = new Database();

    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($id_game)
    {

        $userdata = $db->get("SELECT 
            user.nama_user AS nama,
                (
                    SELECT
                        SUM(score.score)
                    FROM score, user, level
                    WHERE
                        score.id_user = user.id_user
                        AND user.nama_user = nama
                        AND score.id_level = level.id_level
                        AND level.id_game = ".$id_game."
                ) AS total,
                MAX(score.input_date) as date_submit
            FROM user, score, level
            WHERE 
                user.id_user = score.id_user
                AND score.id_level = level.id_level
                AND level.id_game = ".$id_game."
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

    PAGE : HIGHEST SCORE
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
        <tr><td align="center" colspan=5>HIGHEST SCORE</td></tr>
        <tr><td>NO</td><td>NAMA</td><td>TOTAL</td><td>LASTEST DATE SUBMIT</td></tr>
        <?php
            if ($userdata) {                
                foreach ($userdata as $key => $userdata) {
                    echo "
                        <tr>
                            <td>". ($key+1) ."</td>
                            <td>". $userdata['nama'] ."</td>
                            <td>". $userdata['total'] ."</td>
                            <td>". $userdata['date_submit'] ."</td>
                        </tr>
                    ";
                }
            }
        ?>
        </table>