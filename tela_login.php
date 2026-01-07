<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tela de Login</title>
  <link rel="stylesheet" href="./style_login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
</head>
<body>
  <div class="main">
    <p class="sign" align="center">LOGIN</p>
    <form class="form1">
      <input type="text" placeholder="E-mail" id="email" name="email" class="un" align="center">
      <input type="password" placeholder="Senha" id="senha" name="senha" class="pass" align="center">
      <a href="#" class="submit" type="submit" id="botaoLogar">ENTRAR</a>
      <p class="forgot" align="center"><a href="tela_esqueceu_senha.php">Esqueceu sua senha?</a></p>
    </form>
    <div id="custom-alert" class="custom-alert">
      <span id="custom-alert-text"></span>
    </div>
  </div>

   <!-- Adicionando um alerta personalizado no carregamento da página -->
   <script>
    // Função para mostrar o alerta personalizado
    function showCustomAlert(message) {
      var customAlert = document.getElementById('custom-alert');
      var customAlertText = document.getElementById('custom-alert-text');
      customAlertText.textContent = message;
      customAlert.style.display = 'block';

      setTimeout(function () {
        customAlert.style.display = 'none';
      }, 1500);
    }

    // Exemplo de uso:
    <?php
    if (isset($_SESSION['mensagem'])) {
      echo "showCustomAlert('" . $_SESSION['mensagem'] . "');";
      unset($_SESSION['mensagem']);
    }
    ?>
  </script>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="scripts_login.js" type="text/javascript"> </script>
  
</body>
</html>

