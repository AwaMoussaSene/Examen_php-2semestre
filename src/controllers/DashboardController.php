<?php
namespace Bank\Controllers;

use Bank\Core\Controller\Controller;
use Bank\Models\ArticleModel;
use Bank\Models\ClientModel;
use Bank\Models\DetteModel;

class DashboardController extends Controller
{
    private ClientModel $clientModel;
    private DetteModel $detteModel;
    private ArticleModel $articleModel;
    public function __construct()
    {
        parent::__construct();
        $this->clientModel= new ClientModel();
        $this->detteModel= new DetteModel();
        $this->articleModel= new ArticleModel();
    }

    public function indexDashboard()
    {
        if ($_REQUEST["action"] == "dashboard") {
            $this->dashboard();
        }
    }

    public function dashboard()
    {
        $telephone = isset($_GET["tel"]) ? $_GET["tel"] : "";
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = $this->clientModel->findAllClient($telephone, $page, 3);
        $this->rendorView("dashboard/dashboard", [
            "clients" => $pagination['data'],
            "nbreClients" => $this->clientModel->countClient(),
            "sumDettes" => $this->detteModel->sommeDettes(),
            "sumStocks" => $this->articleModel->sommeStockArticle(),
            "sumStockVendu" => $this->articleModel->sommeStockVendu(),
            "sumDetteJour" => $this->detteModel->sommeDettesDuJour(),
            "pagination" => $pagination 
        ]);
    }
}