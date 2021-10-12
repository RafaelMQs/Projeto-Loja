const init = () =>{ 
    const show_hide = document.querySelector('#show-hide');
    show_hide.addEventListener("click", showHide);
    function showHide(){
        if(inputPassword.type == 'password'){
            inputPassword.setAttribute('type', 'text');
            show_hide.classList.add('hide');
        }else{
            inputPassword.setAttribute('type', 'password');
            show_hide.classList.remove('hide');
        }
    }
    


    /*Validar a senha: const validatePassword = (event)=> {
        const input = event.currentTarget;
        if(input.value.length < 8){
            submitButton.setAttribute('disabled', 'disabled');
            input.nextElementSibling.classList.add('error');
        }else{
            submitButton.removeAttribute('disabled', 'disabled');
            input.nextElementSibling.classList.remove('error');
        }
    }*/

    const inputPassword = document.querySelector('input[type="password"]');
    const submitButton = document.querySelector('.login_submit');

    //Validar a senha: inputPassword.addEventListener('input', validatePassword);
}

window.onload = init;