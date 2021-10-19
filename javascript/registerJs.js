const show_hideUm = document.querySelector('#show-hide1');
show_hideUm.addEventListener("click", showHide);
function showHide(){
    if(senhaUsuario.type == 'password'){
        senhaUsuario.setAttribute('type', 'text');
        show_hideUm.classList.add('hide');
    }else{
        senhaUsuario.setAttribute('type', 'password');
        show_hideUm.classList.remove('hide');
    }
}

const show_hideDois = document.querySelector('#show-hide2');
show_hideDois.addEventListener("click", showHide1);
function showHide1(){
    if(senhaUsuarioConfirm.type == 'password'){
        senhaUsuarioConfirm.setAttribute('type', 'text');
        show_hideDois.classList.add('hide');
    }else{
        senhaUsuarioConfirm.setAttribute('type', 'password');
        show_hideDois.classList.remove('hide');
    }
}
// Usuario Register
const nomeUsuario = document.getElementById("usuario_register");
const bordaNome = document.getElementById("borda_nome");
const senhaUsuario = document.getElementById("password");
const bordaSenha = document.getElementById("borda_senha");
const senhaUsuarioConfirm = document.getElementById("password2");
const bordaSenhaConfirm = document.getElementById("borda_senhaConfirm");
const showSenhaUm = document.getElementById("show-hide1");
const showSenhaDois = document.getElementById("show-hide2");

// Empresa Register
const nomeEmpresa = document.getElementById("nomeLoja_register"); 
const localEmpresa = document.getElementById("localLoja_register"); 
const telEmpresa = document.getElementById("telLoja_register"); 
const bordaNomeL = document.getElementById("borda_nomeLoja"); 
const bordaLocal = document.getElementById("borda_localLoja"); 
const bordaTel = document.getElementById("borda_telLoja"); 

const proximo = document.getElementById("proximo");
const registrar = document.getElementById("registrar");


function a (){
    nomeUsuario.setAttribute("hidden", "hidden");
    bordaNome.setAttribute("hidden", "hidden");
    senhaUsuario.setAttribute("hidden", "hidden");
    bordaSenha.setAttribute("hidden", "hidden");
    senhaUsuarioConfirm.setAttribute("hidden", "hidden");
    bordaSenhaConfirm.setAttribute("hidden", "hidden");
    showSenhaUm.setAttribute("hidden", "hidden");
    showSenhaDois.setAttribute("hidden", "hidden");

    proximo.setAttribute("hidden", "hidden");
    registrar.removeAttribute("hidden", "hidden");
    
    nomeEmpresa.removeAttribute("hidden", "hidden");
    localEmpresa.removeAttribute("hidden", "hidden");
    telEmpresa.removeAttribute("hidden", "hidden");
    bordaNomeL.removeAttribute("hidden", "hidden");
    bordaLocal.removeAttribute("hidden", "hidden");
    bordaTel.removeAttribute("hidden", "hidden");

}