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

 public function indexDette(){
    if(isset($_REQUEST["action"])){
        $action=$_REQUEST["action"];
        if($action=="liste"){
            $this->listeDette();
        }elseif ($action=="add") {
            $this->addDette();
           
        }
        elseif ($action=="detail") {
            $this->detailDette();
           
        }
    }
    
 }
   
 public  function listeDette()
 {
    self::rendorView("dette/liste");
 }
 public function addDette()
 {
     $this->rendorView("dette/addDette");
 }
 public function detailDette()
 {
     $this->rendorView("dette/detail");
 }
    public function rendorView(string $view, array $datas=[]):void{
        extract($datas);
        ob_start();
        require_once "../views/$view.html.php";
        $contentForView = ob_get_clean();
        require_once "../views/layout/$this->layout.layout.html.php";

    }
}


