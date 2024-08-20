<?php 
namespace Bank\Core\Session;

class Session{

    public function __construct(){
        if (session_status()==PHP_SESSION_NONE) {
            session_start();
        }
       
    }
    public function add(string $key,$value){
        $_SESSION[$key] = $value;
    }

    public function get(string $key){
        return $_SESSION[$key] ;
    }

    public function isset(string $key){
       return isset($_SESSION[$key] ) ;
    }


    public function unset(string $key){
        unset($_SESSION[$key] ) ;
     }
     public static function close():void{
        unset($_SESSION["userConnect"]);
        session_destroy();
    }
}