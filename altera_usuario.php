<?php
// Verifica se uma sessão já está ativa antes de iniciar uma nova sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "conexao.php"; // Verifique o caminho do arquivo "conexao.php" para garantir que ele está correto.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_usuario = $_POST["nome"];
    $email_usuario = $_POST["email"];
    $telefone_usuario = $_POST["telefone"];
    $nova_senha = $_POST["nova-senha"];
    $repita_senha = $_POST["repita-senha"];
    $id_usuario = $_POST["id_usuario"]; // Adicione esta linha para obter o ID do usuário

    if (!empty($nome_usuario) && !empty($email_usuario) && !empty($telefone_usuario)) {
        if (empty($nova_senha) && empty($repita_senha)) {
            // Se a nova senha não foi fornecida, mantenha a senha existente no banco de dados
            $comandoSql = "UPDATE usuario SET 
                nome_usuario = :nome,
                email_usuario = :email,
                telefone_usuario = :telefone
                WHERE id_usuario = :id_usuario";
        } else if ($nova_senha === $repita_senha) {
            $comandoSql = "UPDATE usuario SET 
                nome_usuario = :nome,
                email_usuario = :email,
                telefone_usuario = :telefone,
                senha_usuario = :senha
                WHERE id_usuario = :id_usuario";
        } else {
            echo "Erro: As senhas não coincidem.";
            exit;
        }

        // Conectar ao banco de dados (substitua 'seu_host', 'seu_usuario', 'sua_senha' e 'seu_banco' pelas informações corretas)
        $conexao = new PDO("mysql:host=localhost;dbname=mindful_harmony", "root", "");

        if (!$conexao) {
            die("Falha na conexão com o banco de dados");
        }

        // Preparar a consulta SQL
        $consulta = $conexao->prepare($comandoSql);

        // Substituir os parâmetros na consulta
        $consulta->bindParam(":nome", $nome_usuario);
        $consulta->bindParam(":email", $email_usuario);
        $consulta->bindParam(":telefone", $telefone_usuario);
        if (!empty($nova_senha)) {
            $consulta->bindParam(":senha", $nova_senha);
        }
        $consulta->bindParam(":id_usuario", $id_usuario);

        if ($consulta->execute()) {
            // Defina uma mensagem de sucesso na sessão
            $_SESSION['mensagem'] = "Dados atualizados com sucesso!";
        } else {
            // Defina uma mensagem de erro na sessão
            $_SESSION['mensagem'] = "Erro na alteração de dados: " . implode(", ", $consulta->errorInfo());
        }
        
        // Redirecione de volta para a página "tela_perfil.php"
        header("Location: tela_perfil.php");
        exit;
    } else {
        echo "Campos obrigatórios do formulário não foram preenchidos corretamente.";
    }
} else {
    echo "Este script deve ser acessado por uma requisição POST.";
}
?>
