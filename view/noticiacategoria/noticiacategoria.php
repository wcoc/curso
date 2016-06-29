<?php
require_once("../header-adm.php");
require_once(BASEPATH . "/model/NoticiaCategoria.php");

$categoria = new NoticiaCategoria();
if(isset($_GET['noticiacategoria_id'])){
    $categoria = NoticiaCategoria::getNoticiaCategoria($_GET['noticiacategoria_id']);
    if($categoria == null){
        header("Location: noticiacategoria_index.php");
    }
}
?>

<div id="wrapper">
    <?php require("../menu-adm.php"); ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adicionar/Editar Categoria de Notícia</h1> 
                </div>
            </div>
            
            <div id="div-retorno"></div>
            
            <form class="form-horizontal" id="form-addcategoria" onsubmit="return false;">
                
                <div class="form-group">
                    <label for="inputDescricao" class="control-label col-xs-3">Descrição</label>
                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="inputDescricao" placeholder="Digite a descrição da categoria." value="<?= $categoria->getDescricao(); ?>" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="inputStatus" class="control-label col-xs-3">Status</label>
                    <div class="col-xs-6">
                        <select class="form-control" id="inputStatus">
                            <option value="1" <?= $categoria->getStatus() == 1 ? "selected" : ""; ?> >Ativo</option>
                            <option value="0" <?= $categoria->getStatus() == 0 ? "selected" : ""; ?> >Inativo</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div clas="col-xs-offset-3 col-xs-9">
                        <button type="submit" class="btn btn-primary" onclick="return registrar_categoria();">
                            <span class="fa fa-save"></span> Salvar Dados
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script src="view/js/noticiacategoria.js"></script>
<?php require_once('../footer-adm.php'); ?>
