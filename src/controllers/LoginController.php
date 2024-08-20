<?php
namespace Bank\Controllers;
use Bank\Core\Controller\Controller;
use Bank\Models\LoginModel;

class LoginController extends Controller
{
    private LoginModel $loginModel;

    public function __construct()
    {
        parent::__construct();
        $this->layout = "connexion";
        $this->loginModel = new LoginModel();
    }
    public function index()
    {
        {
            $action = $_REQUEST["action"] ?? 'showForm';
    
            if ($action === 'login') {
                $this->login();
            } elseif ($action === 'logout') {
                $this->logout();
            } else {
                $this->showForm();
            }
        }
    }

    private function showForm()
    {
        $this->rendorView("login/login");
    }

    public function login()
    {
        if (isset($_POST['connect'])) {
            
            $email = $_POST['email'] ?? '';
            $password = $_POST['pwd'] ?? '';

            if (!$this->validator->isEmpty("email")) {
                $this->validator->isEmail("email");
            }

            $this->validator->isEmpty("pwd");
            if ($this->validator->validate()) {
                $result = $this->loginModel->connexion($email, $password);
                if ($result) {
                    $_SESSION['userconnect'] = $result;
                    $this->redirectToRoute([
                        "controller" => "dette",
                        "action" => "liste"
                    ]);
                    return;
                } else {
                    $this->validator->errors['connect'] = 'Email ou mot de passe incorrect';
                }
            }

            // Affichage des erreurs
            $this->rendorView("login/login", ["errors" => $this->validator->getErrors()]);
        } else {
            $this->showForm();
        }
      
    }
        public function logout()
    {
        $this->session->close();
        $this->redirectToRoute([
            "controller" => "login",
            "action" => "show-form"
        ]);
    }
}
