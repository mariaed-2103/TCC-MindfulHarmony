$(document).ready(function(){

    $('#email').click(function(){
        if($(this).val() == "name@example.com"){
            $(this).val('');
        }
    });

    $('#senha').click(function(){
        if($(this).val() == "senha"){
            $(this).val('');
        }
    });

    $('#botaoLogar').click(function(){
        var email = $('#email').val();
        var senha = $('#senha').val();

        if(email == ''){
            $('#mensagem').html("Email não pode estar em branco");
            $('#mensagem').fadeIn(300).delay(2000).fadeOut(400);
        } else if (!isValidEmail(email)) {
            $('#mensagem').html("Email inválido");
            $('#mensagem').fadeIn(300).delay(2000).fadeOut(400);
        } else if (senha == '') {
            $('#mensagem').html("Senha não pode estar em branco");
            $('#mensagem').fadeIn(300).delay(2000).fadeOut(400);
        } else if (!isValidLogin(email, senha)) {
            $('#mensagem').html("Credenciais de login inválidas");
            $('#mensagem').fadeIn(300).delay(2000).fadeOut(400);
        }
    });

    // Função para validar o formato de email
    function isValidEmail(email) {
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Função para verificar as credenciais de login
    function isValidLogin(email, senha) {
        // Aqui você deve verificar se o email e a senha correspondem a um conjunto de credenciais válido.
        // Por exemplo, você pode compará-los com um banco de dados de usuários ou credenciais fixas.
        // Neste exemplo simples, estamos usando credenciais fixas:
        return (email === "name@example.com" && senha === "senha");
    }

    $('.verSenha').click(function(){
        let entrada = document.querySelector('#senha');
        if(entrada.getAttribute('type') == 'password'){
            entrada.setAttribute('type', 'text');
        }
        else{
            entrada.setAttribute('type', 'password');
        }
    });
});
