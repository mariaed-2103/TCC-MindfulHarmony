<?php
// Inicie a sessão
session_start();

// Configuração da conexão com o banco de dados (substitua pelos seus próprios valores)
$servername = "localhost";
$username = "root";
$password = "";
$database = "mindful_harmony";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Captura e valida os dados do formulário
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$id_usuario = $_POST['id_usuario'];
$nome_usuario = $_POST['nome_usuario'];

// Sanitizar os dados para evitar injeção de SQL
$assunto = mysqli_real_escape_string($conn, $assunto);
$mensagem = mysqli_real_escape_string($conn, $mensagem);
$nome_usuario = mysqli_real_escape_string($conn, $nome_usuario);

// Prepara a instrução SQL para inserir os dados na tabela fale_conosco
$sql = "INSERT INTO fale_conosco (assunto, mensagem, id_usuario, nome_usuario) VALUES (?, ?, ?, ?)";

// Prepara a declaração
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Vincula os parâmetros à declaração
    $stmt->bind_param("ssis", $assunto, $mensagem, $id_usuario, $nome_usuario);

    // Executa a declaração
    if ($stmt->execute()) {
        // Defina uma mensagem de sucesso na sessão
        $_SESSION['mensagem'] = "Mensagem enviada com sucesso!";
    } else {
        // Defina uma mensagem de erro na sessão
        $_SESSION['mensagem'] = "Erro no envio da mensagem: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
} else {
    // Defina uma mensagem de erro na sessão se houver erro na preparação da declaração
    $_SESSION['mensagem'] = "Erro na preparação da declaração: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();

// Redirecione de volta para a página "tela_apresentacao.php"
header("Location: tela_apresentacao.php");
exit;
?>
