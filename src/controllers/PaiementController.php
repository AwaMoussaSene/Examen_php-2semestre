<?php
namespace Bank\Controllers;

use Bank\Core\Controller\Controller;
use Bank\Models\PaiementModel;


class PaiementController extends Controller
{

    private PaiementModel $paiementModel;
    public function __construct()
    {
        parent::__construct();
        $this->paiementModel = new PaiementModel();
    }

    public function indexPaiement()
    {
        if($this->autorisation->isConnect() && $_REQUEST["controller"]!== "login"){
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
                if ($action == "detail") {
                    if($this->autorisation->hasRole("client")){
                        $this->layout = "client";
                        $this->detailDette();
                    }
                    $this->detailDette();
                }
                if ($action == "recu") {
                    $this->recu();
    
                }
        }else{
            $this->redirectToRoute([
                "controller" => "login",
                "action" => "show-form" 
            ]);
        }

}

    }
    public function detailDette()
    {
        $errors = [];

        if (isset($_POST['valider'])) {
            $montant = isset($_POST['montant']) ? floatval($_POST['montant']) : 0;
            if ($this->validator->isNumerique("montant", "Le montant doit être un nombre.")) {
                $errors['montant'] = $this->validator->errors['montant'];
            }
            if ($this->validator->isEmpty("montant", "Le montant est obligatoire.")) {
                $errors['montant'] = $this->validator->errors['montant'];
            }

            $paiements = $this->paiementModel->findByIdDette($_GET["iddet"]);
            $montantDue = $paiements[0]->restant ?? 0;

            if ($montant > $montantDue) {
                $errors['montant'] = "Vous avez  dépasser le montant dû.";
            }

            if (!empty($errors)) {
                $this->rendorView("dette/detail", [
                    "paiements" => $paiements,
                    "articles" => $this->paiementModel->findByIdDetteArticle($_GET["iddet"]),
                    "paiementArts" => $this->paiementModel->findByIdDettePaiement($_GET["iddet"]),
                    "errors" => $errors
                ]);
                return;
            }

            if ($this->validator->validate()) {
                $this->paiementModel->addPaiement([
                    "datep" => date('Y-m-d'),
                    "montantpay" => $_POST["montant"],
                    "reference" => $this->paiementModel-> genererNumeroPAY(),
                    "iddet" => $_GET["iddet"]
                ]);
                header("Location: ?controller=paiement&action=recu&iddet=" . $_GET["iddet"]);
                exit;
            }
        }

        $this->rendorView("dette/detail", [
            "paiements" => $this->paiementModel->findByIdDette($_GET["iddet"]),
            "articles" => $this->paiementModel->findByIdDetteArticle($_GET["iddet"]),
            "paiementArts" => $this->paiementModel->findByIdDettePaiement($_GET["iddet"]),
            "errors" => $errors
        ]);
    }

    public function recu()
    {
        $idDette = $_GET['iddet'] ?? null;
        if ($idDette) {
            $paiements = $this->paiementModel->findByIdDette($_GET['iddet']);
            $this->layout = "connexion";
            $this->rendorView("dette/recu", [
                "paiements" => $paiements,
                "paiementArts" => $this->paiementModel->findByIdDettePaiement($_GET["iddet"]),
                "articles" => $this->paiementModel->findByIdDetteArticle($_GET["iddet"])
            ]);
        }
    }
}




