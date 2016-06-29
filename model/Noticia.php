<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Noticia{
    
    private $id;
    private $titulo;
    private $conteudo;
    private $introducao;
    private $thumbnail;
    private $data_cadastro;
    private $usuario_id;
    private $categoria_id;
    private $status;
    
    private $usuario;
    private $categoria;
    
    
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function getIntroducao() {
        return $this->introducao;
    }

    function getThumbnail() {
        return $this->thumbnail;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getUsuario() {
        if($this->usuario == null){
            $this->usuario = Usuario::getUsuario($this->usuario_id);
        }
        return $this->usuario;
    }

    function getCategoria() {
        if($this->categoria == null){
            $this->categoria = NoticiaCategoria::getNoticiaCategoria($this->categoria_id);
        }
        return $this->categoria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    function setIntroducao($introducao) {
        $this->introducao = $introducao;
    }

    function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    
    public function validar(){
        if($this->titulo == null){
            throw new Exception("O campo Título, não pode ser vazio/nulo!");
        }
        if($this->categoria_id == null){
            throw new Exception("A categoria da notícia, não pode ser vazia/nula!");
        }
        if($this->conteudo == null){
            throw new Exception("O conteúdo da notícia não pode ser vazio/nulo!");
        }
        if($this->status == null){
            throw new Exception("O status da notícia não pode ser vazio/nulo!");
        }
        if($this->thumbnail == null){
            throw new Exception("O thumbnail da notícia não pode ser vazio/nulo!");
        }
    }
    
    public function salvar(){
        $con = Conexao::getConexao();
        
        try{
            $this->validar();
            $insert = "INSERT INTO noticia 
                    SET titulo = ?, introducao = ?, conteudo = ?, thumbnail = ?,
                    status = ?, usuario_id = ?, categoria_id = ?, data_cadastro = NOW()";
            $pstmt = $con->prepare($insert);
            
            $pstmt->bind_param("ssssiii", $this->titulo, $this->introducao, 
                    $this->conteudo, $this->thumbnail, $this->status, $this->usuario_id,
                    $this->categoria_id);

            if($pstmt->execute()){
                return new Retorno(false, "Notícia cadastrada com sucesso!", 0);
            }else{
                return new Retorno(true, "Erro ao cadastrar a notícia no banco de dados!", 1);
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
            $insert = "UPDATE noticia 
                    SET titulo = ?, introducao = ?, conteudo = ?, thumbnail = ?,
                    status = ?, usuario_id = ?, categoria_id = ? WHERE id = ?";
            $pstmt = $con->prepare($insert);

            $pstmt->bind_param("ssssiiii", $this->titulo, $this->introducao, 
                    $this->conteudo, $this->thumbnail, $this->status, $this->usuario_id,
                    $this->categoria_id, $this->id);

            if($pstmt->execute()){
                return new Retorno(false, "Notícia atualizada com sucesso!", 0);
            }else{
                return new Retorno(true, "Erro ao atualizar a notícia no banco de dados!", 1);
            }
        } catch (Exception $ex) {
            return new Retorno(true, $ex->getMessage(), $ex->getCode());
        }finally{
            if($con != null){
                $con->close();
            }
        }
    }
    
    public static function getNoticia($id){
        $con = Conexao::getConexao();
        
        try{
            $selNoticia = "SELECT id, titulo, introducao, conteudo, thumbnail, status, 
                        usuario_id, categoria_id, data_cadastro 
                            FROM noticia WHERE id = ?";
            $pstmt = $con->prepare($selNoticia);

            $pstmt->bind_param("i", $id);
            $pstmt->execute();
            
            
            $pstmt->store_result();
            //$result = $pstmt->get_result();
            if($pstmt->num_rows > 0){
                //$noticiaBD = $result->fetch_assoc();
                $pstmt->bind_result($id, $titulo, $introducao, $conteudo,
                                    $thumbnail, $status, $usuario_id, $categoria_id,
                                    $data_cadastro);
                $pstmt->fetch();
                
                $noticia = new Noticia();
                $noticia->setId($id);
                $noticia->setTitulo($titulo);
                $noticia->setIntroducao($introducao);
                $noticia->setConteudo($conteudo);
                $noticia->setData_cadastro($data_cadastro);
                $noticia->setThumbnail($thumbnail);
                $noticia->setStatus($status);
                $noticia->setUsuario_id($usuario_id);
                $noticia->setCategoria_id($categoria_id);
                
                return $noticia;
            }else{
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }finally{
            if($con != null){
                $con->close();
            }
        }
        
        
    }
}