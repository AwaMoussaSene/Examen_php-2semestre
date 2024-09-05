<?php 
define("WEBROOT","http://localhost:8000");
define("ROOT","C:/Users/DELL/Desktop/Examen_php-2sem");
require_once ROOT."/vendor/autoload.php";
use Bank\Controllers\LoginController;
use Bank\Controllers\DashboardController;
use Bank\Controllers\PaiementController;
use Bank\Controllers\DetteController;
use Bank\Controllers\ClientController;
use Bank\Controllers\ArticleController;
use Bank\Controllers\DepotController;
if(isset($_REQUEST["controller"])){
    $controller = $_REQUEST["controller"];
    if($controller=="dette"){
        $controller= new DetteController();
        $controller->indexDette();
    }elseif($controller==="paiement"){
        $controllerPay= new PaiementController();
        $controllerPay->indexPaiement();
    }elseif($controller==="login"){
        $controller= new LoginController();
        $controller->index();
    }elseif($controller==="dashboard"){
        $controller= new DashboardController();
        $controller->indexDashboard();
    }elseif($controller==="client"){
        $controller= new ClientController();
        $controller->indexDetteClient();
    }elseif($controller==="article"){
        $controller= new ArticleController();
        $controller->indexArticle();
    }elseif($controller==="depot"){
        $controller= new DepotController();
        $controller->indexDepot();
    }

}else{
    $controller= new LoginController();
    $controller->index();
}

?>