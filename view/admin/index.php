<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Curso de Ferias PHP Avançado com Ajax">
        <meta name="author" content="Willian Colognesi">
        <base href="http://localhost/cursodeferias_aula/" target="_blank">

        <title>Login - Curso de Ferias</title>
        
        <link href="view/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="view/bower_components/metisMenu/css/metisMenu.min.css" rel="stylesheet">
        <link href="view/css/sb-admin-2.css" rel="stylesheet">
        <link href="view/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Realizar Log-in</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" onsubmit="return false;">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" id="inputLogin" placeholder="Digite seu Login" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="inputSenha" placeholder="Digite sua Senha" type="password" value="">
                                    </div>

                                    <button class="btn btn-lg btn-success btn-block" onclick="return login();">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="view/bower_components/jquery/jquery.min.js"></script>
        <script src="view/bower_components/bootstrap/js/bootstrap.min.js"></script>
        <script src="view/bower_components/metisMenu/js/metisMenu.min.js"></script>
        <script src="view/js/sb-admin-2.js"></script>
        <script src="view/js/usuario.js"></script>
    </body>
</html>
