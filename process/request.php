<?php
    session_start();
    include_once('conection.php');
    $idProd = $_POST['idProd'];
    $nomeProd = $_POST['nomeProd'];
    $quantProd = $_POST['quantProd'];
    $valorProd = $_POST['valorProd'];

$id = "SELECT id FROM logins WHERE usuario = '{$_SESSION['usuario']}'";
$idresult = $conn->query($id) or die($conn->error);
$rowid = mysqli_fetch_assoc($idresult);


    if($quantProd == ""){
        echo json_encode('<p style="background-color: red;"> Adicione a quantidade do item que deseja vender </p>');
    }else{
        
        $consultaIdItem = "SELECT idProd, quantProd, idUsuario FROM produtos WHERE idProd = '$idProd' and idUsuario = '{$rowid['id']}'";
        $consulta_query = $conn->query($consultaIdItem) or die($conn->error);
        $row = mysqli_fetch_assoc($consulta_query);
        if ($consulta_query) {
            $q = $row['quantProd'];
            if($quantProd <= $q){
                $vendido = $q - $quantProd;
                $query = "UPDATE produtos SET quantProd = '$vendido' WHERE idProd = '$idProd' and idUsuario = '{$rowid['id']}'"; 
                $update_query = $conn->query($query) or die($conn->error);
                echo json_encode('Adicionado');
            }else{
                echo json_encode('Excedeu');
            }
        }else{
            echo json_encode("erro3");
        }
    }

    ?>