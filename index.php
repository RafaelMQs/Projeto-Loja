<?php
session_start();

include_once("process/conection.php");
include_once('process/verificaLogin.php');

$id = "SELECT id FROM logins WHERE usuario = '{$_SESSION['usuario']}'";
$idresult = $conn->query($id) or die($conn->error);
$rowid = mysqli_fetch_assoc($idresult);

$tabela = "SELECT idProd, nomeProd, quantProd, valorProd FROM produtos WHERE idUsuario = '{$rowid['id']}'";
$tabresult = $conn->query($tabela);
date_default_timezone_set('America/Sao_Paulo');
$dataAgora = date('Ymd');

// Lucro Hoje
$pagCredritoAgora = "SELECT * FROM pgcredito WHERE pagData = '{$dataAgora}' and idUsuario = '{$rowid['id']}'";
$pagCAgoraResult = $conn->query($pagCredritoAgora);

$pagDebitoAgora = "SELECT * FROM pgdebito WHERE pagData = '{$dataAgora}' and idUsuario = '{$rowid['id']}'";
$pagDAgoraResult = $conn->query($pagDebitoAgora);

$pagDinheiroAgora = "SELECT * FROM pgdinheiro WHERE pagData = '{$dataAgora}' and idUsuario = '{$rowid['id']}'";
$pagAVAgoraResult = $conn->query($pagDinheiroAgora);

$lucroC = 0;
while ($dado = mysqli_fetch_assoc($pagCAgoraResult)) { 
    $lucroC += $dado['pagValor'];
}

$lucroD = 0;
while ($dado = mysqli_fetch_assoc($pagDAgoraResult)) { 
    $lucroD += $dado['pagValor'];
}

$lucroAV = 0;
while ($dado = mysqli_fetch_assoc($pagAVAgoraResult)) { 
    $lucroAV += $dado['pagValor'];
}


//Lucro Ontem
$dataOntem = date('Ymd', strtotime("-1 Day"));   

$OntempagCredritoAgora = "SELECT * FROM pgcredito WHERE pagData = '{$dataOntem}' and idUsuario = '{$rowid['id']}'";
$OntempagCAgoraResult = $conn->query($OntempagCredritoAgora);

$OntempagDebitoAgora = "SELECT * FROM pgdebito WHERE pagData = '{$dataOntem}' and idUsuario = '{$rowid['id']}'";
$OntempagDAgoraResult = $conn->query($OntempagDebitoAgora);

$OntempagDinheiroAgora = "SELECT * FROM pgdinheiro WHERE pagData = '{$dataOntem}' and idUsuario = '{$rowid['id']}'";
$OntempagAVAgoraResult = $conn->query($OntempagDinheiroAgora);

$OntemlucroC = 0;
while ($dado = mysqli_fetch_assoc($OntempagCAgoraResult)) { 
    $OntemlucroC += $dado['pagValor'];
}

$OntemlucroD = 0;
while ($dado = mysqli_fetch_assoc($OntempagDAgoraResult)) { 
    $OntemlucroD += $dado['pagValor'];
}

$OntemlucroAV = 0;
while ($dado = mysqli_fetch_assoc($OntempagAVAgoraResult)) { 
    $OntemlucroAV += $dado['pagValor'];
}




