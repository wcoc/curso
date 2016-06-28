<?php

class Conexao{
    
    private static $IP = "localhost";
    private static $PORTA = 3306;
    private static $BD = "cursodeferias_aula";
    private static $USUARIO = "root";
    private static $SENHA = "willian@123";
    
    
    public static function getConexao(){
        $mysqli = new mysqli(self::$IP, self::$USUARIO,
                             self::$SENHA, self::$BD, self::$PORTA);
        
        if($mysqli){
            $mysqli->query("SET NAMES utf8");
            $mysqli->query("SET character_set_connection=utf8");
            $mysqli->query("SET character_set_client=utf8");
            $mysqli->query("SET character_set_results=utf8");
            
            return $mysqli;
        }else{
            throw new Exception("Falha na conexão com o banco de dados!");
        }
    }
}