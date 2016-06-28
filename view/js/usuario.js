/**
 * Metódo responsável por buscar o login e senha do usuário digitado no campos.
 * Envia os dados para o controller de Usuario.
 * 
 * @returns json no formato do objeto Retorno, contendo os dados de erro/sucesso
 *  e uma mensagem para informar o usuário. Caso o login seja realizado com sucesso.
 *  o usuário será redirecionado para a página home da área administativa.
 *  
 */
function login(){
    
    /** 
     * $("#inputLogin") o simbolo `#` significa acessar um atributo html pelo id
     * ou seja, estou acessando um input do html no formato 
     * por exemplo de <input id='inputLogin'/>
    **/
    var login = $("#inputLogin").val();
    var senha = $("#inputSenha").val();
    
    // `$` aqui no javascript, significa que estou acessando funções do framework jQuery
    $.post("controller/UsuarioController.php",{
        usuario: "login", 
        /**
         * aqui o primeiro valor, significa qual o nome do campo 
         * que será enviado no controller, neste caso, será acessivel por:
         * $_POST['login_usuario']; $_POST['senha_usuario']; e $_POST['usuario'];
         * 
         * e o segundo valor, significa qual o valor deste campo com o nome.
         * por exemplo, se eu quiser enviar um nome para o controller, seria assim:
         * 
         * nome: "Willian Colognesi" (desta forma o $_POST['nome'] no PHP, teria o valor de "Willian Colognesi".
         */
        login_usuario: login,
        senha_usuario: senha
    }, function(data){// data, é o retorno que o Controller estará dando para a View. 
        console.log(data); // printa no console do navegador o retorno do controller.
        
        // converto a String do retorno para um objeto do tipo JSON.
        var result = $.parseJSON(data);
        
        // pego a div com id `retorno` para printar os retornos do controller nela.
        var div = $("#retorno"); 
        
        /** 
          caso o controller retorno TRUE no atributo de ERRO lá no model do tipo `Retorno`.
          eu coloco uma classe 'alert alert-danger' que vem do boostrap
          para deixar o campo em vermelho, poir significa que tem algo de errado.
    
          depois printo a mensagem que veio do meu objeto Retorno do Controller
          dentro da div, para que o usuário possa ver a mensagem.
    
          e removo o atributo `hidden` da div que serve para esconder 
          a div até que o usuário clique no botão logar.
        **/
        if(result.erro){
            div.attr("class", "alert alert-danger");
            div.html("Atenção " + result.mensagem);
            div.removeAttr("hidden");
        }else{
            // caso não tenha erro, redireciono o usuário para a tela home.
            location.href = "view/admin/home.php";
        }
    });
}