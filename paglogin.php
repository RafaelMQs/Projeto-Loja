<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="sortcut icon" href="imgs/rLogo.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="css/alert_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="css/paglogin_style.css">
  <script src="jquery-3.1.1.min.js"></script>
  <title> Projeto Estoque </title>
</head>

<body>

  <!-- INICIO - Tela de Login -->
  <main class="login">
    <div class="login_container">
      <h1 class="login_title"> Login </h1>
      <form action="process/login.php" method="POST" class="login_form">

        <input type="text" name="usuario" class="login_input" placeholder="Digite seu usuario">
        <span class="login_input-border"></span>

        <input type="password" name="senha" class="login_input" placeholder="Digite sua senha">
        <span class="login_input-border"></span>
        <div id="show-hide"></div>

        <input type="submit" class="login_submit" value="Logar">

        <a class="login_register"> Não esta registrado? <a href="pagregister.php" class="login_register"> Registre-se</a> </a>
      </form>
    </div>
  </main>
  <!-- FIM - Tela de Login -->

  <!-- INICIO - Digitou a senha errada -->
  <?php
  if (isset($_SESSION['nao_autenticado'])) :
  ?>
    <div class="alert">
      <span class="fas fa-exclamation-circle"> </span>
      <span class="msg"> Usuario ou senha invalidos!</span>
      <div class="close-btn">
        <span class="fas fa-times"> </span>
      </div>
    </div>
    <script>
      $('.alert').addClass("show");
      $('.alert').removeClass("hide");
      $('.alert').addClass("showAlert");
      setTimeout(function() {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      }, 5000);
      $('.close-btn').click(function() {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      });
    </script>

  <?php
  endif;
  unset($_SESSION['nao_autenticado']);
  // FIM - Digitou a senha errada 

  // INICIO - Não autenticado
  if (isset($_SESSION['vazio'])) :
  ?>
    <div class="alert">
      <span class="fas fa-exclamation-circle"> </span>
      <span class="msg"> Insira o Login e Senha!</span>
      <div class="close-btn">
        <span class="fas fa-times"> </span>
      </div>
    </div>
    <script>
      $('.alert').addClass("show");
      $('.alert').removeClass("hide");
      $('.alert').addClass("showAlert");
      setTimeout(function() {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      }, 5000);
      $('.close-btn').click(function() {
        $('.alert').removeClass("show");
        $('.alert').addClass("hide");
      });
    </script>
  <?php
  endif;
  unset($_SESSION['vazio']);
  // FIM - Não autenticado

  // INICIO - Cadastrado com sucesso
  if (isset($_GET['sucesso'])) :
  ?>
    <div class="alertS">
      <span class="fas fa-check-circle"> </span>
      <span class="msg"> Registrado com Sucesso! </span>
      <div class="close-btn">
        <span class="fas fa-times"> </span>
      </div>
    </div>
    <script>
      $('.alertS').addClass("show");
      $('.alertS').removeClass("hide");
      $('.alertS').addClass("showAlert");
      setTimeout(function() {
        $('.alertS').removeClass("show");
        $('.alertS').addClass("hide");
      }, 5000);
      $('.close-btn').click(function() {
        $('.alertS').removeClass("show");
        $('.alertS').addClass("hide");
      });
    </script>
  <?php
  endif;
  ?>
  <!-- FIM - Cadastrado com sucesso -->
  <script src="javascript/loginJs.js"></script>
</body>

</html>