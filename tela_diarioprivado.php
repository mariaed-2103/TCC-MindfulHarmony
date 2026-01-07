<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_diarioprivado.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <title>Diário Privado</title>

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

      <div class="diario">
        <h1>Diário Privado</h1>
        <form method="post" action="salvar_desabafos.php">
            <textarea id="desabafo" name="desabafo" rows="5" cols="50" placeholder="Escreva aqui o seu desabafo..." required></textarea><br>
            Data:
            <input type="text" id="data" name="data" readonly><br>
            Hora:
            <input type="text" id="hora" name="hora" readonly><br>
            <input type="submit" value="Salvar">

            <div id="custom-alert" style="display: none;" class="custom-alert">
    <span id="custom-alert-text"></span>
</div>

<div id="custom-alert-delete" style="display: none;" class="custom-alert">
    <span id="custom-alert-text-delete"></span>
</div>

<!-- Modal de confirmação de exclusão -->
<div id="deleteModal" class="modal">
    <div class="modal-body">
        <span id="modal-text">Você deseja excluir este desabafo?</span>
        <button id="modal-ok">OK</button>
        <button id="modal-cancel">Cancelar</button>
    </div>
</div>
<div id="custom-alert-edit" style="display: none;" class="custom-alert">
    <span id="custom-alert-text-edit"></span>
</div>

        </form>

        <script>
    setTimeout(function() {
        document.getElementById('alerta').style.display = 'none';
    }, 5000); // Ocultará o alerta após 5 segundos (ajuste conforme necessário)
</script>

    </div>


    <div class="lista-desabafos">
        <h2>Desabafos Salvos</h2>
        <ul>
        <?php
// Inicie a sessão no início do seu código
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "mindful_harmony";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifique se o ID do usuário está definido na sessão
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta para listar os desabafos do usuário específico
    $sql = "SELECT id, desabafo, data, hora FROM tb_diario WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    $desabafos = $result->fetch_all(MYSQLI_ASSOC);

    if (!empty($desabafos)) {
        foreach ($desabafos as $row) {
            $id = $row['id'];
            $desabafo = $row['desabafo'];
            $data = $row['data'];
            $hora = $row['hora'];

            echo "<li><strong>Data:</strong> $data | <strong>Hora:</strong> $hora<br>$desabafo";
            echo "<a class='editar-link' href='editar_desabafos.php?id=$id'>Editar</a>";
            echo "<a class='excluir-link' href='#' onclick='confirmDelete($id)'>Excluir</a></li>";
        }
    } else {
        echo "<li>Nenhum desabafo encontrado para este usuário.</li>";
    }
} else {
    echo "<li>ID do usuário não definido na sessão. Faça login para acessar seus desabafos.</li>";
}

// Fechar a conexão
$conn->close();
?>

        </ul>
    </div>


    <script>
        // JavaScript para atualizar a data e a hora automaticamente
        const desabafoInput = document.getElementById("desabafo");
        const dataInput = document.getElementById("data");
        const horaInput = document.getElementById("hora");

        // Função para obter a data e a hora atuais
        function atualizarDataHora() {
            const dataAtual = new Date();
            const data = dataAtual.toISOString().substr(0, 10);
            const hora = dataAtual.toTimeString().substr(0, 5);
            dataInput.value = data;
            horaInput.value = hora;
        }

        // Chame a função para definir a data e a hora atuais quando a página for carregada
        atualizarDataHora();
    </script>

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
    var meuBotao4 = document.getElementById('meuBotao4');
    var telaDestino = document.getElementById('telaDestino');
  
    // Adicione um evento de clique ao botão
    meuBotao4.addEventListener('click', function() {
        // Redirecione para a tela de destino (substitua 'URL_DA_TELA_DESTINO' pelo URL correto ou caminho para a tela)
        window.location.href = 'http://localhost/tcc%20-%20Copia/tela_perfil.php';
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
    function showCustomAlert(message) {
        var customAlert = document.getElementById('custom-alert');
        var customAlertText = document.getElementById('custom-alert-text');
        customAlertText.textContent = message;
        customAlert.style.display = 'block';

        setTimeout(function () {
            customAlert.style.display = 'none';
        }, 1700); // Oculta o alerta após 1,5 segundos (ajuste conforme necessário)
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
        // Função para mostrar o modal de confirmação diretamente ao excluir
        function confirmDelete(id) {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.style.display = 'block';

            var modalOK = document.getElementById('modal-ok');
            var modalCancel = document.getElementById('modal-cancel');

            modalOK.onclick = function () {
                // Redirecione para a página de exclusão
                window.location.href = 'excluir_desabafos.php?id=' + id;
            };

            modalCancel.onclick = function () {
                // Oculte o modal
                deleteModal.style.display = 'none';
            };
        }

        // Chamada inicial para mostrar o modal se necessário
        <?php
        if (isset($_GET['id'])) {
            echo "confirmDelete(" . $_GET['id'] . ");";
        }
        ?>
    </script>

<script>
    // Função para mostrar o alerta de exclusão
    function showDeleteAlert(message) {
        var customAlertDelete = document.getElementById('custom-alert-delete');
        var customAlertTextDelete = document.getElementById('custom-alert-text-delete');
        customAlertTextDelete.textContent = message;
        customAlertDelete.style.display = 'block';

        setTimeout(function () {
            customAlertDelete.style.display = 'none';
        }, 1700); // Oculta o alerta após 1,5 segundos (ajuste conforme necessário)
    }

    // Exemplo de uso:
    <?php
    if (isset($_SESSION['delete_message'])) {
        echo "showDeleteAlert('" . $_SESSION['delete_message'] . "');";
        unset($_SESSION['delete_message']);
    }
    ?>
</script>




<script>
    // Função para mostrar o alerta de edição
    function showEditAlert(message) {
        var customAlertEdit = document.getElementById('custom-alert-edit');
        var customAlertTextEdit = document.getElementById('custom-alert-text-edit');
        customAlertTextEdit.textContent = message;
        customAlertEdit.style.display = 'block';

        setTimeout(function () {
            customAlertEdit.style.display = 'none';
        }, 1700); // Oculta o alerta após 1,5 segundos (ajuste conforme necessário)
    }

    // Exemplo de uso:
    <?php
    if (isset($_SESSION['edit_message'])) {
        echo "showEditAlert('" . $_SESSION['edit_message'] . "');";
        unset($_SESSION['edit_message']);
    }
    ?>
</script>

</body>
</html>
