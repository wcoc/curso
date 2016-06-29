<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario{
    
    private $id;
    private $nome;
    private $login;
    private $email;
    private $senha;
    private $data_cadastro;
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

        
    /**
     * Metodo responsável por buscar um usuario pelo login
     * 
     * @param String $login login do usuário a ser buscado no banco de dados
     * @return \Usuario
     */
    public static function getUsuarioByLogin($login){
        $con = Conexao::getConexao();
        
        // Select para buscar usuário no banco de dados pelo login,
        // o `?` indica que será um parametro setado posteriormente pelo PHP.
        
        $selUsuario = "SELECT id, nome, login, senha, data_cadastro 
                        FROM usuario WHERE login = ? LIMIT 1";
        
        // coloco para preparar o select para execução no banco de dados.
        $pstmt = $con->prepare($selUsuario);
        
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
            
            // instancio uma nova classe Model do Usuario e preencho os respectivos valores.
            $usuario = new Usuario();
            $usuario->setId($usuarioBD['id']);
            $usuario->setNome($usuarioBD['nome']);
            $usuario->setLogin($usuarioBD['login']);
            $usuario->setSenha($usuarioBD['senha']);
            $usuario->setData_cadastro(new DateTime($usuarioBD['data_cadastro']));
            
            return $usuario;
        }else{
            return null;
        }
    }
    
    public static function getUsuario($id){
        $con = Conexao::getConexao();
        
        // Select para buscar usuário no banco de dados pelo login,
        // o `?` indica que será um parametro setado posteriormente pelo PHP.
        
        $selUsuario = "SELECT id, nome, login, senha, data_cadastro 
                        FROM usuario WHERE id = ? LIMIT 1";
        
        // coloco para preparar o select para execução no banco de dados.
        $pstmt = $con->prepare($selUsuario);
        
        // o primeiro parametro indica qual o tipo do parametro,
        // e o segundo o valor que irá substituir o `?` do select.
        // 
        // s= String; i= inteiro; d= double/float.
        $pstmt->bind_param("i", $id);
        
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
            
            // instancio uma nova classe Model do Usuario e preencho os respectivos valores.
            $usuario = new Usuario();
            $usuario->setId($usuarioBD['id']);
            $usuario->setNome($usuarioBD['nome']);
            $usuario->setLogin($usuarioBD['login']);
            $usuario->setSenha($usuarioBD['senha']);
            $usuario->setData_cadastro(new DateTime($usuarioBD['data_cadastro']));
            
            return $usuario;
        }else{
            return null;
        }
    }
    
}