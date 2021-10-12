<?php
if(!$_SESSION['usuario']){
    header('Location: paglogin.php');
    exit();
}