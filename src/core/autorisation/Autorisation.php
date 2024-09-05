<?php 
namespace Bank\Core\Autorisation;
use Bank\Core\Session\Session;
use Bank\Core\Validator\Validator;

Class Autorisation{
    protected Session $session;
    protected Validator $validator;
    public function __construct(){
        $this->session = new Session();
        $this->validator = new Validator;
    }
    public  function isConnect():bool{
        return $this->session->keyExist("userConnect");

    }
    public  function hasRole(string $roleName):bool{
        return self::getRole()=== $roleName;
    }

    public  function getRole(string $key="roles"):string{
        return $this->session->get("userConnect")->$key;
        
    }
}


        