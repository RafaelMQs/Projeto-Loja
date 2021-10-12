<?php
include_once('conection.php');

$pesquisa = $_POST['busca'];

$result_pesquisa = mysqli_query($conn, "SELECT * FROM produtos WHERE nomeProd LIKE '%$pesquisa%'");
$num = mysqli_num_rows($result_pesquisa);


if($num > 0){
    while($row = mysqli_fetch_assoc($result_pesquisa)){
        echo "<tr>
                <td>".$row['idProd']."</td>
                <td>".$row['nomeProd']."</td>
                <td style='text-align: right;'>".$row['quantProd']."</td>
                <td style='text-align: right;'> R$".$row['valorProd']."</td>
            </tr>";
    }
}

/* $result_pesquisa = "SELECT FROM produtos WHERE nomeProd LIKE '%$pesquisa%' LIMIT 20";
$resultado_pesquisa = $conn->query($result_pesquisa) or die($conn->error); */
/* if(($resultado_pesquisa) AND ($resultado_pesquisa->num_rows != 0)){

    }
} */

?>