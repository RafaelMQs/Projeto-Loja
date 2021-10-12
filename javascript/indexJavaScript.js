function iniciaModal(modalID) {
    const modal = document.getElementById(modalID);
    modal.classList.add('mostrar');
}

function fechaModal(modalID) {
    const modal = document.getElementById(modalID);
    modal.classList.remove('mostrar');
}

let form = document.getElementById("pedido");
respostaPedido = document.getElementById("resp-Pedido");
form.addEventListener('submit', async(event)=>{
    event.preventDefault();

    const form_data = new FormData(form);

    const responseHTTP = await fetch('process/request.php',{
        method: 'POST',
        body: form_data
    }).then(res => res.json())
    .then(data => data)

    respostaPedido.innerHTML = responseHTTP;
    if(responseHTTP == 'Adicionado'){
        respostaPedido.innerHTML = '<p style="background-color: green;">Item Adicionado ao carrinho, o estoque sera removido </p>';

        var tb = document.getElementById("tabela-pedidos");
        var tbFiscal = document.getElementById("tabela-fiscal");
        var txtID = document.getElementById("txtID");
        var txtNOME = document.getElementById("txtNOME");
        var txtQUANT = document.getElementById("txtQUANT");
        var txtVALOR = document.getElementById("txtVALOR");
    
        var qtLinhas = tb.rows.length;
        var linha = tb.insertRow(qtLinhas);
    
        var qtLinhasFiscal = tbFiscal.rows.length;
        var linhaFiscal = tbFiscal.insertRow(qtLinhasFiscal);
    
    
        var cellID = linha.insertCell(0);
        var cellNOME = linha.insertCell(1);
        var cellQUANT = linha.insertCell(2);
        var cellVALOR = linha.insertCell(3);
    
        
        var cellIDFiscal = linhaFiscal.insertCell(0);
        var cellNOMEFiscal = linhaFiscal.insertCell(1);
        var cellQUANTFiscal = linhaFiscal.insertCell(2);
        var cellVALORFiscal = linhaFiscal.insertCell(3);
    
    
        cellID.innerHTML = txtID.value;
        cellNOME.innerHTML = txtNOME.value;
        cellQUANT.innerHTML = txtQUANT.value;
        cellVALOR.innerHTML = txtVALOR.value;
    
        cellIDFiscal.innerHTML = txtID.value;
        cellNOMEFiscal.innerHTML = txtNOME.value;
        cellQUANTFiscal.innerHTML = txtQUANT.value;
        valorItem = txtVALOR.value;
        valorItem = valorItem.replace("R$", "").replace(".", "").replace(",", ".");
        valorUnitario = parseInt(txtQUANT.value) * parseFloat(valorItem);
        valorUnitario = valorUnitario.toFixed(2);
        valorUnitario = "R$ "+valorUnitario.toString().replace(".", ",");
        console.log(valorUnitario);
        cellVALORFiscal.innerHTML = valorUnitario;

        botaoPag = document.getElementById("botaoPag");
        botaoPag.removeAttribute("disabled", "disabled");
        
        totalPag = document.getElementById("totalPag");
        totalPag_Troco = document.getElementById("totalPag-Troco");
        
        Total = 0;
        TotalDecimal = 0;
        Valor = 0;
        for (var i = 0; tb.rows.length; i++) {
            qt = parseFloat(tb.rows[i+1].cells[2].innerText);
            valorProd = parseFloat(tb.rows[i+1].cells[3].innerText.replace("R$", "").replace(".", "").replace(",", "."));
            Valor = qt * valorProd.toFixed(2);
            Total += Valor;
            TotalDecimal = Total.toFixed(2);
            TotalReplace = TotalDecimal.toString().replace(".", ",");
    
            totalPag.value = "R$ "+TotalReplace;
            totalPag_Troco.value = "R$ "+TotalReplace;
        }

        
    }else if (responseHTTP == 'Excedeu'){
        respostaPedido.innerHTML = '<p style="background-color: red;"> Quantidade excedeu o Estoque </p>';
    }
}); 

function calcTroco(){
    valorReceb = document.getElementById("valorReceb");
    trocoResposta = document.getElementById("trocoResposta");
    trocoI = document.getElementById("troco");
    if (valorReceb.value < Total){
        trocoResposta.innerHTML = "Valor Recebido Menor que o Total";
    }else{
        valorRecebido = valorReceb.value.toString().replace(",", ".");
        troco = parseFloat(valorRecebido) - Total ;
        troco = troco.toFixed(2);
        console.log(troco);
        trocoI.value = "R$ "+troco.toString().replace(".", ",");

    }
}

formFinalizar = document.getElementById("form-finalizarP");
formFinalizar.addEventListener('submit', async(event)=>{
    event.preventDefault();
    formaPag = document.getElementById("formaPag");
    respostaPag = document.getElementById("respostaPag");

    console.log("sadsa");
    const form_data = new FormData(formFinalizar);

    const responseHTTP = await fetch('process/lucro.php',{
        method: 'POST',
        body: form_data
    }).then(res => res.json())
    .then(data => data)

    if(responseHTTP == "Dinherado"){
        respostaPag.innerText = "Compra feita com sucesso";
        document.getElementById("txtFormaPag").innerText = "CLIENTE DIVERSOS | FORMA DE PAGAMENTO: DINHEIRO";
        iniciaModal('modalTroco-container');
    }else if(responseHTTP == "Debitado"){
        document.getElementById('notaFiscal').removeAttribute("hidden", "hidden");
        document.getElementById("txtFormaPag").innerText = "CLIENTE DIVERSOS | FORMA DE PAGAMENTO: DEBITO";
    }else{
        document.getElementById('notaFiscal').removeAttribute("hidden", "hidden");
        document.getElementById("txtFormaPag").innerText = "CLIENTE DIVERSOS | FORMA DE PAGAMENTO: CREDITO";
    }

    
    console.log(responseHTTP);

});

function modalTroco(){
    fechaModal('modalTroco-container')
    document.getElementById('notaFiscal').removeAttribute("hidden", "hidden");
}

function impressaoSumir(){
    botaoImpressao = document.getElementById('botao-impressao');
    botaoImpressao.setAttribute("hidden", "hidden");
}

function impressaoAparecer(){
    botaoImpressao = document.getElementById('botao-impressao');
    botaoImpressao.removeAttribute("hidden", "hidden");
}

tabela = document.getElementById("bdResult");
rPedido = document.getElementById("rPedido");
for (var i = 0; tabela.rows.length; i++) {
    tabela.rows[i].onclick = function () {
        rPedido.removeAttribute("disabled", "disabled");
        index = this.rowIndex;
        document.getElementById("txtID").value = tabela.rows[index].cells[0].innerText;
        document.getElementById("txtNOME").value = tabela.rows[index].cells[1].innerText;
        //valor = parseFloat(tabela.rows[index].cells[3].innerText.replace("R$", ""));
        //document.getElementById("txtVALOR").value = valor;
        document.getElementById("txtVALOR").value = tabela.rows[index].cells[3].innerText;
    }
}