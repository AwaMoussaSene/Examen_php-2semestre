<?php
namespace Bank\Models;

use Bank\Core\Model\Model;

class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function connexion(string $email, string $pwd)
    {
        $sql = "SELECT pwd, email, 'boutiquier' AS roles FROM boutiquier WHERE email = :email AND pwd = :pwd";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'pwd' => $pwd,
        ]);
        $result = $stmt->fetch(); 

        if (!$result) {
            $sql = "SELECT idclient, pwd, email, 'client' AS roles FROM client WHERE email = :email AND pwd = :pwd";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'pwd' => $pwd,
            ]);
            $result = $stmt->fetch();
        }

        return $result ?: false;
    }

}