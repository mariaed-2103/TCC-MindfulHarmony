<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=mindful_harmony', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES utf8'); // Defina o conjunto de caracteres, se necessário
} catch (PDOException $e) {
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
    // Você pode adicionar mais lógica aqui para lidar com o erro, se necessário.
}
?>
