<?php
namespace Bank\Models;

use Bank\Core\Model\Model;

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function connexion(string $email, string $pwd){
        $sql = "SELECT * FROM boutiquier WHERE email = :email AND pwd = :pwd";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'pwd' => $pwd,
        ]);
        return $stmt->fetch(); // Retourne un tableau associatif si l'utilisateur est trouvé, sinon false.
    }
 
}