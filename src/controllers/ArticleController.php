<?php
namespace Bank\Controllers;
use Bank\Core\Controller\Controller;
use Bank\Models\ArticleModel;

class ArticleController extends Controller{
    private ArticleModel $articleModel;
    public function __construct(){
        parent::__construct();
        $this->articleModel = new ArticleModel();
    }
    public function indexArticle()
    {
        if($this->autorisation->isConnect() && $_REQUEST["controller"]!== "login"){
            if (isset($_REQUEST["action"])) {
                $action = $_REQUEST["action"];
                if ($action == "liste") {
                    $this->listeArticle();
    
                }elseif ($action == "add") {
                    $this->addArticle();
    
                }
        }else{
            $this->redirectToRoute([
                "controller" => "login",
                "action" => "show-form" 
            ]);
        }

        }
    }
    public function listeArticle(){
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = $this->articleModel->findAllArticle($page, 3);
        $this->rendorView("article/liste",[
            "articles"=> $pagination['data'],
            "pagination" => $pagination,
        ]);
    }
    public function addArticle(){
        if (isset($_POST['enregistrer'])) {
            $this->validForm();
            if($this->validator->validate()){
                $this->articleModel->addArticle([
                    "libelle" =>$_POST["libelle"],
                    "prixunitaire" => $_POST["prixunitaire"],
                    "qtestock" => $_POST["qtestock"],
                    "reference" => $this->articleModel-> genererReferenceArticle()
                ]);
                $this->redirectToRoute([
                    "controller" => "article",
                    "action" => "liste"
                ]);
            }else{
                $this->session->add('errors', $this->validator->errors);
                $this->rendorView("article/add",[
                    "errors" => $this->validator->errors
                ]);
            }
        }
        $this->rendorView("article/add");
    }

    function validForm()
    {
        $this->validator->isEmpty("libelle");
        $this->validator->isEmpty("prixunitaire");
        if (! $this->validator->isEmpty("prixunitaire")) {
            $this->validator->isNumerique("prixunitaire");
        }
        if (! $this->validator->isEmpty("qtestock")) {
            $this->validator->isNumerique("qtestock");
        }
    }
}
   

