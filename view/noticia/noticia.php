<?php
require_once("../header-adm.php");
require_once(BASEPATH . "/model/NoticiaCategoria.php");
require_once(BASEPATH . "/model/Noticia.php");

$noticia = new Noticia();
$categorias = NoticiaCategoria::getCategoriasAtivas();
if(isset($_GET['noticia_id'])){
//    $categoria = NoticiaCategoria::getNoticiaCategoria($_GET['noticiacategoria_id']);
//    if($categoria == null){
//        header("Location: noticiacategoria_index.php");
//    }
}
?>

<div id="wrapper">
    <?php require("../menu-adm.php"); ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adicionar/Editar Notícia</h1> 
                </div>
            </div>
            
            <div id="div-retorno"></div>
            
            <form class="form-horizontal" id="form-noticiaadd">
                
                <div class="form-group">
                    <label for="inputTitulo" class="control-label col-xs-3">Título</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="inputTitulo" id="inputTitulo" placeholder="Digite o título da notícia." value="<?= $noticia->getTitulo(); ?>" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputIntroducao" class="control-label col-xs-3">Introdução</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" name="inputIntroducao" id="inputIntroducao" placeholder="Digite uma introdução para a notícia." value="<?= $noticia->getIntroducao(); ?>" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputCategoria" class="control-label col-xs-3">Categoria</label>
                    <div class="col-xs-6">
                        <select class="form-control" name="inputCategoria" id="inputCategoria" >
                            <option value="">Selecione uma categoria para a notícia</option>
                            <?php foreach($categorias as $categoria){ ?>
                                <option value="<?= $categoria->getId(); ?>" <?= $categoria->getId() == $noticia->getCategoria_id() ? "selected" : ""; ?> ><?= $categoria->getDescricao(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputConteudo" class="control-label col-xs-3">Conteúdo</label>
                    <div class="col-xs-6">
                        <textarea type="text" class="form-control" name="inputConteudo" id="inputConteudo" ></textarea> 
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputFile" class="control-label col-xs-3">Thumbnail</label>
                    <div class="col-xs-6">
                        <input type="file" class="form-control" name="inputFile" id="inputFile"  >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputStatus" class="control-label col-xs-3">Status</label>
                    <div class="col-xs-6">
                        <select class="form-control" id="inputStatus">
                            <option value="1" <?= $noticia->getStatus() == 1 ? "selected" : ""; ?> >Ativo</option>
                            <option value="0" <?= $noticia->getStatus() == 0 ? "selected" : ""; ?> >Inativo</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div clas="col-xs-offset-3 col-xs-9">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> Salvar Dados
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script src="view/bower_components/tinymce/js/tinymce/tinymce.min.js"></script>

<?php 
require_once('../footer-adm.php');
?>
<script src="view/js/noticia.js"></script>
