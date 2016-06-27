<?php
require_once("Autoload.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    if(isset($_GET['teste'])){
        
        switch($_GET['teste']){
            
            case "teste":
                exit("Olá");
            
        }
    }
}

class TesteController{
    
    function teste(){
        $test = new Teste("Willian");
        echo $test->getNome();
    }
    
}