<?php
// Inicie a sessão no início do seu código
session_start();

// Conexão com o banco de dados (substitua as informações conforme sua configuração)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mindful_harmony";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $desabafo = $_POST['desabafo'];

    // Atualizar o desabafo no banco de dados usando consulta preparada
    $sql = "UPDATE tb_diario SET desabafo = ?, data = CURRENT_TIMESTAMP, hora = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $desabafo, $id);
        if ($stmt->execute()) {
            $_SESSION['edit_message'] = "Desabafo atualizado com sucesso!";
            header('Location: tela_diarioprivado.php');
            exit();
        } else {
            $errorMessage = "Erro ao atualizar o desabafo: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $errorMessage = "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    // Recupere o desabafo existente para edição
    $id = $_GET['id'];
    $sql = "SELECT desabafo FROM tb_diario WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($desabafo);
        $stmt->fetch();
        $stmt->close();
    } else {
        $errorMessage = "Erro na preparação da consulta: " . $conn->error;
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Desabafo</title>
    <link rel="stylesheet" type="text/css" href="style_editardiario.css"> <!-- Substitua 'seu-estilo.css' pelo nome do seu arquivo CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">

    <script>
        // Função para mostrar um alerta e redirecionar após clicar em OK
        function showAlertAndRedirect(message, redirectUrl) {
            alert(message);
            window.location.href = redirectUrl;
        }

        // Verifique se há uma mensagem de sucesso ou erro e exiba um alerta, se aplicável
        <?php if (isset($successMessage)) : ?>
            showAlertAndRedirect("<?php echo $successMessage; ?>", "tela_diarioprivado.php");
        <?php elseif (isset($errorMessage)) : ?>
            showAlertAndRedirect("<?php echo $errorMessage; ?>", "editar_desabafos.php?id=<?php echo $id; ?>");
        <?php endif; ?>
    </script>

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
                <a href="#">Apresentação</a>
                <a href="#">O que é saúde mental?</a>
                <a href="#">Mitos e fatos</a>
                <a href="#">Emoções</a>
                <a href="#">Prevenção ao suicídio</a>
            </div>
          </div>
            <div class="dropdown">
              <button class="dropdown-button">Rede de Apoio</button>
              <div class="dropdown-content">
                  <a href="#">Onde buscar ajuda</a>
                  <a href="#">Quem somos</a>
                  <a href="#">Fale conosco</a>
              </div>
    
        </div>
        <button class="custom-button">Relatos/Depoimentos</button>
        <button class="custom-button">Relatórios</button>
        <button class="custom-button">Diário Privado</button>
        <button class="custom-button">Perfil</button>
    </div>
      </header>

 <div class="diario">
        <h1>Editar Desabafo</h1>
        <form action="editar_desabafos.php" method="POST">
            <textarea name="desabafo" placeholder="Digite seu desabafo aqui"><?php echo $desabafo; ?></textarea>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Salvar">
            <a href="tela_diarioprivado.php" class="cancelar-link">Cancelar</a>
        </form>
    </div>
</body>
</html>

