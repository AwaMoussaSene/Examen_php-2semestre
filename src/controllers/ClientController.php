<?php
namespace Bank\Controllers;
use Bank\Core\Controller\Controller;
use Bank\Models\CategorieModel;
use Bank\Models\ClientModel;
use Bank\Models\DepotModel;
use Bank\Models\EtatModel;

class ClientController extends Controller
{
    private ClientModel $clientModel;
    private EtatModel $etatModel;
    private CategorieModel $categorieModel;
    private DepotModel $depotModel;


    public function __construct()
    {
        parent::__construct();
        $this->clientModel = new ClientModel();
        $this->etatModel = new EtatModel;
        $this->categorieModel = new CategorieModel();
        $this->depotModel = new DepotModel();
    }

    public function indexDetteClient()
    {
        if ($this->autorisation->isConnect() && $_REQUEST["controller"] !== "login") {
            if ($_REQUEST["action"] == "detail") {
                $this->detteByClient();
            } elseif ($_REQUEST["action"] == "liste") {
                $this->listeClient();
            } elseif ($_REQUEST["action"] == "add") {
                $this->addClient();
            } elseif ($_REQUEST["action"] == "Client-connect") {
                $this->layout = "client";
                $this->listeDetteBYClient();
            }
        } else {
            $this->redirectToRoute([
                "controller" => "login",
                "action" => "show-form"
            ]);
        }

    }
    
    public function detteByClient()
    {
        $message = '';
        if (isset($_POST["modifier"])) {
            $idclient = $_POST['idclient']; 
            $idcat = $_POST['categorie'];  
            $this->clientModel->updateCategorieClient($idclient, $idcat);
            $message = 'Catégorie mise à jour avec succès.';
        }
        if (isset($_POST["modifier-seuil"])) {
            $idclient = $_POST['idclient']; 
            $seuil = $_POST['montantseuil'];  
            $this->clientModel->updateSeuilClient($seuil, $idclient);
            $message = 'Seuil mise à jour avec succès.';
        }
        if (isset($_POST["valider-depot"])) {
            $idclient = $_POST['idclient']; 
            if(!$this->validator->isEmpty("montant-depot")){
                $this->validator->isNumerique("montant-depot");  
            }
            if($this->validator->validate()){
                $this->depotModel->addDepot([
                    "datedepot"=>date("Y/m/d"),
                    "montant"=>$_POST["montant-depot"],
                    "idclient" => $idclient
                ]);
            }
        }
        $idclient = $_GET["iddet"];
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $itemsPerPage = 3;

        $clients = $this->clientModel->findDetteByIdClient($idclient, $page, $itemsPerPage);
        $totalItems = $this->clientModel->countDetteByIdClient($idclient);
        $totalPages = ceil($totalItems / $itemsPerPage);

        $this->rendorView("client/showDetteClient", [
            "clients" => $clients,
            "sumDetteClients" => $this->clientModel->sommeDetteByClient($idclient),
            "sumDepotClient" => $this->clientModel->sommeCompteByClient($idclient),
            "currentPage" => $page,
            "totalPages" => $totalPages,
            "depots" => $this->depotModel->findAllDepot($idclient),
            "categories" => $this->categorieModel->findAllCategorie(),
            "message" => $message,
            "errors" => $this->validator->errors
        ]);
    }

    

    public function listeDetteBYClient()
    {
        $userConnect = $this->session->get("userConnect");
        $idClientConnect = $userConnect->idclient;
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $itemsPerPage = 3;

        $clients = $this->clientModel->findDetteByIdClient($idClientConnect, $page, $itemsPerPage);
        $totalItems = $this->clientModel->countDetteByIdClient($idClientConnect);
        $totalPages = ceil($totalItems / $itemsPerPage);

        $this->rendorView("client/showDetteClient", [
            "clients" => $clients,
            "sumDetteClients" => $this->clientModel->sommeDetteByClient($idClientConnect),
            "sumDepotClient" => $this->clientModel->sommeCompteByClient($idClientConnect),
            "currentPage" => $page,
            "totalPages" => $totalPages,
            "depots" => $this->depotModel->findAllDepot($idClientConnect)

        ]);
    }

    public function listeClient()
    {
        $telephone = isset($_GET["tel"]) ? $_GET["tel"] : "";
        $categorie = isset($_GET["categorie"]) ? $_GET["categorie"] : "";
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $pagination = $this->clientModel->getAllClient($telephone, $categorie, $page, 3);
        $this->rendorView("client/liste", [
            "clients" => $pagination['data'],
            "pagination" => $pagination,
            "categories" => $this->categorieModel->findAllCategorie()
        ]);
    }
    public function addClient()
    {
        if (isset($_POST["enregistrer"])) {
            $this->validForm();
        
    
            if ($this->validator->validate()) {
                $libelleCategorie = $_POST["categorie"];
                $categorie = $this->categorieModel->findCategorieByLibelle($libelleCategorie);
                $idcat = $categorie[0]->idcat;
                $photo = $_FILES['photo']['name'];
                $target_dir = "../assets"; 
                $target_file = $target_dir . basename($photo);
                $montantseuil = isset($_POST['seuil']) && $_POST['seuil'] !== '' ? $_POST['seuil'] : 0;
                $idclient=$this->clientModel->addClient([
                    "nom" => $_POST["nom"],
                    "prenom" => $_POST["prenom"],
                    "telephone" => $_POST["tel"],
                    "adresse" => $_POST["adresse"],
                    "email" => $_POST["email"],
                    "montantseuil"=>$montantseuil,
                    "idb" => 1,
                    "idcat" => $idcat,
                    "photo" => $target_file,
                    "pwd" => $_POST["pwd"]
                ]);if( $categorie[0]->libelle==="solvable"){
                    $this->depotModel->addDepot([
                        "datedepot"=>date("Y/m/d"),
                        "montant"=>$_POST["compte"],
                        "idclient" => $idclient
                    ]);
                }

                if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $this->session->add('errors', ['photo' => 'Le téléchargement de la photo a échoué.']);
                    $this->rendorView("client/addClient", [
                        "categories" => $this->categorieModel->getCategorie(),
                        "errors" => $this->validator->errors
                    ]);
                    return;
                }
                $this->redirectToRoute([
                    "controller" => "client",
                    "action" => "liste"
                ]);
            } else {
                $this->session->add('errors', $this->validator->errors);
                $this->rendorView("client/addClient", [
                    "categories" => $this->categorieModel->getCategorie(),
                    "errors" => $this->validator->errors
                ]);
            }
        } else {
            $this->rendorView("client/addClient", [
                "categories" => $this->categorieModel->getCategorie()
            ]);
        }
    }
    
    function validForm()
    {
        $this->validator->isEmpty("nom");
        $this->validator->isEmpty("prenom");
        $this->validator->isEmpty("adresse");
        $this->validator->isEmpty("categorie");
    if (!$this->validator->isEmpty("email")) {
        $this->validator->isEmail("email");
    }
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_NO_FILE) {
        $this->validator->errors['photo'] = "Le champ photo est obligatoire.";
    }
    if (!$this->validator->isEmpty("pwd")) {
        if (strlen($_POST["pwd"]) < 6) {
            $this->validator->errors["pwd"] = "Le mot de passe doit contenir au moins 6 caractères.";
        }
    }
    if (!$this->validator->isEmpty("tel") && $this->isUniqueTel($_POST["tel"])) {
        $this->validator->errors["tel"] = "Ce numéro est déjà utilisé.";
    }
    }
    public function isUniqueTel(string $tel)
    {
        return $this->clientModel->findByTel($tel);
    }

}

