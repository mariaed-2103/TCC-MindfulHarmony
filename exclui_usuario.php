<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Exclusão de cliente</title>
  </head>
  <body>

    <h3> Exclusão do Usuario </h3>
    <?php
require "conexao.php";

if (isset($_GET["id_usuario"])) {
    $id_usuario = $_GET["id_usuario"];

    // Desativar temporariamente a verificação de chave estrangeira
    $desativarChaveEstrangeiraSql = "SET FOREIGN_KEY_CHECKS=0";
    $stmtDesativarChaveEstrangeira = $pdo->prepare($desativarChaveEstrangeiraSql);
    $stmtDesativarChaveEstrangeira->execute();

    // Excluir o usuário
    $comandoSqlUsuario = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
    $stmtUsuario = $pdo->prepare($comandoSqlUsuario);
    $stmtUsuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

    if ($stmtUsuario->execute()) {
        echo "Usuário excluído com sucesso.";
        
        // Redirecionar para tela_abertura1.html após a exclusão
        echo "<script>window.location.href = 'tela_abertura1.html';</script>";
    } else {
        echo "Erro na exclusão do usuário.";
    }

    // Reativar a verificação de chave estrangeira
    $reativarChaveEstrangeiraSql = "SET FOREIGN_KEY_CHECKS=1";
    $stmtReativarChaveEstrangeira = $pdo->prepare($reativarChaveEstrangeiraSql);
    $stmtReativarChaveEstrangeira->execute();
} else {
    echo "ID de usuário não especificado.";
}
?>




  </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
