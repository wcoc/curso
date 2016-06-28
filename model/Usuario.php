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

    public function getUsuarioByLogin($login){
        $con = Conexao::getConexao();
        
        $selUsuario = "SELECT id, nome, login, senha, data_cadastro 
                        FROM usuario WHERE login = ? LIMIT 1";
        $pstmt = $con->prepare($selUsuario);
        $pstmt->bind_param("s", $login);
        
        $pstmt->execute();
        if($pstmt->num_rows > 0){
            $result = $pstmt->get_result();
            $usuarioBD = $result->fetch_assoc();
            
            $this->setId($usuarioBD['id']);
            $this->setNome($usuarioBD['nome']);
            $this->setLogin($usuarioBD['login']);
            $this->setSenha($usuarioBD['senha']);
            $this->setData_cadastro(new DateTime($usuarioBD['data_cadastro']));
            
            return $this;
        }else{
            return null;
        }
    }
    
}