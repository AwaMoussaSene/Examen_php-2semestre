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
        $action = $_REQUEST["action"] ?? 'showForm';

        if ($action === 'login') {
            $this->login();
        } elseif ($action === 'logout') {
            $this->session->close();
            $this->redirectToRoute([
                "controller" => "login",
                "action" => "showForm"
            ]);
        } else {
            $this->showForm();
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
                $connect = $this->loginModel->connexion($email, $password);
                if ($connect != false) {
                    $this->session->set("userConnect", $connect);
                    $this->redirectAfterConnect();
                } else {
                    $this->validator->errors['connect'] = 'Email ou mot de passe incorrect';
                }
            }

            $this->rendorView("login/login", ["errors" => $this->validator->getErrors()]);
        } else {
            $this->showForm();
        }
    }

    private function redirectAfterConnect()
    {
        $role = $this->autorisation->getRole('roles'); 
        switch ($role) {
            case 'boutiquier':
                $this->redirectToRoute([
                    "controller" => "dashboard",
                    "action" => "dashboard"
                ]);
                break;

            case 'client':
                $this->redirectToRoute([
                    "controller" => "client",
                    "action" => "Client-connect"
                ]);
                break;

            default:
                $this->redirectToRoute([
                    "controller" => "login",
                    "action" => "showForm"
                ]);
                break;
        }
    }
}











// <?php
// namespace Bank\Controllers;
// use Bank\Core\Controller\Controller;
// use Bank\Models\LoginModel;

// class LoginController extends Controller
// {
//     private LoginModel $loginModel;

//     public function __construct()
//     {
//         parent::__construct();
//         $this->layout = "connexion";
//         $this->loginModel = new LoginModel();
//     }
//     public function index()
//     {
//         {
//             $action = $_REQUEST["action"] ?? 'showForm';
    
//             if ($action === 'login') {
//                 $this->login();
//             } elseif ($action === 'logout') {
//                 $this->session->close();
//                 $this->redirectToRoute([
//                     "controller" => "login",
//                     "action" => "show-form"
//                 ]);
//             } else {
//                 $this->showForm();
//             }
//         }
//     }

//     private function showForm()
//     {
//         $this->rendorView("login/login");
//     }
  
//     public function login(){
//         if (isset($_POST['connect'])) {
//                     $email = $_POST['email'] ?? '';
//                     $password = $_POST['pwd'] ?? '';
        
//                     if (!$this->validator->isEmpty("email")) {
//                         $this->validator->isEmail("email");
//                     }
        
//                     $this->validator->isEmpty("pwd");
//                     if ($this->validator->validate()) {
//                         $connect = $this->loginModel->connexion($email, $password);
//                         if ($connect!= false) {
//                             $this->session->set("userConnect", $connect);
//                             if ($connect->roles === 'boutiquier') {
//                                 $this->redirectToRoute([
//                                     "controller" => "dashboard",
//                                     "action" => "dashboard" 
//                                 ]);
//                             } elseif ($connect->roles === 'client') {
//                                 $this->redirectToRoute([
//                                     "controller" => "client",
//                                     "action" => "liste" 
//                                 ]);
//                             } 
//                         } else {
//                             $this->validator->errors['connect'] = 'Email ou mot de passe incorrect';
//                         }
//                     }
        
//                     $this->rendorView("login/login", ["errors" => $this->validator->getErrors()]);
//                 } else {
//                     $this->showForm();
//                 }
//     }
  
// }
