<?php
    SESSION_START();
    include("database.php");
    $db = new database();

    $id_game = (isset($_SESSION['id_game'])) ? $_SESSION['id_game'] : "";

    if($id_game)
    {
        $result = $db->execute("SELECT * FROM game WHERE id_game = '".$id_game."' ");
        if($result)
        {
            header("Location: http://localhost/gameLeaderboard/game");
        }
    }
    
    $gamedata = $db->get("SELECT id_game, nama_game FROM game");

    $notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";
    if($notification){
        echo $notification;
        unset($_SESSION['notification']);
    }

?>

<div>PAGE : PILIH GAME</div>
<table>

    <br>
    <form action="" method='POST'>
        Pilih Game
        <select name="id_game">
            <?php
                foreach ($gamedata as $key => $gamedata) {
                    if ($key+1 == $_GET['id_game'] )
                        echo "<option value=".$gamedata['id_game'] ." selected>".$gamedata['nama_game']."</option>";
                    else
                        echo "<option value=".$gamedata['id_game'] .">".$gamedata['nama_game']."</option>";
                }
            ?>
        </select>

   <tr>
       <td colspan=3><input type="submit" value="PILIH" name="Submit"></td>
   </tr>
   </form>
</table>
<button><a href="index.php">BACK TO LOGIN</a></button>

<?php
    if (isset($_POST['Submit'])) {
        $_SESSION['id_game'] = $_POST['id_game'];
        header("Location: http://localhost/gameLeaderboard/game");
    }
?> 