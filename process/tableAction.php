<?php
session_start();
include_once("conection.php");

$id = "SELECT id FROM logins WHERE usuario = '{$_SESSION['usuario']}'";
$idresult = $conn->query($id) or die($conn->error);
$rowid = mysqli_fetch_assoc($idresult);


$botao = $_POST['botao'];

if($botao == "Adicionar Produto"){
    $idProd = $_POST['idProduto'];
    $nomeProd = $_POST['nomeProd'];
    $quantProd = $_POST['quantProd'];
    $valorProd = $_POST['valorProd'];
    echo $valorProd;
    if($idProd == '' or $nomeProd == '' or $quantProd == '' or $valorProd == '' ){
        echo $_SESSION['usuario'];
    
    }else{
        $tabelaAdd = "INSERT INTO produtos VALUES ('$idProd', '$nomeProd', $quantProd, $valorProd, {$rowid['id']})";
        $tabAdd = $conn->query($tabelaAdd) or die($conn->error);
        header('Location: ../index.php');
    }

}else if ($botao == "Remover Produto"){
    $idProd = $_POST['idProduto'];
    $nomeProd = $_POST['nomeProd'];
    
    
    if($idProd == '' and $nomeProd == ''){
        echo "EU TO MALUCO";
    }else if ($idProd != '' and $nomeProd != ''){
        echo "EU TO BIZARRO";
    }else if ($idProd != ''){
        $tabelaRemove = "DELETE FROM produtos WHERE idProd = '$idProd' and idUsuario = '{$rowid['id']}' ";
        $tabRemove = $conn->query($tabelaRemove) or die($conn->error);
        header('Location: ../index.php');
    }else if ($nomeProd != ''){
        $tabelaRemove = "DELETE FROM produtos WHERE nomeProd = '$nomeProd' and idUsuario = '{$rowid['id']}'";
        $tabRemove = $conn->query($tabelaRemove) or die($conn->error);
        header('Location: ../index.php');
    }
}else if ($botao == "Editar Produto"){
    $idProdRef = $_POST['idProdRef'];
    $idProd = $_POST['idProduto'];
    $nomeProd = $_POST['nomeProd'];
    $quantProd = $_POST['quantProd'];
    $valorProd = $_POST['valorProd'];

    if($idProdRef == '' or $nomeProd == '' or $quantProd == '' or $valorProd == '' ){
        echo "EU TO MALUCO";
    }else if ($idProdRef != ''){
        $tabelaEdit = "UPDATE produtos SET idProd = '$idProd', nomeProd = '$nomeProd', quantProd = '$quantProd', valorProd = '$valorProd' WHERE idProd = '$idProdRef' and idUsuario = '{$rowid['id']}'";
        $tabEdit = $conn->query($tabelaEdit) or die($conn->error);
        header('Location: ../index.php');
    }
}
?>