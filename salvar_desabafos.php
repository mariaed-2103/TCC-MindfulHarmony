<?php
include "conexao.php";
session_start();

// Verifique se o usuário está autenticado e tem uma sessão válida
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Recebendo os dados que foram digitados no formulário
    $desabafo = filter_input(INPUT_POST, 'desabafo', FILTER_SANITIZE_STRING);
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $hora = filter_input(INPUT_POST, 'hora', FILTER_SANITIZE_STRING);

    // Usando uma consulta preparada para inserir o desabafo na tabela
    $comandoSql = "INSERT INTO tb_diario (id_usuario, desabafo, data, hora) VALUES (:id_usuario, :desabafo, :data, :hora)";
    $stmt = $pdo->prepare($comandoSql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':desabafo', $desabafo);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':hora', $hora);

    if ($stmt->execute()) {
        // A inserção foi bem-sucedida, então defina a mensagem de sucesso na variável de sessão
        $_SESSION['mensagem'] = "Desabafo salvo com sucesso!";
    } else {
        // Se ocorrer um erro, defina a mensagem de erro na variável de sessão
        $_SESSION['mensagem'] = "Erro ao salvar o desabafo: " . $stmt->errorInfo()[2];
    }

    // Redirecione de volta para a página de diário
    header('Location: tela_diarioprivado.php');
} else {
    echo "Você não está autenticado. Faça login primeiro.";
}
?>

