<?php
require_once("Autoload.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['noticiacategoria'])){
        
        switch($_POST['noticiacategoria']){
            
            
            case "inserir":
                $p = $_POST;
                $categoria = new NoticiaCategoria();
                $categoria->setDescricao($p['inputDescricao']);
                $categoria->setStatus($p['inputStatus']);
                
                $ctrl = new NoticiaCategoriaController();
                $retorno = $ctrl->inserir($categoria);
                exit($retorno);
            
            case "atualizar":
                $p = $_POST;
                $categoria = new NoticiaCategoria();
                $categoria->setId($p['noticiacategoria_id']);
                $categoria->setDescricao($p['inputDescricao']);
                $categoria->setStatus($p['inputStatus']);
                
                $ctrl = new NoticiaCategoriaController();
                $retorno = $ctrl->atualizar($categoria);
                exit($retorno);
                break;
        }
    }
}

class NoticiaCategoriaController{
    
    public function __construct() {
        ;
    }
    
    /**
     * 
     * @param NoticiaCategoria $categoria
     * @return type
     */
    public function inserir($categoria){
        if($categoria != null){
            return $categoria->salvar();
        }else{
            return new Retorno(TRUE, "Dados inválidos!");
        }
    }
    
    public function atualizar($categoria){
        if($categoria != null){
            return $categoria->atualizar();
        }else{
            return new Retorno(TRUE, "Dados inválidos!");
        }
    }
    
    public static function imprime_paginacao($descricao = null){
        $regTotal = NoticiaCategoria::getCountDescricao($descricao);
        $paginade = 1;
        $portPagina = ceil($regTotal/NoticiaCategoria::TOTAL_REG_PAGINACAO);
        
        if($_GET){
            if(isset($_GET['pagina'])){
                $paginade = $_GET['pagina'];
            }
        }
        
        echo '<ul class="pagination">';
        if($paginade > 1){
            echo "<li><a href='view/noticiacategoria/noticiacategoria_index.php?"
                    ."pagina=".($paginade-1)."&"
                    ."descricao=".($descricao)."'>Anterior</a></li>";
        }
        echo "<li class='disabled'><a href='#'> Página ".$paginade." de ".$portPagina."</li>";
        if($paginade < $portPagina){
            echo "<li><a href='view/noticiacategoria/noticiacategoria_index.php?"
                    ."pagina=".($paginade+1)."&"
                    ."descricao=".($descricao)."'>Próximo</a></li>";
        }
    }
}