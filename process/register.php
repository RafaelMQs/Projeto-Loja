<?php
session_start();
include_once('conection.php');

if (empty($_POST['usuario_register']) || empty($_POST['senha_register']) || empty($_POST['senha_confirm'])){
    $_SESSION['registro_vazio'] = true;
    header('Location: ../pagregister.php?Error-Registo_vazio');
    exit();
}

$usuario_register = mysqli_real_escape_string($conn, $_POST['usuario_register']);
$senha_register = mysqli_real_escape_string($conn, $_POST['senha_register']);
$senha_confirm = mysqli_real_escape_string($conn, $_POST['senha_confirm']);
$nomeLoja_register = mysqli_real_escape_string($conn, $_POST['nomeLoja_register']);
$localLoja_register = mysqli_real_escape_string($conn, $_POST['localLoja_register']);
$telLoja_register = mysqli_real_escape_string($conn, $_POST['telLoja_register']);

$check = "SELECT usuario FROM logins";
$result = $conn->query($check) or die ($conn->error);


while ($dado = $result->fetch_array()){

    if ($usuario_register == $dado['usuario']){
        $_SESSION['usuario_existente'] = true;
        header('Location: ../pagregister.php?Error-Usuario_existente');
        exit();
    }
}

if ($senha_register != $senha_confirm){
    $_SESSION['confirmacao_errada'] = true;
    header('Location: ../pagregister.php?Error-Confirmação_de_senha_errada');
    exit();
}
else{
    $registrar = "INSERT INTO logins(usuario, senha, nomeLoja, localLoja, telLoja) VALUES ('$usuario_register', '$senha_confirm', '$nomeLoja_register', '$localLoja_register', '$telLoja_register')";
    $result = $conn->query($registrar) or die ($conn->error);
    header("Location: ../paglogin.php?sucesso");
}