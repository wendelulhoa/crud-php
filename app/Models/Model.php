<?php
namespace App\Models;
use PDO;
use Exception;
abstract class Model {
    

    protected function connection(){
        $verifyConnection = true;
        try{
             $connection = new PDO("mysql:host=".HOST.";dbname".DB."","".USER."","".PASS."");
             return $connection;
        }catch(Exception $e){
            throw new Exception('erro ao conectar ao banco');
        }
        
    }
}
?>