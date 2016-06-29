<?php
require_once("Autoload.php");
require_once(BASEPATH . "/util/FileUtil.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['noticia'])){
        
        switch($_POST['noticia']){
            
            case "inserir":
                
                $p = $_POST;
                $f = $_FILES;
                
                if($f['inputFile']['size'] > 0){
                    $retUpload = FileUtil::upload_file($f, "/view/upload/");
                    if(!$retUpload->getErro()){
                        $ctrl = new NoticiaController();

                        $noticia = new Noticia();
                        $noticia->setTitulo($p['inputTitulo']);
                        $noticia->setIntroducao($p['inputIntroducao']);
                        $noticia->setConteudo($p['inputConteudo']);
                        $noticia->setStatus($p['inputStatus']);
                        $noticia->setCategoria_id($p['inputCategoria']);
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $noticia->setThumbnail($retUpload->getMensagem());
                        $noticia->setUsuario_id($_SESSION['usuario_id']);
                        
                        $retInsere = $ctrl->insere($noticia);
                        exit($retInsere);
                    }else{
                        exit($retUpload);
                    }
                }else{
                    exit(new Retorno(true, "O Thumbnail é obrigatório para o cadastro de notícia!", 2));
                }
                
            case "atualizar":
                
                break;
            
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NoticiaController{
    
    public function __construct() {
        ;
    }
    
    public function insere($noticia){
        if($noticia != null){
            return $noticia->salvar();
        }else{
            return new Retorno(true, "Dados inválidos!");
        }
    }
    
    public function atualiza($noticia){
        if($noticia != null){
            return $noticia->atualizar();
        }else{
            return new Retorno(true, "Dados inválidos!");
        }
    }
}