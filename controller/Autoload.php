<?php
/* 
 *  Willian Colognesi - 2016
 *  williancolognesi@gmail.com
 */

//require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/cursodeferias_aula/config.php";

require_once(BASEPATH . "/helper/Conexao.php");
date_default_timezone_set("America/Sao_Paulo");

function autoloadModel($className) {
    $filename = BASEPATH . "/model/" . $className . ".php";
    if (is_readable($filename)) {
        if(!class_exists($className)){
            require_once $filename;
        }
    }
}

function autoloadController($className) {
    $filename = BASEPATH . "/controller/" . $className . ".php";
    if (is_readable($filename)) {
        if(!class_exists($className)){
            require_once $filename;
        }
    }
}

spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");