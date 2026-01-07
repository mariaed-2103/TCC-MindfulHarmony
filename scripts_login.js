// scripts_login.js

$(document).ready(function(){
    $('#email').click(function(){
        if($(this).val()=="email"){
            $(this).val('');
        }
    });

    $('#senha').click(function(){
        if($(this).val()=="senha"){
            $(this).val('');
        }
    });

    $('#botaoLogar').click(function(){
        if($('#email').val()=='' || $('#email').val()=="email"){
            showCustomAlert("Email inválido");
        } else if ($('#senha').val()=='' || $('#senha').val()=="senha" ){
            showCustomAlert("Senha inválida");
        } else {
            // Dados válidos, continue com o restante do seu código
            var dados = {
                e: $('#email').val(),
                s: $('#senha').val()
            };

            $.post('pesquisaUsuario.php', dados, function(retornaUsuario){
                if(retornaUsuario!="") {
                    window.location.replace("tela_abertura2.html?id="+retornaUsuario);
                } else {
                    showCustomAlert("Usuário não encontrado ou dados incorretos");
                }
            });
        }
    });
});
