<?php
session_start();
// Verifique se o usuário está logado e possui um ID de usuário na sessão
if (!isset($_SESSION['id_usuario'])) {
    // Redirecione o usuário para a página de login, pois ele não está logado.
    header("Location: tela_login.html"); // Substitua "login.php" pela página de login.
    exit();
}

$id_usuario = $_SESSION['id_usuario']; // Recupere o ID do usuário da sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_apresentacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <title>Apresentação/Quem somos</title>

  
</head>
<body>

    <header>

        <div class="header-image">
          <img src="https://res.cloudinary.com/ddzdabbif/image/upload/v1693999023/Novo_Projeto_oqfozm.png" alt="Sua Imagem">
      </div>
    
      <div class="button-container">
        <div class="dropdown">
            <button class="dropdown-button">Saúde Mental</button>
            <div class="dropdown-content">
                <a href="http://localhost/tcc%20-%20Copia/tela_apresentacao.php">Apresentação/Quem Somos</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_oq_saudemental.html">O que é saúde mental?</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_mitos.html#">Mitos e fatos</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_emocoes.html">Emoções</a>
            </div>
          </div>

          <button id="meuBotao" class="custom-button">Onde buscar ajuda?</button>
        <button id="meuBotao1" class="custom-button">Relatos/Depoimentos</button>
        <button id="meuBotao2" class="custom-button">Como você está hoje?</button>
        <button id="meuBotao3" class="custom-button">Diário Privado</button>
        <button id="meuBotao4" class="custom-button">Perfil</button>
    </div>
  </header>

  <div class="container">
    <img src="imagens/lotus.png" alt="Imagem o que é" class="imagelotus">
   
</div>



  <div class="containeroqeh">
    <img src="https://res.cloudinary.com/ddzdabbif/image/upload/v1697739317/oqueeh_aktoc6.png" alt="Imagem o que é" class="image">
</div>

<div class="containertitle">
  <img src="imagens/oqsignifica.png" alt="Imagem o que é" class="imagetitle">
</div>


<div class="containeritems">
  <p class="text2">A expressão "mindful harmony" descreve a busca por um equilíbrio consciente. "Mindful" refere-se à atenção plena, a consciência do momento presente, enquanto "harmony" denota harmonia e paz. Assim, "mindful harmony" representa a prática de equilibrar mente, corpo e ambiente de forma consciente. É um caminho para reduzir o estresse, melhorar o bem-estar emocional e viver uma vida mais plena, estando mais consciente de nossos pensamentos e do mundo ao nosso redor.</p>
  <img src="imagens/mindful.png" alt="Imagem 2" class="image2">
</div>




<div class="containerobjetivo">
  <img src="imagens/objetivo.png" alt="Imagem objetivo" class="imagem-objetivo">
