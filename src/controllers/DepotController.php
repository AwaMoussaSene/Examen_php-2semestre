<?php
namespace Bank\Controllers;
use Bank\Core\Controller\Controller;
use Bank\Models\DepotModel;

class DepotController extends Controller{
    private DepotModel $depotModel;
    public function __construct(){
        parent::__construct();
        $this->depotModel = new DepotModel();
    }
    public function indexDepot(){
        if($this->autorisation->isConnect() && $_REQUEST["controller"]!== "login"){
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
                if ($action == "liste") {
                    $this->listeDepot();
    
                }
        }else{
            $this->redirectToRoute([
                "controller" => "login",
                "action" => "show-form" 
            ]);
        }

        }
    }
    public function listeDepot(){
        $this->rendorView("depot/liste",[
            "depots"=>$this->depotModel->findAll()
        ]);

    }
}
