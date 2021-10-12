<?php
session_start();
include_once('conection.php');

if (empty($_POST['usuario_register']) || empty($_POST['senha_register']) || empty($_POST['senha_confirm'])){
    header('Location: ../pagregister.php');
    exit();
}

$usuario_register = mysqli_real_escape_string($conn, $_POST['usuario_register']);
$senha_register = mysqli_real_escape_string($conn, $_POST['senha_register']);
$senha_confirm = mysqli_real_escape_string($conn, $_POST['senha_confirm']);

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
    $registrar = "INSERT INTO logins(usuario, senha) VALUES ('$usuario_register', '$senha_confirm')";
    $result = $conn->query($registrar) or die ($conn->error);
    header("Location: ../paglogin.php?sucesso");
}