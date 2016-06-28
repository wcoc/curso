<?php
require_once("Autoload.php");

// tipo da requisição que o controller esta recebendo.
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    /*
        verifico se existe o parametro 'usuario' na requisição post,
        para que de tal forma eu consiga saber qual tipo de requisição esta vindo
        da camada View.
     */
    if(isset($_POST['usuario'])){
        
        switch($_POST['usuario']){
            
            case "login":
                if (session_status() == PHP_SESSION_NONE) { // se a sessão ainda não foi iniciada, inicio ela.
                    session_start();
                }
                
                if(isset($_SESSION['usuario'])){
                    $retorno = new Retorno(FALSE, "Usuário já está logado", 0);
                    exit($retorno);
                }else{
                    $p = $_POST;
                    $login = $p['login_usuario'];
                    $senha = md5($p['senha_usuario']); // criptografa a senha enviada pelo formulário do usuário.
                    
                    //instancio o controller para iniciar o login do usuario.
                    $usuarioController = new UsuarioController();
                    $retorno = $usuarioController->login($login, $senha);
                    
                    exit($retorno);
                }
                
                break;
            
            case "insere":
                
                break;
            
            case "atualiza":
                
                break;
            
            case "desabilita":
                
                break;
            
        }
        
    }
    
}


/**
 * Description of UsuarioController
 *
 * @author Willian
 */
class UsuarioController {
    
    public function __construct() {
        
    }
    
    
    /**
     * Metódo responsável por validar o login do usuário e posteriormente caso
     * os dados sejam de acesso concedido, cria uma sessão com os dados do usuario
     * e retorna um objeto do tipo 'Retorno' com informações de sucesso ou erro
     * e uma mensagem para apresentar ao usuário na camada View.
     * 
     * @param type $login Login digitadp pelo usuário que veio da view.
     * @param type $senha Senha digitada pelo usuário que veio da view.
     * @return \Retorno Objeto Retorno com dados de sucesso/erro e mensagem para o usuário.
     */
    public function login($login, $senha){
        $retorno = $this->valida_login($login, $senha);
        if($retorno->getErro()){
            return $retorno;
        }else{
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $usuario = Usuario::getUsuarioByLogin($login); // busco o objeto do usuário no banco de dados.
            
            /* Crio a sessão com dados du usário logado. */
            $_SESSION['login'] = $usuario->getLogin();
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['senha'] = $usuario->getSenha();
            
            return $retorno;
        }
    }
    
    private function valida_login($login, $senha){
        $con = Conexao::getConexao();
        
        try{
            // Select para buscar usuário no banco de dados pelo login,
            // o `?` indica que será um parametro setado posteriormente pelo PHP.
            $selLogin = "SELECT id, login, senha FROM usuario WHERE login = ? 
                            LIMIT 1";
            
            // coloco para preparar o select para execução no banco de dados.
            $pstmt = $con->prepare($selLogin);
            
            // o primeiro parametro indica qual o tipo do parametro,
            // e o segundo o valor que irá substituir o `?` do select.
            // 
            // s= String; i= inteiro; d= double/float.
            $pstmt->bind_param("s", $login);
            
            // executa o select no banco de dados.
            $pstmt->execute();
            
            // armazena o retorno do select em uma variavel.
            $result = $pstmt->get_result();
            
            // verifico se o retorno possui mais de uma linha.
            if($result->num_rows > 0){
                // pego o retorno do select, e utilizo a função fetch_assoc() para 
                // me retornar um array associativo, onde eu posso resgatar os valores
                // do select atraves do nome das colunas conforme abaixo.
                $usuarioBD = $result->fetch_assoc();
                
                // armazeno a senha do usuário que veio do banco de dados em uma váriavel
                $senhaBD = $usuarioBD['senha']; 
                
                // valido se a senha do usuário no banco de dados
                // é igual a senha digitada no campo de senha na camada View.
                if($senhaBD == $senha){
                    return new Retorno(false, "Logando...", 0);
                }else{
                    return new Retorno(true, "Senha incorreta!", 3);
                }
            }else{
                return new Retorno(TRUE, "Usuário não cadastrado no sistema!", 2);
            }
        } catch (Exception $ex) {
            return new Retorno(TRUE, "Não foi possível realizar a consulta!\n "
                    . $ex, 1);
        } finally{
            // verifica se a coneção não é null, e fecha a conexão.
            if($con != null){
                $con->close();
            }
        }
    }
    
}
