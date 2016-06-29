<?php require("../header-site.php"); ?>
<?php require_once(BASEPATH . "/model/NoticiaCategoria.php"); ?>


<?php 
$categoriaAtual = null;

if(isset($_GET['categoria'])){
    $categoriaAtual = $_GET['categoria'];
}
$categorias = NoticiaCategoria::getCategoriasAtivas(); 

?>
<?php require("../menu-site.php"); ?>

<!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Categorias</p>
                <div class="list-group">
                    <a href="view/home/principal.php" class="list-group-item <?= $categoriaAtual == null ? "active" : ""; ?>">Geral</a>
                    <?php if($categorias != null){
                        foreach($categorias as $categoria){ ?>
                            <a href="view/home/principal.php?categoria=<?= $categoria->getId(); ?>" class="list-group-item <?= $categoria->getId() == $categoriaAtual ? "active" : ""; ?>"><?= $categoria->getDescricao(); ?></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-md-9">
                
                <div class="main-content">
                    <div class="main-interno page-noticias">
                        <ul class="noticias-lista">
                            <li class="row">
                                <div class="col-xs-3">
                                    <img src="#">
                                </div>
                                <div class="col-xs-6">
                                    <span>20 de Junho de 2016 às 13:50:14</span>
                                    <a href="#"><h3> Título </h3></a>
                                    
                                    <p class="hidden-xs">Conteudo....</p>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-xs-3">
                                    <img src="#">
                                </div>
                                <div class="col-xs-6">
                                    <span>20 de Junho de 2016 às 13:50:14</span>
                                    <a href="#"><h3> Título </h3></a>
                                    
                                    <p class="hidden-xs">Conteudo....</p>
                                </div>
                            </li>
                            <li class="row">
                                <div class="col-xs-3">
                                    <img src="#">
                                </div>
                                <div class="col-xs-6">
                                    <span>20 de Junho de 2016 às 13:50:14</span>
                                    <a href="#"><h3> Título </h3></a>
                                    
                                    <p class="hidden-xs">Conteudo....</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="pagination pagination-md">
                    <li>
                        <a href="#">« Anterior</a>
                    </li>
                    <li class="disabled">
                        <a href="#"> Página 1 de 2 </a> 
                    </li>
                    <li>
                        <a href="#">Próximo »</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <!-- /.container -->


<?php require("../footer-site.php");