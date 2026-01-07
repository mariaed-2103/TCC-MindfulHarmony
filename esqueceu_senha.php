<?php
session_start(); // Certifique-se de iniciar a sessão no início do script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verifique se as senhas correspondem e atendem aos critérios de segurança
    if ($nova_senha === $confirmar_senha) {
        // Exemplo de conexão com o banco de dados (substitua com suas próprias credenciais)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mindful_harmony";

        // Crie uma conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifique a conexão
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Consulta SQL para atualizar a senha
        $sql = "UPDATE usuario SET senha_usuario = ? WHERE email_usuario = ?";
        
        // Prepare a consulta
        $stmt = $conn->prepare($sql);

        // Vincule os parâmetros
        $stmt->bind_param("ss", $nova_senha, $email);

        if ($stmt->execute()) {
            // Defina uma mensagem de sucesso na sessão
            $_SESSION['mensagem'] = "Senha redefinida com sucesso!";
        } else {
            // Defina uma mensagem de erro na sessão
            $_SESSION['mensagem'] = "Erro ao redefinir senha: " . $stmt->error;
        }

        // Feche a declaração e a conexão
        $stmt->close();
        $conn->close();

        // Redirecione de volta para a página "tela_login.php" ou para qualquer outra página desejada
        header("Location: tela_login.php");
        exit;
    } else {
        $_SESSION['mensagem'] = "As senhas não correspondem. Tente novamente.";

        // Redirecione de volta para a página "tela_esqueceu_senha.php" em caso de erro
        header("Location: tela_esqueceu_senha.php");
        exit;
    }
}

// ... (seu código existente) ...
?>
