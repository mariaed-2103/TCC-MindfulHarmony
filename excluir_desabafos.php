<?php
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

// Verificar se o ID foi fornecido e é um número inteiro válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para excluir o desabafo com base no ID
    $sql = "DELETE FROM tb_diario WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Exclusão bem-sucedida
            session_start();
            $_SESSION['delete_message'] = "Desabafo excluído com sucesso!";
        } else {
            // Erro ao excluir
            $_SESSION['delete_message'] = "Erro ao excluir o desabafo: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Erro na preparação da consulta
        $_SESSION['delete_message'] = "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    // ID inválido ou não fornecido
    $_SESSION['delete_message'] = "ID inválido ou não fornecido.";
}

// Fechar a conexão
$conn->close();

// Redirecionar de volta para a página de desabafos
header("Location: tela_diarioprivado.php");
exit();
?>
