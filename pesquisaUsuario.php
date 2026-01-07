<?php
    include "conexao.php";
   session_start();
    //recebendo os dados que foram digitados no formulario

    $email=filter_input(INPUT_POST, 'e', FILTER_SANITIZE_EMAIL);
    $senha=filter_input(INPUT_POST, 's', FILTER_SANITIZE_SPECIAL_CHARS);

    $comandoSql = "select id_usuario from usuario where email_usuario='$email' and senha_usuario='$senha'";

    $resultado = $pdo->query($comandoSql);
    if ($linha = $resultado->fetch(PDO::FETCH_ASSOC)){
        echo "$linha[id_usuario]";
       $_SESSION['id_usuario'] = $linha ['id_usuario'];
        //echo "nome: {$linha['nome_usuario']} tipo: {$linha['tipo_usuario']}";
        //echo "Usuario encontrado";

    }
    //else
    //echo "Usuario nao encontrado";
  
?>