?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Controle de Estoque </title>

    <link rel="sortcut icon" href="imgs/rLogo.jpg" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa|PT+Mono" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body onbeforeprint="impressaoSumir()" onafterprint="impressaoAparecer()">

    <!-- CONTAINER FAZER PEDIDOS -->
    <div class="container-fPedidos">
        <div class="fPedidos-titulo">
            <h1> ADICIONAR AO CARRINHO </h1>
        </div>
        <form action="" id="pedido">
            <input type="text" name="idProd" placeholder="ID" id="txtID" readonly>
            <input type="text" name="nomeProd" placeholder="NOME PROD" id="txtNOME" readonly>
            <input type="number" name="quantProd" placeholder="QUANT PROD" id="txtQUANT" autocomplete="off">
            <input type="text" name="valorProd" placeholder="VALOR PROD" id="txtVALOR" readonly>
            <input type="submit" value="Adicionar ao carrinho" id="rPedido" disabled>
            <div id="resp-Pedido"> </div>
        </form>

    </div>
    <!-- CONTAINER FAZER PEDIDOS -->

    <!-- CONTAINER DA TABELA -->
    <div class="tabela-container">
        <div class="tabela-acoes">
            <input type="text" name="busca" class="busca" id="busca" placeholder="Buscar...">
            <input type="button" value="ADD" class="botao" onclick="iniciaModal('modal-container')">
            <input type="button" value="REMOVE" class="botao" onclick="iniciaModal('modalRemove-container')">
            <input type="button" value="EDIT" class="botao" onclick="iniciaModal('modalEdit-container')">
        </div>

        <div class="tabela" id="tabela">
            <table class="tabela" id="bdResult">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> NOME </th>
                        <th> QT </th>
                        <th> VALOR UNI </th>
                    </tr>
                </thead>
                <?php while ($dado = mysqli_fetch_assoc($tabresult)) {
                    if($dado["quantProd"] == 0){
                        echo "<html> <h5 style='background-color: red;'> Item: ",strval($dado["nomeProd"])," esta zerado"; 
                    }?>
                    <tbody>
                        <tr>
                            <td> <?php echo $dado["idProd"]; ?> </td>
                            <td> <?php echo $dado["nomeProd"]; ?> </td>
                            <td style="text-align: right;"> <?php echo $dado["quantProd"]; ?> </td>
                            <td style="text-align: right;"> R$ <?php echo number_format($dado["valorProd"], 2, ',', '.'); ?> </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
            <table class="tabela ocultar" id="searchResult">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> NOME </th>
                        <th> QT </th>
                        <th> VALOR UNI </th>
                    </tr>
                </thead>
                <tbody id="result">

                </tbody>
            </table>

        </div>
        <p> OBS: Clique no em cima do item que deseja vender </p>
    </div>

    <!-- CONTAINER PEDIDOS FEITOS -->
    <div class="container-pedidos">
        <div class="pedidos-titulo">
            <h1> PEDIDOS/CARRINHO </h1>
        </div>

        <div class="tabelaPedidos-container">
            <table id="tabela-pedidos">
                <tr>
                    <th> ID </th>
                    <th> NOME </th>
                    <th> QT </th>
                    <th> VALOR </th>
                </tr>
            </table>
        </div>
        <form action="" id="form-finalizarP">
            <label for="total"> Total: </label>
            <input type="text" name="totalPag" id="totalPag" class="input-total" readonly>

            <label for="formaPag">Forma de pagamento: </label>
            <select id="formaPag" name="selectFormaPag" class="selectPag">
                <option value="debito"> Debito </option>
                <option value="credito"> Credito </option>
                <option value="dinheiro"> Dinheiro </option>
            </select>
            <input type="submit" class="botaoPag" id="botaoPag" value="FINALIZAR PEDIDO" disabled>
            <p id="respostaPag" style="background-color: green;"> </p>
        </form>
    </div>
    <!-- CONTAINER PEDIDOS FEITOS -->

    <!-- CONTAINER LUCRO -->
    <div class="container-lucro">
        <div class="lucro-titulo">
            <h1> LUCRO </h1>
        </div>
        <div class="lucro">
            <h3> Hoje: </h3>
            Credito: <input type="text" class="input-lucro C" value="R$ <?php echo str_replace(".", ",",$lucroC); ?>">
            Debido: <input type="text" class="input-lucro D" value="R$ <?php echo str_replace(".", ",",$lucroD); ?>">
            Dinheiro: <input type="text" class="input-lucro AV" value="R$ <?php echo str_replace(".", ",",$lucroAV); ?>">

            <h3> Ontem: </h3>

            Credito: <input type="text" class="input-lucro C" value="R$ <?php echo str_replace(".", ",",$OntemlucroC); ?>">
            Debido: <input type="text" class="input-lucro D" value="R$ <?php echo str_replace(".", ",",$OntemlucroD); ?>">
            Dinheiro: <input type="text" class="input-lucro AV" value="R$ <?php echo str_replace(".", ",",$OntemlucroAV); ?>">
        </div>
    </div>
    <!-- CONTAINER LUCRO -->

    <!-- CONTAINER MODAL TROCO -->
    <div class="modal-container" id="modalTroco-container">
        <div class="modal">
            <h1> Troco </h1>
            <button class="fechar" onclick="modalTroco()"> x </button>
            <form id="form">
                <p> Total: </p>
                <input type="text" placeholder="Valor Total" id="totalPag-Troco" readonly>
                <p> Valor Recebido: </p>
                <input type="number" placeholder="Valor Recebido" id="valorReceb">
                <p> OBS: Adicione o Valor Recebido para Calcular o Troco</p>
                <input type="button" value="Calcular Troco" name="botao" onclick="calcTroco()">
                <p style="background-color: red;" id="trocoResposta"> </p>
                <input type="text" placeholder="Troco.." id="troco">
            </form>
        </div>
    </div>
    <!-- CONTAINER MODAL TROCO -->

    <!-- CONTAINER DA TABELA -->

    <!-- CONTAINER MODAL ADD -->
    <div class="modal-container" id="modal-container">
        <div class="modal">
            <h1> Adicionar Produto </h1>
            <button class="fechar" onclick="fechaModal('modal-container')"> x </button>
            <form action="process/tableAction.php" method="POST" id="form">
                <input type="text" placeholder="ID do Produto" name="idProduto">
                <input type="text" placeholder="Nome do Produto" name="nomeProd">
                <input type="number" placeholder="Quantidade do Produto" name="quantProd">
                <input type="number" placeholder="Valor do Produto" maxlength="10" step=".01" name="valorProd">
                <p> OBS: Adicione os dados para adicionar um item</p>
                <input type="submit" value="Adicionar Produto" name="botao">
            </form>
        </div>
    </div>
    <!-- CONTAINER MODAL ADD -->

    <!-- CONTAINER MODAL REMOVER -->
    <div class="modal-container" id="modalRemove-container">
        <div class="modal">
            <h1> Remove Produto </h1>
            <button class="fechar" onclick="fechaModal('modalRemove-container')"> x </button>
            <form action="process/tableAction.php" method="POST" id="formRemove">
                <input type="text" placeholder="ID do Produto" name="idProduto">
                <p> OU </p>
                <input type="text" placeholder="Nome do Produto" name="nomeProd">
                <p> OBS: Adicione o ID ou o Nome do produto que deseja deletar</p>
                <input type="submit" value="Remover Produto" name="botao">
            </form>
        </div>
    </div>
    <!-- CONTAINER MODAL REMOVER -->

    <!-- CONTAINER MODAL EDITAR -->
    <div class="modal-container" id="modalEdit-container">
        <div class="modal">
            <h1> Editar Produto </h1>
            <button class="fechar" onclick="fechaModal('modalEdit-container')"> x </button>
            <form action="process/tableAction.php" method="POST" id="formRemove">
                <input type="text" placeholder="ID do Produto" name="idProdRef">
                <p> OBS: Digite o ID do produto que deseja editar</p>
                <input type="text" placeholder="ID do Produto" name="idProduto">
                <input type="text" placeholder="Nome do Produto" name="nomeProd">
                <input type="number" placeholder="Quantidade do Produto" name="quantProd">
                <input type="text" placeholder="Valor do Produto" maxlength="10" name="valorProd">
                <p> OBS: Adicione os dados que deseja Editar</p>
                <input type="submit" value="Editar Produto" name="botao">
            </form>
        </div>
    </div>
    <!-- CONTAINER MODAL EDITAR -->

    <!-- Nota Fiscal -->
    <div class="fundo-fiscal" id="notaFiscal" hidden>
        <div class="botao-impressao" id="botao-impressao">
            <input type="button" value="IMPRIMIR" onclick="window.print()">
            <input type="button" value="FAZER NOVO PEDIDO" onClick="window.location.reload()">
        </div>
        <div class="fiscal-container">
            <div class="fiscal-cabecalho">
                <h5> GRATO PELA PREFERENCIA </h5>
                <br>

                <h5> SINTONIA HOOKAH LOUNGE </h5>
                <h5> RUA JEQUIRITURA N 929 </h5>
                
                <h5> (11) 94680-3234 </h5>
            </div>
            <div class="fiscal-horario">
                <h5> CUPOM NÃO FISCAL </h5>
            </div>
            <br>
            <h5 id="txtFormaPag"> CLIENTE DIVERSOS | FORMA DE PAGAMENTO: </h5> 
            <br>

            <div class="fiscal-tabela">
                <br>
                <table id="tabela-fiscal">
                    <tr>
                        <th> ID PRODUTO </th>
                        <th> NOME PRODUTO </th>
                        <th> QUANTIDADE </th>
                        <th> VALOR </th>
                    </tr>
                </table> <br>
            </div>
            <br>
            <h5> Situação: Entrega direto para o cliente </h5> <br>
            <div class="fiscal-final">
                <h5> GRATO PELA PREFERENCIA </h5>
            </div>
        </div>

    </div>
    <script src="javascript/indexJavaScript.js"></script>
    <script>
        rPedido = document.getElementById("rPedido");
        $("#busca").keyup(function() {
            var busca = $("#busca").val();
            $.post('process/searchTable.php', {
                busca: busca
            }, function(data) {
                const bdResult = document.getElementById('bdResult');
                const searchResult = document.getElementById('searchResult');
                bdResult.classList.add("ocultar");
                searchResult.classList.remove("ocultar");
                $("#result").html(data);

                tabela1 = document.getElementById("searchResult");
                console.log(tabela1);

                for (var i = 0; tabela1.rows.length; i++) {
                    tabela1.rows[i].onclick = function() {
                        rPedido.removeAttribute("disabled", "disabled");
                        index1 = this.rowIndex;
                        document.getElementById("txtID").value = tabela1.rows[index1].cells[0].innerText;
                        document.getElementById("txtNOME").value = tabela1.rows[index1].cells[1].innerText;
                        //valor = parseFloat(tabela.rows[index].cells[3].innerText.replace("R$", ""));
                        //document.getElementById("txtVALOR").value = valor;
                        document.getElementById("txtVALOR").value = tabela1.rows[index1].cells[3].innerText;
                    }
                }
            });
        });
    </script>
</body>

</html>
