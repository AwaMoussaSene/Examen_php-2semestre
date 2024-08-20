<?php
namespace Bank\Controllers;
use Bank\Core\Controller\Controller;
use Bank\Models\ClientModel;
use Bank\Models\EtatModel;

class ClientController extends Controller{
    private ClientModel $clientModel;
    private EtatModel $etatModel;
    public function __construct()
    {
        parent::__construct();
        $this->clientModel= new ClientModel();
        $this->etatModel = new EtatModel;
    }

    public function indexDetteClient()
    {
        if ($_REQUEST["action"] == "detail") {
            $this->detteByClient();
        }
    }
    public function detteByClient()
{
    $idclient = $_GET["iddet"];
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $itemsPerPage = 3;
    
    $clients = $this->clientModel->findDetteByIdClient($idclient, $page, $itemsPerPage);
    $totalItems = $this->clientModel->countDetteByIdClient($idclient);
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    $this->rendorView("client/showDetteClient", [
        "clients" => $clients,
        "currentPage" => $page,
        "totalPages" => $totalPages
    ]);
}
    }
 
