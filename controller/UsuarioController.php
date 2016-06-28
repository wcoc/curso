<?php
require_once("Autoload.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['usuario'])){
        
        switch($_POST['usuario']){
            
            case "login":
                session_start();
                if(isset($_SESSION['usuario'])){
                    $retorno = new Retorno(FALSE, "Usuário já está logado", 0);
                    exit($retorno);
                }else{
                    $p = $_POST;
                    $login = $p['login'];
                    $senha = md5($p['senha']);
                    
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
    
    
    public function login($login, $senha){
        $retorno = $this->valida_login($login, $senha);
        if($retorno->getErro()){
            return $retorno;
        }else{
            session_start();
            $usuario = new Usuario();
            $usuario = $usuario->getUsuarioByLogin($login);
            $_SESSION['login'] = $usuario->getLogin();
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['senha'] = $usuario->getSenha();
            
            return $retorno;
        }
    }
    
    private function valida_login($login, $senha){
        $con = Conexao::getConexao();
        
        try{
            $selLogin = "SELECT id, login, senha FROM usuario WHERE login = ? 
                            LIMIT 1";
            $pstmt = $con->prepare($selLogin);
            
            $pstmt->bind_param("s", $login);
            $pstmt->execute();
            
            if($pstmt->num_rows > 0){
                $result = $pstmt->get_result();
                $usuarioBD = $result->fetch_assoc();
                
                $senhaBD = $usuarioBD['senha'];
                if($senhaBD == $senha){
                    return new Retorno(false, "Logando...", 0);
                }
            }else{
                return new Retorno(TRUE, "Usuário não cadastrado no sistema!", 2);
            }
        } catch (Exception $ex) {
            return new Retorno(TRUE, "Não foi possível realizar a consulta!\n "
                    . $ex, 1);
        } finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
}
