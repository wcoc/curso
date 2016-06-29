<?php
require_once("../header-adm.php");
require_once(BASEPATH . "/model/Noticia.php");
require_once(BASEPATH . "/model/NoticiaCategoria.php");

$titulo = null;
if(isset($_GET['titulo'])){
    if(!empty($_GET['titulo'])){
        $titulo = $_GET['titulo'];
    }
}

$noticias = Noticia::getNoticias($titulo, true);

?>

<div id="wrapper">
    <?php require("../menu-adm.php"); ?>
    
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gerenciar Notícias</h1> 
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
                                            <input class="form-control input-mg" type="text" name="titulo" placeholder="Título" value="" />
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
                <div class="panel-heading">Lista de Notícias</div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><i class="fa fa-anchor"></i> ID</th>
                            <th><i class="fa fa-text-height"></i> Título</th>
                            <th><i class="fa fa-text-height"></i> Categoria</th>
                            <th><i class="fa fa-calendar"></i> Data de Cadastro</th>
                            <th><i class="fa fa-edit"></i> Ferramentas</th>
                        </tr>
                    </thead>
                    
                    <?php if($noticias != null){ ?>
                        <?php foreach($noticias as $noticia){ ?>
                            <?php if($noticia->getStatus() == 0){ ?>
                                <tr class="danger">
                            <?php }else{ ?>
                                <tr>
                            <?php } ?>
                                    <td><?= $noticia->getId(); ?></td>
                                    <td><?= $noticia->getTitulo(); ?></td>
                                    <td><?= $noticia->getCategoria()->getDescricao(); ?></td>
                                    <td><?= $noticia->getData_cadastro()->format("d/m/Y H:i:s"); ?></td>
                                    <td>
                                        <a href="view/noticia/noticia.php?noticia_id=<?= $noticia->getId(); ?>">Editar</a>
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
            
            <?php NoticiaController::paginacao_admin($titulo); ?>
        </div>
    </div>
</div>

<script src="view/js/noticia.js"></script>
<?php require_once('../footer-adm.php'); ?>
