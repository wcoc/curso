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
                $p = $_POST;
                $f = $_FILES;
                $noticia = Noticia::getNoticia($p['noticia_id']);
                
                $retUpload = new Retorno();
                if($f['inputFile']['size'] > 0){
                    $retUpload = FileUtil::upload_file($f, "/view/upload/");
                    if(!$retUpload->getErro()){
                        unlink(BASEPATH . "/" . $noticia->getThumbnail());
                    }
                }
                
                if(!$retUpload->getErro() || ($f['inputFile']['size'] == 0)){
                    if(session_status() == PHP_SESSION_NONE){
                        session_start();
                    }
                    
                    $noticia->setCategoria_id($p['inputCategoria']);
                    $noticia->setTitulo($p['inputTitulo']);
                    $noticia->setConteudo($p['inputConteudo']);
                    $noticia->setStatus($p['inputStatus']);
                    $noticia->setIntroducao($p['inputIntroducao']);
                    $noticia->setUsuario_id($_SESSION['usuario_id']);
                    if($retUpload->getMensagem() != null){
                        $noticia->setThumbnail($retUpload->getMensagem());
                    }
                    
                    $ctrl = new NoticiaController();
                    exit($ctrl->atualiza($noticia));
                }
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
    
    public static function paginacao_admin($titulo = null){
        $regTotal = Noticia::getCountTitulo($titulo);
        $paginade = 1;
        $porPagina = ceil($regTotal / Noticia::TOTAL_REG_PAGINA);
        
        if($_GET){
            if(isset($_GET['pagina'])){
                $paginade = ($_GET['pagina']);
            }
        }
        
        echo "<ul class='pagination'>";
        if($paginade > 1){
            echo "<li><a href='view/noticia/noticia_index.php?"
            . "pagina=".($paginade-1).""
            . "&titulo=".($titulo)."'> Anterior</a></li>";
        }
        echo "<li class='disabled'><a href='#'> Página ".$paginade." de ".$porPagina."</a></li>";
        if($paginade < $porPagina){
            echo "<li><a href='view/noticia/noticia_index.php?"
            . "pagina=".($paginade+1).""
            . "&titulo=".($titulo)."'> Próximo</a></li>";
        }
    }
    
    public static function paginacao_site($categoria_id = null){
        $regTotal = Noticia::getCountCategoria($categoria_id);
        $paginade = 1;
        $porPagina = ceil($regTotal / Noticia::TOTAL_REG_PAGINA);
        
        if($_GET){
            if(isset($_GET['pagina'])){
                $paginade = ($_GET['pagina']);
            }
        }
        
        echo "<ul class='pagination'>";
        if($paginade > 1){
            echo "<li><a href='view/home/principal.php?"
            . "pagina=".($paginade-1).""
            . "&categoria=".($categoria_id)."'> Anterior</a></li>";
        }
        echo "<li class='disabled'><a href='#'> Página ".$paginade." de ".$porPagina."</a></li>";
        if($paginade < $porPagina){
            echo "<li><a href='view/home/principal.php?"
            . "pagina=".($paginade+1).""
            . "&categoria=".($categoria_id)."'> Próximo</a></li>";
        }
    }
}