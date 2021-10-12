<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/paglogin_style.css">
    <link rel="stylesheet" href="css/alert_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title> Registrar </title>
</head>
<body>
    <!-- INICIO - Tela de Registro -->
    <main class="login">
        <div class="login_container">
            <h1 class="login_title"> Registrar </h1>
            <form action="process/register.php" method="POST" class="login_form">

                <input type="text" name="usuario_register" class="login_input" placeholder="Digite seu Usuario" autocomplete="off">
                <span class="login_input-border"></span>

                <input type="password" name="senha_register" class="login_input" id="password" placeholder="Digite sua Senha" autocomplete="off">
                <span class="login_input-border"></span>

                <input type="password" name="senha_confirm" class="login_input" id="password2" placeholder="Confirme sua Senha" autocomplete="off">
                <span class="login_input-border"></span>

                <div id="show-hide1"></div>

                <div id="show-hide2"></div>

                <input type="submit" class="login_submit" value="Registrar">

                <a class="login_register"> Já esta registrado? <a  href="paglogin.php" class="login_register"> Faça o Login</a> </a>
            </form>
        </div>
    </main> 
    <!-- FIM - Tela de Registro -->

    <?php
    if(isset($_SESSION['usuario_existente'])):
    ?>
        <div class="alert">  
            <span class="fas fa-exclamation-circle"> </span>
            <span class="msg"> Usuario Existente!</span>
        <div class="close-btn">
          <span class="fas fa-times"> </span>
        </div>
    </div>
    <script>
        $('.alert').addClass("show");
        $('.alert').removeClass("hide");
        $('.alert').addClass("showAlert");
        setTimeout(function(){
          $('.alert').removeClass("show");
          $('.alert').addClass("hide");
        },5000);
      $('.close-btn').click(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      });
    </script>
    <!-- FIM - Digitou a senha errada -->

    <?php 
    endif; 
    unset($_SESSION['usuario_existente']);
    ?>

    <?php
    if(isset($_SESSION['confirmacao_errada'])):
    ?>
         <div class="alert">  
            <span class="fas fa-exclamation-circle"> </span>
            <span class="msg"> Senha de confirmação errada!</span>
        <div class="close-btn">
          <span class="fas fa-times"> </span>
        </div>
    </div>
    <script>
        $('.alert').addClass("show");
        $('.alert').removeClass("hide");
        $('.alert').addClass("showAlert");
        setTimeout(function(){
          $('.alert').removeClass("show");
          $('.alert').addClass("hide");
        },5000);
      $('.close-btn').click(function(){
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      });
    </script>
    <!-- FIM - Digitou a senha de confirmação errada -->

    <?php 
    endif; 
    unset($_SESSION['confirmacao_errada']);
    ?>
    <!-- FIM - Digitou a senha de confirmação errada -->    
    <script src="../JS/js_register.js"></script>
</body>
</html>