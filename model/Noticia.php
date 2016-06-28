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
        return $this->usuario;
    }

    function getCategoria() {
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


    
}