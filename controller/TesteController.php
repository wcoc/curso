<?php
require_once("Autoload.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    if(isset($_GET['teste'])){
        
        switch($_GET['teste']){
            
            case "teste":
                $t = new Teste();
                try{
                    $t->setId(2);
                    $t->setNome("Willian");
                    
                    $t->validate();
                    exit("Olá");
                } catch (Exception $ex) {
                    exit($ex->getMessage());
                }
        }
    }
}

class TesteController{
    
    function teste(){
        $test = new Teste("Willian");
        $test->save();
        echo $test->getNome();
    }
    
    public function testaSave(){
        $con = Conexao::getConnection();
        
        $insert = "INSERT INTO usuario SET nome = ?, email = ?";
        $pstmt = $con->prepare($insert);
        
        $params = "s";
        $params .= "s";
        
        $nome = "willian";
        $email = "willian@gmail.com";
        
        $pstmt->bind_param($params, $nome, $email);
        
        $pstmt->execute();
    }
    
    public function imprime_paginacao($filtro = null){
        $mysqli = $this->conexao->getDatabase();
        $selCatalogos = "SELECT * FROM teste WHERE (1=1) AND teste = ?";
        
        $pstmt = $mysqli->prepare($selCatalogos);
        $pstmt->bind_param("i", 1);
        
        $pstmt->execute();
//        $results = $pstmt->get_result();
//        $contatoBD = $results->fetch_assoc();
        
        $regTotal = $pstmt->num_rows;
        $paginade = 1;
        $porPagina = ceil($regTotal/self::$TOTAL_REG_PAGINACAO);
        if($_GET){
            if(isset($_GET['pagina'])){
                $paginade = addslashes($_GET['pagina']);
            }
        }
        echo '<ul class="pagination pagination-md">';
        if ($paginade > 1) {
            echo "<li><a href=view/teste/teste.php?"
                    . "teste=".null."&"
                    . "pagina=".($paginade-1).">"
                    . "&laquo; Anterior</a></li>";
        }
        echo '<li class="disabled"><a href="#"> Página ' . $paginade . ' de ' . $porPagina . ' </a> </li>';
        if ($paginade < $porPagina) {
            echo "<li><a "
                    . "href=view/teste/teste.php?"
                    . "teste=".null."&"
                    . "pagina=".($paginade+1).">"
                    . "Próximo &raquo;</a></li>";
        }
        echo '</ul>';
    }
}