<?php
    session_start();
    session_destroy();
    header('Location: ../paglogin.php');

?>