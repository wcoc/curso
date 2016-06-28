<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retorno
 *
 * @author Willian
 */
class Retorno {
    
    private $erro;
    private $mensagem;
    private $codigo;
    
    public function __construct($erro = null, $mensagem = null, $codigo = null) {
        $this->erro = $erro;
        $this->mensagem = $mensagem;
        $this->codigo = $codigo;
    }
    
    function getErro() {
        return $this->erro;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function setErro($erro) {
        $this->erro = $erro;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    
    public function __toString() {
        $array = [
                    "codigo" => $this->getCodigo(),
                    "mensagem" => $this->getMensagem(),
                    "erro" => $this->getErro()
                ];
        return json_encode( $array );
    }
}
