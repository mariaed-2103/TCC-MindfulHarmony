<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_perfil.css"> <!-- Se você tem um arquivo de estilo personalizado -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <!-- Inclua aqui as bibliotecas do Bootstrap -->
</head>
<body>

</head>
<body>

<?php
require_once "conexao.php"; // Verifique o caminho do arquivo "conexao.php" para garantir que ele está correto.
session_start();

if (isset($_SESSION['id_usuario'])) {
    $id_usu = $_SESSION['id_usuario'];
    $comandoSql = "SELECT * FROM usuario WHERE id_usuario = :id_usu";
    try {
        $stmt = $pdo->prepare($comandoSql);
        $stmt->bindParam(':id_usu', $id_usu, PDO::PARAM_INT);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            $nome_usuario = $dados["nome_usuario"];
            $email_usuario = $dados["email_usuario"];
            $telefone_usuario = $dados["telefone_usuario"];
            $senha_usuario = $dados["senha_usuario"];
        } else {
            // Lidar com o caso em que não foram encontrados registros com o 'id_usuario' especificado.
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Lógica para lidar com o caso em que 'id_usuario' não está definida
}
?>

    <header>

        <div class="header-image">
          <img src="https://res.cloudinary.com/ddzdabbif/image/upload/v1693999023/Novo_Projeto_oqfozm.png" alt="Sua Imagem">
      </div>
      
    
      <div class="button-container">
        <div class="dropdown">
            <button class="dropdown-button">Saúde Mental</button>
            <div class="dropdown-content">
                <a href="http://localhost/tcc%20-%20Copia/tela_apresentacao.php">Apresentação/Quem somos</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_oq_saudemental.html">O que é saúde mental?</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_mitos.html#">Mitos e fatos</a>
                <a href="http://localhost/tcc%20-%20Copia/tela_emocoes.html">Emoções</a>
            
            </div>
          </div>
          
        <button id="meuBotao" class="custom-button">Onde buscar ajuda?</button>
        <button id="meuBotao1" class="custom-button">Relatos/Depoimentos</button>
        <button id="meuBotao2" class="custom-button">Como você está hoje?</button>
        <button id="meuBotao3" class="custom-button">Diário Privado</button>
        <button class="custom-button">Perfil</button>
    </div>
      </header>

    <div class="container">
        <div class="user-icon">
            <i class="fa fa-user"></i>
        </div>
        <h2>Meu Perfil</h2>

        <form action="altera_usuario.php" id="perfil-form" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Seu Nome" value="<?php echo $nome_usuario?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="seuemail@example.com" value="<?php echo $email_usuario?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" value="<?php echo $telefone_usuario?>">
            </div>
            <div class="form-group">
                <label for="nova-senha">Nova Senha:</label>
                <input type="password" id="nova-senha" name="nova-senha" placeholder="Nova Senha">
            </div>
            <div class="form-group">
                <label for="repita-senha">Repita a Senha:</label>
                <input type="password" id="repita-senha" name="repita-senha" placeholder="Repita a Senha">
            </div>
            <div class="form-group">
                <div class="button-container">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                    <input type="submit" value="Salvar Alterações">
                </div>
                </div>

                <div class="form-group">
    <div class="button-container">
        <button type="button" id="excluir-perfil">Excluir Perfil</button>
    </div>
</div>

<div id="senha-alerta" style="display: none;" class="custom-alert">
    <span id="senha-alerta-text"></span>
</div>

<div id="custom-alert" style="display: none;" class="custom-alert">
    <span id="custom-alert-text"></span>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal" id="confirmacaoExclusaoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Você tem certeza de que deseja excluir esse usuário?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmarExclusao" class="btn btn-danger">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- java de exclusão do usuario-->
<script>
    var excluirBotao = document.getElementById('excluir-perfil');
    var confirmarExclusaoBotao = document.getElementById('confirmarExclusao');
    var cancelarExclusaoBotao = document.querySelector('#confirmacaoExclusaoModal .btn-secondary');
    var confirmacaoExclusaoModal = document.getElementById('confirmacaoExclusaoModal');

    excluirBotao.addEventListener('click', function () {
        confirmacaoExclusaoModal.style.display = 'block';
        
        // Role a página para o topo do modal + um valor negativo para subir um pouco mais
        window.scrollTo(0, confirmacaoExclusaoModal.offsetTop - 98); // Ajuste o valor (-50) conforme necessário
    });

    confirmarExclusaoBotao.addEventListener('click', function () {
        // Excluir o perfil (código existente)
        window.location.href = 'exclui_usuario.php?id_usuario=<?php echo $_SESSION['id_usuario']; ?>';
    });

    cancelarExclusaoBotao.addEventListener('click', function () {
        confirmacaoExclusaoModal.style.display = 'none';
    });
</script>



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
            // Redirecione para a tela de destino (substitua 'URL_DA_TELA_DESTINO' pelo URL correto ou caminho para a tela)
            window.location.href = 'http://localhost/tcc%20-%20Copia/tela_ondebuscar.html';
        });
      </script>

