<?php
    SESSION_START();
    SESSION_UNSET($_SESSION);
    unset($_SESSION['email']);
    unset($_SESSION['id_game']);
    SESSION_DESTROY();
    header("Location: http://localhost/gameLeaderboard/");
?>