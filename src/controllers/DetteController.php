<?php
namespace Bank\Controllers;
use Bank\Models\DetteModel;

class DetteController 
{
   
   private $layout="base";
   private DetteModel $detteModel;
    public function __construct()
    {
         $this->detteModel = new DetteModel;
    }
    public function listeDette()
    {
        $this->rendorView("dette/liste");
    }

    public function rendorView(string $view, array $datas=[]):void{
        extract($datas);
        ob_start();
        require_once "../views/$view.html.php";
        $contentForView = ob_get_clean();
        require_once "../views/layout/$this->layout.layout.html.php";

    }
}


