<?php
require_once(BASEPATH . "/controller/Autoload.php");

const ERRO_PERMISAO = "<center>Você não possui permissão para acessar este recurso!</center>";

if(!isset($_SESSION['login'])){
    echo ERRO_PERMISAO;
    exit();
}else{
    $login = $_SESSION['login'];
    $senha = $_SESSION['senha'];
    require_once(BASEPATH . "/model/Usuario.php");
    
    $usuarioLogin = Usuario::getUsuarioByLogin($login);
    if($usuarioLogin == null){
        echo ERRO_PERMISAO;
        exit();
    }else if($usuarioLogin->getSenha() != $senha){
        echo ERRO_PERMISAO;
        exit();
    }
}