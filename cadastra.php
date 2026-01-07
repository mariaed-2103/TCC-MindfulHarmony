<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valide se os campos são preenchidos
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha)) {
        // Realize o cadastro no banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mindful_harmony";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $comandoSql = "INSERT INTO usuario (nome_usuario, email_usuario, telefone_usuario, senha_usuario) VALUES (:nome, :email, :telefone, :senha)";

            $stmt = $pdo->prepare($comandoSql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':senha', $senha);

            if ($stmt->execute()) {
                // Cadastro bem-sucedido
                echo "Cadastrado com sucesso";
            } else {
                echo "Erro no cadastro";
            }
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }

        // Encerre a conexão com o banco de dados
        $pdo = null;
    } else {
        echo "Preencha todos os campos";
    }
}
?>
