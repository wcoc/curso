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

$noticias = Noticia::getNoticiasCategoria($categoriaAtual, true);
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
                            <?php if($noticias != null){ ?>
                                <?php foreach($noticias as $noticia){ ?>
                                    <li class="row">
                                        <div class="col-xs-3">
                                            <?php
                                            $thumb = substr($noticia->getThumbnail(), 1);
                                            ?>
                                            <img style='width:100%;' src="<?= $thumb; ?>" />
                                        </div>
                                        <div class="col-xs-6">
                                            <span>Por <?= $noticia->getUsuario()->getNome(); ?> - <?= $noticia->getData_cadastro()->format("d/m/Y H:i:s"); ?></span>
                                            <a href="view/home/noticia_view.php?id=<?= $noticia->getId(); ?>"><h3> <?= $noticia->getTitulo(); ?></h3></a>

                                            <p class="hidden-xs"><?= $noticia->getIntroducao(); ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <?php NoticiaController::paginacao_site($categoriaAtual); ?>
            </div>
        </div>

    </div>
    <!-- /.container -->


<?php require("../footer-site.php");
