<?php require("../header-site.php"); ?>
<?php require_once(BASEPATH . "/model/NoticiaCategoria.php"); ?>
<?php require_once(BASEPATH . "/model/Noticia.php"); ?>
<?php require_once(BASEPATH . "/controller/NoticiaController.php"); ?>


<?php 
$categoriaAtual = null;

if(isset($_GET['categoria'])){
    $categoriaAtual = $_GET['categoria'];
}
$categorias = NoticiaCategoria::getCategoriasAtivas(); 

$noticia = Noticia::getNoticia($_GET['id']);
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
                    <h2><?= $noticia->getTitulo(); ?></h2>
                    <div class="main-interno page-noticias">
                        <p><?= $noticia->getConteudo(); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->


<?php require("../footer-site.php");