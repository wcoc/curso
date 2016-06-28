<!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Unifil</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" onclick="teste();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="view/admin/home.php" target="_parent"><i class="fa fa-home"></i> Home</a>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Notícias</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="view/noticia/noticia_add.php">
                            <span class="fa fa-plus"></span> Adicionar Notícia
                        </a>
                    </li>
                    <li>
                        <a href="view/noticia/noticia_index.php">
                            <span class="fa fa-th-list"></span> Gerenciar Notícias
                        </a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Categoria de Notícia</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="view/noticiacategoria/noticiacategoria_add.php">
                            <span class="fa fa-plus"></span> Adicionar Categoria
                        </a>
                    </li>
                    <li>
                        <a href="view/noticiacategoria/noticiacategoria_index.php">
                            <span class="fa fa-th-list"></span> Gerenciar Categorias
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /.navbar-static-side -->

</nav>