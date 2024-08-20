<?php 
namespace Bank\Core\Controller;
use Bank\Core\Session\Session;
use Bank\Core\Validator\Validator;

 class Controller 
{
    protected Session $session;
    protected Validator $validator;
    protected $layout="base";

    public function __construct(){
        $this->validator = new Validator();
        $this->session = new Session();
    }
    public function rendorView(string $view, array $datas=[]):void{
        extract($datas);
        ob_start();
        require_once "../views/$view.html.php";
        $contentForView = ob_get_clean();
        require_once "../views/layout/$this->layout.layout.html.php";

    }
    public function redirectToRoute(array $route){
        extract($route);
        header("Location:".WEBROOT."/?controller=$controller&action=$action");
        exit;
    }
}


        