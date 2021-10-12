<?php
session_start();
include_once('conection.php');

if (empty($_POST['usuario']) || empty($_POST['senha']) ){
    $_SESSION['vazio'] = true;
    header('Location: ../paglogin.php');
    exit();
}


$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "SELECT usuario, senha FROM logins WHERE usuario = '{$usuario}' and senha = '{$senha}'";

$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);
    
if($row == 1){
    $_SESSION['usuario'] = $usuario;
    header('Location: ../index.php');
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: ../paglogin.php');
    exit();
}