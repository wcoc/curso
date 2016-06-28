<?php require("../header-adm.php"); ?>

    <div id="wrapper">
        
        <?php require("../menu-adm.php"); ?>
        <?php require_once(BASEPATH . "/controller/TesteController.php"); ?>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Home </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <p> Bem vindo ao painel administrativo! </p>
                
                <?php
                $ctrl = new TesteController();

//                $ctrl->testaSave();
//                $ctrl->teste();
                
                ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        
    </div>
    <!-- /#wrapper -->
    
    <script>
        function teste(){
            $.get("controller/TesteController.php",{
                teste: "teste"
            }, function(data){
                console.log(data);
            });
        }
    </script>
<?php require("../footer-adm.php");
