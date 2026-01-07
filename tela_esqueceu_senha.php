<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
  <title>Redefinir Senha</title>
  <style>

    body {
      font-family: 'Poppins', sans-serif;
      background-color:#466044;
      margin: 0;
      padding: 0;
    }

    .main {
      width: 320px;
      height: 320px;
      margin: 0 auto;
      background-color: #deb887;
      padding: 50px;
      border-radius: 30px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin-top: 260px;
    }

    .sign {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
      margin-top: 10px;
      color: #466044;
    }

    .form1 {
      text-align: center;
      font-family: 'Poppins', sans-serif;
    }

    .un, .pass {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 20px;
      font-family: 'Poppins', sans-serif;
      background-color:  #fff;
      font-size: 14px;
      color: #466044;
      font-weight: 600;
    }

    .submit {
      background-color: #466044;
      color: #fff;
      padding-left: 40px;
      padding-right: 40px;
      padding-bottom: 10px;
      padding-top: 10px;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      margin-top: 30px;
    }

    .submit:hover {
      background-color: #69915f;
    }

    input::placeholder {
        color: #466044; /* Substitua #FF0000 pela cor desejada em hexadecimal ou nome da cor */
    }

  </style>
  <!-- Adicione os estilos e links necessários aqui -->
</head>
<body>
  <div class="main">
    <p class="sign" align="center">REDEFINIR SENHA</p>
    <form class="form1" action="esqueceu_senha.php" method="post">
      <input type="text" placeholder="E-mail" name="email" class="un" align="center">
      <input type="password" placeholder="Nova Senha" name="nova_senha" class="pass" align="center">
      <input type="password" placeholder="Confirme a Nova Senha" name="confirmar_senha" class="pass" align="center">
      <button type="submit" class="submit">REDEFINIR SENHA</button>

      <div id="custom-alert" style="display: none;" class="custom-alert">
    <span id="custom-alert-text"></span>
</div>


    </form>
  </div>

  <script>
    // Adicione um evento de clique ao botão "REDEFINIR SENHA" do formulário
    document.querySelector('.form1').addEventListener('submit', function (event) {
        var novaSenhaInput = document.querySelector('input[name="nova_senha"]');
        var confirmarSenhaInput = document.querySelector('input[name="confirmar_senha"]');

        if (novaSenhaInput.value.trim() === '' && confirmarSenhaInput.value.trim() === '') {
            event.preventDefault(); // Impede o envio do formulário
            showCustomAlert("Preencha os campos de senha.");
        } else if (novaSenhaInput.value !== confirmarSenhaInput.value) {
            event.preventDefault(); // Impede o envio do formulário
            showCustomAlert("As senhas não coincidem.");
        }
    });

    function showCustomAlert(message) {
        var customAlert = document.getElementById('custom-alert');
        var customAlertText = document.getElementById('custom-alert-text');
        customAlertText.textContent = message;
        customAlert.style.display = 'block';

        setTimeout(function () {
            customAlert.style.display = 'none';
        }, 1700); // Oculta o alerta após 1,7 segundos (ajuste conforme necessário)
    }

    // Exemplo de uso:
    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "showCustomAlert('" . $_SESSION['mensagem'] . "');";
        unset($_SESSION['mensagem']);
    }
    ?>
</script>


</body>
</html>
