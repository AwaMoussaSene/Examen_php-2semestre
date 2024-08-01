<?php 
 class Controller 
{
    protected $layout="base";
    public function rendorView(string $view, array $datas=[]):void{
        extract($datas);
        ob_start();
        require_once "../views/$view.html.php";
        $contentForView = ob_get_clean();
        require_once "../views/layout/$this->layout.layout.html.php";

    }
    public function redirectToRoute(array $route){
        extract($route);
        header("Location:".WEBROOT."/?ressource=$ressource&controller=$controller&action=$action");
        exit;
    }
    
}
        