<?php 
define("WEBROOT","http://localhost:8001");
define("ROOT","C:/Users/DELL/Desktop/Examen_php-2sem");
require_once ROOT."/vendor/autoload.php";

use Bank\Controllers\DetteController;
if(isset($_REQUEST["contoller"])){
    $controller = $_REQUEST["contoller"];
    if($controller=="dette"){
        $controller= new DetteController();
        $controller->listeDette();

    }

}else{
    $controller= new DetteController();
    $controller->listeDette();
}

?>