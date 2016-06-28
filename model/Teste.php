<?php
require_once BASEPATH . '/helper/Conexao.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Teste{
    private $id;
    private $nome;
    
    public function __construct($nome = null) {
        $this->nome = $nome;;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function validate(){
        if($this->id == null){
            throw new Exception("ID não pode ser null!");
        }
    }
    
    function save(){
        $con = Conexao::getConnection();
        
        $sel = "select * from teste";
        $pstmt = $con->prepare($sel);
        $pstmt->execute();
        
        $result = $pstmt->get_result();
        
        $testeBD = $result->fetch_assoc();
        
        echo $testeBD['nome'];
    }
    
}