<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "projeto loja";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}
?>