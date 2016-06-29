<?php
require_once (BASEPATH . "/helper/Conexao.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NoticiaCategoria{
    
    const TOTAL_REG_PAGINACAO = 5;
    
    private $id;
    private $descricao;
    private $data_cadastro;
    private $status;
    
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }
    
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
    public function validar(){
        if($this->getDescricao() == null){
            throw new Exception("O campo descrição não pode ser vazio/nulo !");
        }
        if($this->getStatus() == null){
            throw new Exception("O campo status não pode ser vazio/nulo !");
        }
    }
    
    public static function getCategorias($descricao = null, $paginacao = false){
        $con = Conexao::getConexao();
        
        $sel = "SELECT id, descricao, data_cadastro, status 
                    FROM noticia_categoria WHERE 1=1 ";
        if($descricao != null){
            $sel .= " AND LOWER(descricao) LIKE ?";
        }
        if($paginacao){
            $de = 0;
            $ate = NoticiaCategoria::TOTAL_REG_PAGINACAO;
            if(isset($_GET['pagina'])){
                $de = $_GET['pagina']-1;
            }
            $de *= NoticiaCategoria::TOTAL_REG_PAGINACAO;
            
            $sel .= " LIMIT ".$de.", ".$ate;
        }
        try{
            $pstmt = $con->prepare($sel);
            if($descricao != null){
                $desc = "%".$descricao."%";
                $pstmt->bind_param("s", $desc);
            }
            $pstmt->execute();
            //$result = $pstmt->get_result();
            $pstmt->store_result();
            
            if($pstmt->num_rows > 0){
                $pstmt->bind_result($id, $descricao, $data_cadastro, $status);
                $categorias = [];
                while($pstmt->fetch()){
                    $categoria = new NoticiaCategoria();
                    $categoria->setId($id);
                    $categoria->setDescricao($descricao);
                    $categoria->setStatus($status);
                    $categoria->setData_cadastro(new DateTime($data_cadastro));
                    
                    array_push($categorias, $categoria);
                }
                return $categorias;
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }  finally {
            if($con != null){
                $con->close();
            }
        }
    }
    
    public function salvar(){
        $con = Conexao::getConexao();
        
        try{
            $this->validar();
            $insert = "INSERT INTO noticia_categoria 
                SET descricao = ?, status = ?, data_cadastro = NOW()";
            $pstmt = $con->prepare($insert);
            
            $pstmt->bind_param("si", $this->descricao, $this->status);
            
            if($pstmt->execute()){
                return new Retorno(false, "Categoria de Notícia cadastrada com sucesso!", 0);
            }else{
                return new Retorno(true, "Não foi possível registrar a categoria no banco de dados!", 1);
            }
        } catch (Exception $ex) {
            return new Retorno(true, $ex->getMessage(), $ex->getCode());
        }finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
    public function atualizar(){
        $con = Conexao::getConexao();
        
        try{
            $this->validar();
            $insert = "UPDATE noticia_categoria 
                SET descricao = ?, status = ? WHERE id = ?";
            $pstmt = $con->prepare($insert);
            
            $pstmt->bind_param("sii", $this->descricao, $this->status, $this->id);
            
            if($pstmt->execute()){
                return new Retorno(false, "Categoria de Notícia atualizada com sucesso!", 0);
            }else{
                return new Retorno(true, "Não foi possível atualizar a categoria no banco de dados!", 1);
            }
        } catch (Exception $ex) {
            return new Retorno(true, $ex->getMessage(), $ex->getCode());
        }finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
    public static function getNoticiaCategoria($id){
        $con = Conexao::getConexao();
        
        try{
            $selCategoria = "SELECT id, descricao, data_cadastro, status 
                                FROM noticia_categoria WHERE id = ? LIMIT 1";
            $pstmt = $con->prepare($selCategoria);
            $pstmt->bind_param("i", $id);
            $pstmt->execute();
            
            //$result = $pstmt->get_result();
            $pstmt->store_result();
            if($pstmt->num_rows > 0){
                $pstmt->bind_result($id, $descricao, $data_cadastro, $status);
                $pstmt->fetch();
                //$categoriaBD = $result->fetch_assoc();
                
                $categoria = new NoticiaCategoria();
                $categoria->setId($id);
                $categoria->setDescricao($descricao);
                $categoria->setData_cadastro(new DateTime($data_cadastro));
                $categoria->setStatus($status);
                
                return $categoria;
            }
            return null;
        } catch (Exception $ex) {
            return null;
        }finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
    public static function getCountDescricao($descricao = null){
        $con = Conexao::getConexao();
        
        try{
            $selCategoria = "SELECT count(*) as registros 
                                FROM noticia_categoria WHERE 1=1 ";
            if($descricao != null){
                $selCategoria .= " AND LOWER(descricao) LIKE ?"; 
            }
            $pstmt = $con->prepare($selCategoria);
            
            if($descricao != null){
                $desc = "%".strtolower($descricao)."%";
                $pstmt->bind_param("s", $desc);
            }
            $pstmt->execute();
            
            //$result = $pstmt->get_result();
            $pstmt->store_result();
            //$catBD = $result->fetch_assoc();
            $pstmt->bind_result($registros);
            $pstmt->fetch();
            
            return $registros;
        } catch (Exception $ex) {
            return null;
        }finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
    public static function getCategoriasAtivas(){
        $con = Conexao::getConexao();
        
        try{
            $sel = "SELECT id, descricao, data_cadastro, status 
                        FROM noticia_categoria WHERE status = 1 ORDER BY descricao";
            $pstmt = $con->prepare($sel);
            $pstmt->execute();
            
            //$result = $pstmt->get_result();
            $pstmt->store_result();
            if($pstmt->num_rows > 0){
                $categorias = [];
                
                $pstmt->bind_result($id, $descricao, $data_cadastro, $status);
                
                // o metodo fetch atualizará as variáveis passadas pelo bind_result
                // para cara registro da consulta, e retornará TRUE se houver
                // mais registros, 
                // e FALSE quando não houver mais registros na consulta.
                while($pstmt->fetch()){
                    $categoria = new NoticiaCategoria();
                    $categoria->setId($id);
                    $categoria->setDescricao($descricao);
                    $categoria->setData_cadastro($data_cadastro);
                    $categoria->setStatus($status);
                    
                    array_push($categorias, $categoria);
                }
                return $categorias;
            }
            return null;
        } catch (Exception $ex) {
            return null;
        }finally{
            if($con != null){
                $con->close();
            }
        }
        
    }
    
    
}