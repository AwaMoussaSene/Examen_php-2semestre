<?php
namespace Bank\Controllers;

use Bank\Core\Controller\Controller;
use Bank\Models\ArticleModel;
use Bank\Models\ClientModel;
use Bank\Models\DetteModel;
use Bank\Models\EtatModel;

class DetteController extends Controller
{

    private DetteModel $detteModel;
    private EtatModel $etatModel;
    private ClientModel $clientModel;
    private ArticleModel $articleModel;
    public function __construct()
    {
        parent::__construct();
        $this->detteModel = new DetteModel;
        $this->etatModel = new EtatModel;
        $this->clientModel = new ClientModel;
        $this->articleModel = new ArticleModel;

    }

    public function indexDette()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action == "liste") {
                $this->listeDette();
            } elseif ($action == "add") {
                $this->addDette();

            }
        }

    }

    public function listeDette()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $etat = isset($_GET["etat"]) ? $_GET["etat"] : "";
        if (empty($date) && empty($tel) && empty($etat)) {
            $etat = "non solvant";
        }
        $date = isset($_GET["date"]) ? $_GET["date"] : "";
        $tel = isset($_GET["tel"]) ? $_GET["tel"] : "";
        $pagination = $this->detteModel->findAll($etat, $date, $tel, $page, 5);

        self::rendorView("dette/liste", [
            "datas" => $pagination['data'],
            "pagination" => $pagination,
            "etats" => $this->etatModel->findAll()
        ]);

    }
    public function addDette()
    {
        $clients = null;
        $articles = null;
        if (!isset($_SESSION['dette'])) {
            $_SESSION['dette'] = [
                'client' => [],
                'article' => [],
                'articleCmde' => [], 
                'total' => 0,
                'search_tel' => '',
                'search_ref' => ''
            ];
        }
    
        if (isset($_GET["tel"])) {
            $clients = $this->clientModel->findAll($_GET["tel"]);
            if ($clients) {
                $_SESSION['dette']['client'] = $clients;
                $_SESSION['dette']['search_tel'] = $_GET["tel"];
            }
        }
    
        if (isset($_GET["ref"])) {
            $articles = $this->articleModel->findAll($_GET["ref"]);
            if ($articles) {
                foreach ($articles as $article) {
                    $article->qtestock -= $this->getQteCmdByArticle($article->ida);
                }
                $_SESSION['dette']['article'] = $articles;
                $_SESSION['dette']['search_ref'] = $_GET["ref"];
            }
        }
    
        if (isset($_POST["valider"])) {
            $this->validator->isNumerique("quantite", "La quantité doit être un nombre.");
            $this->validator->isEmpty("quantite", "La quantité est obligatoire.");
            $quantite = intval($_POST["quantite"]);
            $article = $_SESSION['dette']['article'] ?? null;
    
            if (!$this->validator->validate()) {
                $this->rendorView("dette/addDette", [
                    "clients" => $_SESSION['dette']['client'] ?? $clients,
                    "articles" => $_SESSION['dette']['article'] ?? $articles,
                    "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [],
                    "errors" => $this->validator->errors
                ]);
                return;
            }
    
            if ($article && $quantite > $article[0]->qtestock) {
                $this->validator->errors['quantite'] = "La quantité demandée dépasse la quantité en stock.";
                $this->rendorView("dette/addDette", [
                    "clients" => $_SESSION['dette']['client'] ?? $clients,
                    "articles" => $_SESSION['dette']['article'] ?? $articles,
                    "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [], 
                    "errors" => $this->validator->errors
                ]);
                return;
            } else {
                $article[0]->qtestock -= $quantite;
    
                $key = $this->searchArticleInSession($article[0]->ida);
    
                if ($key === -1) {
                    $article[0]->qtecmd = $quantite;
                    $article[0]->montant = $quantite * $article[0]->prixunitaire;
                    $_SESSION['dette']['articleCmde'][] = $article[0];
                } else {
                    $_SESSION['dette']['articleCmde'][$key]->qtecmd += $quantite;
                    $_SESSION['dette']['articleCmde'][$key]->montant = $_SESSION['dette']['articleCmde'][$key]->qtecmd * $article[0]->prixunitaire;
                }
    
                $_SESSION['dette']['total'] = $this->calculateTotalMontant();
    
                if ($article[0]->qtestock <= 0) {
                    unset($_SESSION['dette']['article']);
                }
            }
        }
    
        if (isset($_POST["enregistrer"])) {
            $clientId = isset($_SESSION['dette']['client'][0]->idclient) ? $_SESSION['dette']['client'][0]->idclient : null;
    
            if ($clientId !== null) {
                $detteId = $this->detteModel->addDette([
                    "dated" => date('Y-m-d'),
                    "montant" => $_SESSION['dette']['total'],
                    "numero" =>$this->detteModel->genererNumeroDette(),
                    "idclient" => $clientId,
                    "idetat" => 2,
                    "idb" => 1
                ]);
    
                foreach ($_SESSION['dette']['articleCmde'] as $article) {
                    $this->detteModel->addArticleDette([
                        "iddet" => $detteId,
                        "ida" => $article->ida,
                        "quantite" => $article->qtecmd,
                    ]);
    
                    $this->detteModel->updateStock($article->ida, $article->qtecmd);
                }
    
                $this->destroySession();
    
                $this->redirectToRoute([
                    'controller' => 'dette',
                    'action' => 'liste'
                ]);
                return;
            }
        }
    
        $this->rendorView("dette/addDette", [
            "clients" => $_SESSION['dette']['client'] ?? $clients,
            "articles" => $_SESSION['dette']['article'] ?? $articles,
            "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [], 
            "search_tel" => $_SESSION['dette']['search_tel'] ?? '',
            "search_ref" => $_SESSION['dette']['search_ref'] ?? ''
        ]);
    }
    
    private function getQteCmdByArticle(int $articleId): int
    {
        $quantity = 0;
        
        if (isset($_SESSION['dette']['articleCmde']) && is_array($_SESSION['dette']['articleCmde'])) {
            foreach ($_SESSION['dette']['articleCmde'] as $article) {
                if ($article->ida == $articleId) {
                    $quantity = $article->qtecmd;
                    break;
                }
            }
        }
        
        return $quantity;
    }
    private function searchArticleInSession(int $articleId)
    {
        if (!isset($_SESSION['dette']['articleCmde']) || !is_array($_SESSION['dette']['articleCmde'])) {
            return -1;
        }
        foreach ($_SESSION['dette']['articleCmde'] as $key => $article) {
            if ($article->ida == $articleId) {
                return $key;
            }
        }
        return -1;
    }

    private function calculateTotalMontant()
    {
        $total = 0;
        foreach ($_SESSION['dette']['articleCmde'] as $article) {
            $total += $article->montant;
        }
        return $total;
    }
    public function destroySession()
    {
        if (isset($_SESSION['dette'])) {
            $this->session->unset('dette');
        }
    }


}

















    // public function addDette()
    // {
    //     $clients = null;
    //     $articles = null;

    //     if (isset($_GET["tel"])) {
    //         $clients = $this->clientModel->findAll($_GET["tel"]);
    //         if ($clients) {
    //             $_SESSION['dette']['client'] = $clients;
    //             $_SESSION['dette']['search_tel'] = $_GET["tel"];
    //         }
    //     }

    //     if (isset($_GET["ref"])) {
    //         $articles = $this->articleModel->findAll($_GET["ref"]);
    //         if ($articles) {
    //             $_SESSION['dette']['article'] = $articles;
    //             $_SESSION['dette']['search_ref'] = $_GET["ref"];
    //         }
    //     }

    //     if (isset($_POST["valider"])) {
    //         $this->validator->isNumerique("quantite", "La quantité doit être un nombre.");
    //         $this->validator->isEmpty("quantite", "La quantité est obligatoire.");
    //         $quantite = intval($_POST["quantite"]);
    //         $article = $_SESSION['dette']['article'] ?? null;

    //         if (!$this->validator->validate()) {
    //             $this->rendorView("dette/addDette", [
    //                 "clients" => $_SESSION['dette']['client'] ?? $clients,
    //                 "articles" => $_SESSION['dette']['article'] ?? $articles,
    //                 "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [],
    //                 "errors" => $this->validator->errors
    //             ]);
    //             return;
    //         }

    //         if ($article && $quantite > $article[0]->qtestock) {
    //             $this->validator->errors['quantite'] = "La quantité demandée dépasse la quantité en stock.";
    //             $this->rendorView("dette/addDette", [
    //                 "clients" => $_SESSION['dette']['client'] ?? $clients,
    //                 "articles" => $_SESSION['dette']['article'] ?? $articles,
    //                 "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [],
    //                 "errors" => $this->validator->errors
    //             ]);
    //             return;
    //         } else {
    //             $article[0]->qtestock -= $quantite;

    //             $key = $this->searchArticleInSession($article[0]->ida);

    //             if ($key === -1) {
    //                 $article[0]->qtecmd = $quantite;
    //                 $article[0]->montant = $quantite * $article[0]->prixunitaire;
    //                 $_SESSION['dette']['articleCmde'][] = $article[0];
    //             } else {
    //                 $_SESSION['dette']['articleCmde'][$key]->qtecmd += $quantite;
    //                 $_SESSION['dette']['articleCmde'][$key]->montant = $_SESSION['dette']['articleCmde'][$key]->qtecmd * $article[0]->prixunitaire;
    //             }

    //             $_SESSION['dette']['total'] = $this->calculateTotalMontant();

    //             if ($article[0]->qtestock <= 0) {
    //                 unset($_SESSION['dette']['article']);
    //             }
    //         }
    //     }
    //     if (isset($_POST["enregistrer"])) {
    //         $clientId = isset($_SESSION['dette']['client'][0]->idclient) ? $_SESSION['dette']['client'][0]->idclient : null;

    //         if ($clientId !== null) {
    //             $detteId = $this->detteModel->addDette([
    //                 "dated" => date('Y-m-d'),
    //                 "montant" => $_SESSION['dette']['total'],
    //                 "numero" => "DET319",
    //                 "idclient" => $clientId,
    //                 "idetat" => 2,
    //                 "idb" => 1
    //             ]);

    //             foreach ($_SESSION['dette']['articleCmde'] as $article) {
    //                 $this->detteModel->addArticleDette([
    //                     "iddet" => $detteId,
    //                     "ida" => $article->ida,
    //                     "quantite" => $article->qtecmd,
    //                 ]);

    //                 $this->detteModel->updateStock($article->ida, $article->qtecmd);
    //             }

    //             $this->destroySession();

    //             $this->redirectToRoute([
    //                 'controller' => 'dette',
    //                 'action' => 'liste'
    //             ]);
    //             return;
    //         }
    //     }
    //     $this->rendorView("dette/addDette", [
    //         "clients" => $_SESSION['dette']['client'] ?? $clients,
    //         "articles" => $_SESSION['dette']['article'] ?? $articles,
    //         "articleCmde" => $_SESSION['dette']['articleCmde'] ?? [],
    //         "errors" => $this->validator->errors,
    //         "search_tel" => $_SESSION['dette']['search_tel'] ?? '',
    //         "search_ref" => $_SESSION['dette']['search_ref'] ?? ''
    //     ]);

    // }