</div>



      <div class="containerobjetivotexto">
        <img src="https://res.cloudinary.com/ddzdabbif/image/upload/v1696599598/7686388-removebg-preview_kz6713_1_lens8g.png" alt="Imagem 1" class="image1">
        <p class="text3"> Na era agitada em que vivemos, nunca foi tão importante cuidar da nossa saúde mental. No Mindful Harmony, entendemos as complexidades e desafios que todos enfrentamos em nossas vidas, e estamos aqui para oferecer uma mão amiga e um ouvido atento quando você mais precisa. Nosso site é dedicado a fornecer recursos, apoio e informações essenciais para ajudar a gerenciar crises de saúde mental e promover o bem-estar emocional.
        </p>
    </div>

    <div class="containertitle">
      <img src="imagens/quemsomoss.png" alt="Imagem o que é" class="imagetitle">
    </div>
    
    
    <div class="containerpsi">
      <p class="text2">Somos um grupo de estudantes com o propósito de oferecer apoio e orientação a jovens e pessoas de todas as idades no âmbito da saúde mental. Nosso compromisso é ajudá-los a enfrentar seus desafios e preocupações de maneira mais eficaz. Contamos com a expertise de uma psicóloga experiente, Ana Martins (CRP: 06/187020), que nos orienta na prestação de conselhos e informações. Estamos aqui para promover o bem-estar emocional e o desenvolvimento pessoal, visando construir um futuro mais saudável e equilibrado para todos.</p>
      <img src="imagens/psiana.png" alt="Imagem 2" class="image2">
    </div>
    
   
        <img src="imagens/nois2.png" alt="Imagem o que é" class="imagenois">
    
        <div class="container2">
              <h2>Fale Conosco</h2>
              <p class="justificado">
                  Se você teve uma experiência com o nosso site, serviços ou conteúdo que deseja compartilhar, estamos aqui para ouvir. Seja para elogiar algo que tenha funcionado bem ou para apontar áreas onde podemos melhorar, seu feedback é vital para aprimorarmos nossa missão de promover o bem-estar mental.
              </p>
              <form action="salvar_faleconosco.php" method="post">
                  <div class="form-group">
                      <label for="assunto">Assunto:</label>
                      <input type="text" id="assunto" name="assunto" required>
                  </div>
          
                  <div class="form-group">
                      <label for="mensagem">Mensagem:</label>
                      <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
                  </div>
          
                  <!-- Campo oculto para armazenar o ID do usuário logado -->
                  <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
          
                  <div class="form-group">
                      <label for="nome_usuario">Seu Nome:</label>
                      <input type="text" id="nome_usuario" name="nome_usuario">
                  </div>
          
                  <button class="custom-submit-button" type="submit">Enviar</button>

                  <div id="custom-alert" class="custom-alert">
                 <span id="custom-alert-text"></span>
                 </div>

              </form>
          </div>
          
        
        
            <footer>
                <p>&copy; 2023 Meu Site de Apresentação</p>
            </footer>
        
            <script>
              // Selecione o botão e a tela de destino pelo ID
              var meuBotao = document.getElementById('meuBotao');
              var telaDestino = document.getElementById('telaDestino');
            
              // Adicione um evento de clique ao botão
              meuBotao.addEventListener('click', function() {
             
                  window.location.href = 'http://localhost/tcc%20-%20Copia/tela_ondebuscar.html';
              });
            </script>
        
        <script>
          // Selecione o botão e a tela de destino pelo ID
          var meuBotao1 = document.getElementById('meuBotao1');
          var telaDestino = document.getElementById('telaDestino');
        
          // Adicione um evento de clique ao botão
          meuBotao1.addEventListener('click', function() {
      
              window.location.href = 'http://localhost/tcc%20-%20Copia/tela_relatos.html';
          });
        </script>
        
        <script>
          // Selecione o botão e a tela de destino pelo ID
          var meuBotao2 = document.getElementById('meuBotao2');
          var telaDestino = document.getElementById('telaDestino');
        
          // Adicione um evento de clique ao botão
          meuBotao2.addEventListener('click', function() {
            
              window.location.href = 'http://localhost/tcc%20-%20Copia/tela_nivelemocoes.html';
          });
        </script>
        
        <script>
          // Selecione o botão e a tela de destino pelo ID
          var meuBotao3 = document.getElementById('meuBotao3');
          var telaDestino = document.getElementById('telaDestino');
        
          // Adicione um evento de clique ao botão
          meuBotao3.addEventListener('click', function() {
        
              window.location.href = 'http://localhost/tcc%20-%20Copia/tela_diarioprivado.php';
          });
        </script>
        
        <script>
          // Selecione o botão e a tela de destino pelo ID
          var meuBotao4 = document.getElementById('meuBotao4');
          var telaDestino = document.getElementById('telaDestino');
        
          // Adicione um evento de clique ao botão
          meuBotao4.addEventListener('click', function() {
              
              window.location.href = 'http://localhost/tcc%20-%20Copia/tela_perfil.php';
          });
        </script>

<!-- No final do seu arquivo PHP -->
<script>
    function showCustomAlert(message) {
        var customAlert = document.getElementById('custom-alert');
        var customAlertText = document.getElementById('custom-alert-text');
        customAlertText.textContent = message;
        customAlert.style.display = 'block';

        setTimeout(function () {
            customAlert.style.display = 'none';
        }, 1500); // Oculta o alerta após 1,5 segundos (ajuste conforme necessário)
    }
    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "showCustomAlert('" . $_SESSION['mensagem'] . "');";
        unset($_SESSION['mensagem']);
    }
    ?>
</script>


</body>
</html>