<script>
  // Selecione o botão e a tela de destino pelo ID
  var meuBotao1 = document.getElementById('meuBotao1');
  var telaDestino = document.getElementById('telaDestino');

  // Adicione um evento de clique ao botão
  meuBotao1.addEventListener('click', function() {
      // Redirecione para a tela de destino (substitua 'URL_DA_TELA_DESTINO' pelo URL correto ou caminho para a tela)
      window.location.href = 'http://localhost/tcc%20-%20Copia/tela_relatos.html';
  });
</script>

<script>
    // Selecione o botão e a tela de destino pelo ID
    var meuBotao2 = document.getElementById('meuBotao2');
    var telaDestino = document.getElementById('telaDestino');
  
    // Adicione um evento de clique ao botão
    meuBotao2.addEventListener('click', function() {
        // Redirecione para a tela de destino (substitua 'URL_DA_TELA_DESTINO' pelo URL correto ou caminho para a tela)
        window.location.href = 'http://localhost/tcc%20-%20Copia/tela_nivelemocoes.html';
    });
  </script>

<script>
    // Selecione o botão e a tela de destino pelo ID
    var meuBotao3 = document.getElementById('meuBotao3');
    var telaDestino = document.getElementById('telaDestino');
  
    // Adicione um evento de clique ao botão
    meuBotao3.addEventListener('click', function() {
        // Redirecione para a tela de destino (substitua 'URL_DA_TELA_DESTINO' pelo URL correto ou caminho para a tela)
        window.location.href = 'http://localhost/tcc%20-%20Copia/tela_diarioprivado.php';
    });
  </script>

<script>
    // Adicione um evento de clique para fechar o alerta
    document.getElementById('alerta').addEventListener('closed.bs.alert', function () {
        // Redirecione para a tela principal ou faça qualquer outra ação desejada
        window.location.href = 'tela_perfil.php';
    });
</script>

<script>
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

<script>
    function showCustomAlert(message) {
        var customAlert = document.getElementById('custom-alert');
        var customAlertText = document.getElementById('custom-alert-text');
        customAlertText.textContent = message;
        customAlert.style.display = 'block';

        // Rola a página para o topo
        window.scrollTo(0, 0);

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

    // Função para verificar se algum campo do formulário foi alterado
    function hasFormChanged() {
        var nomeInput = document.getElementById('nome');
        var emailInput = document.getElementById('email');
        var telefoneInput = document.getElementById('telefone');
        var novaSenhaInput = document.getElementById('nova-senha');
        var repitaSenhaInput = document.getElementById('repita-senha');

        if (
            nomeInput.value !== "<?php echo $nome_usuario?>" ||
            emailInput.value !== "<?php echo $email_usuario?>" ||
            telefoneInput.value !== "<?php echo $telefone_usuario?>" ||
            novaSenhaInput.value !== "" ||
            repitaSenhaInput.value !== ""
        ) {
            return true;
        }

        return false;
    }

    // Adicione um evento de clique ao botão "Salvar Alterações" do formulário
    document.getElementById('perfil-form').addEventListener('submit', function (event) {
        if (!hasFormChanged()) {
            event.preventDefault(); // Impede o envio do formulário
            showCustomAlert("Você não alterou nenhum dado.");
            // Adicione a lógica para exibir o modal aqui
        }
    });
</script>

<script>
    // Adicione um evento de clique ao botão "Salvar Alterações" do formulário
    document.getElementById('perfil-form').addEventListener('submit', function (event) {
        var novaSenhaInput = document.getElementById('nova-senha');
        var repitaSenhaInput = document.getElementById('repita-senha');

        if (novaSenhaInput.value !== repitaSenhaInput.value) {
            event.preventDefault(); // Impede o envio do formulário
            showSenhaAlert("As senhas não coincidem.");
            // Adicione a lógica para exibir o modal aqui
        }
    });

    function showSenhaAlert(message) {
        var senhaAlerta = document.getElementById('senha-alerta');
        var senhaAlertaText = document.getElementById('senha-alerta-text');
        senhaAlertaText.textContent = message;
        senhaAlerta.style.display = 'block';

        // Rola a página para o topo
        window.scrollTo(0, 0);

        setTimeout(function () {
            senhaAlerta.style.display = 'none';
        }, 3000); // Altere o valor conforme necessário
    }

    // ... (seu código existente) ...
</script>





</body>
</html>
