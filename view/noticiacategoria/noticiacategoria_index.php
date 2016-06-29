<?php
require_once("../header-adm.php");
require_once(BASEPATH . "/model/NoticiaCategoria.php");
require_once(BASEPATH . "/controller/NoticiaCategoriaController.php");

$descricao = null;
if(isset($_GET['descricao'])){
    if(!empty($_GET['descricao'])){
        $descricao = $_GET['descricao'];
    }
}

$categorias = NoticiaCategoria::getCategorias($descricao, true);
?>

<div id="wrapper">
    <?php require("../menu-adm.php"); ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gerenciar Categorias de Notícia</h1> 
                </div>
            </div>
            
            <div class="row">
                    <div class="col-lg-12">
                        <div class="jumbotron">
                            <p> Filtrar dados </p>

                            <form method="GET">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input class="form-control input-mg" type="text" name="descricao" placeholder="Descrição" value="" />
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-default" type="submit" >
                                    <span class="fa fa-arrow-left"></span> Filtrar Dados
                                </button>
                            </form>
                    </div>  
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Categorias</div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><i class="fa fa-anchor"></i> ID</th>
                            <th><i class="fa fa-text-height"></i> Descrição</th>
                            <th><i class="fa fa-calendar"></i> Data de Cadastro</th>
                            <th><i class="fa fa-edit"></i> Ferramentas</th>
                        </tr>
                    </thead>
                    
                    <?php if($categorias != null){ ?>
                        <?php foreach($categorias as $categoria){ ?>
                            <?php if($categoria->getStatus() == 0){ ?>
                                <tr class="danger">
                            <?php }else{ ?>
                                <tr>
                            <?php } ?>
                                    <td><?= $categoria->getId(); ?></td>
                                    <td><?= $categoria->getDescricao(); ?></td>
                                    <td><?= $categoria->getData_cadastro()->format("d/m/Y H:i:s"); ?></td>
                                    <td>
                                        <a href="view/noticiacategoria/noticiacategoria.php?noticiacategoria_id=<?= $categoria->getId(); ?>">Editar</a>
                                    </td>
                                </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="4">Nenhum registro encontrado!</td>
                        </tr>
                    <?php } ?>
                    
                </table>
            </div>
            
            <?php NoticiaCategoriaController::imprime_paginacao($descricao); ?>
        </div>
    </div>
</div>

<script src="view/js/noticiacategoria.js"></script>
<?php require_once('../footer-adm.php'); ?>
