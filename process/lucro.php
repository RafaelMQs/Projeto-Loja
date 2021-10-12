<?php
session_start();
include_once("conection.php");

$totalPag = str_replace(",", ".", $_POST['totalPag']);
$totalPag = str_replace("R$", " ",$totalPag);
$formaPag = $_POST['selectFormaPag'];
date_default_timezone_set('America/Sao_Paulo');
$dataAgora = date('Ymd');

$id = "SELECT id FROM logins WHERE usuario = '{$_SESSION['usuario']}'";
$idresult = $conn->query($id) or die($conn->error);
$rowid = mysqli_fetch_assoc($idresult);

if($formaPag == "debito"){
    $insertDebito =mysqli_query($conn, "INSERT INTO pgdebito VALUES ($totalPag, $dataAgora, {$rowid['id']})");
    echo json_encode("Debitado");

}elseif($formaPag == "credito"){
    $insertDebito =mysqli_query($conn, "INSERT INTO pgcredito VALUES ($totalPag, $dataAgora, {$rowid['id']})");
    echo json_encode("Creditado");

}elseif($formaPag == "dinheiro"){
    $insertDebito =mysqli_query($conn, "INSERT INTO pgdinheiro VALUES ($totalPag, $dataAgora, {$rowid['id']})");
    echo json_encode("Dinherado");
}else{
    echo json_encode("Deu Ruim");
}

?>