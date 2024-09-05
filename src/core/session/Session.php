<?php 
namespace Bank\Core\Session;

class Session{

    public function __construct(){
        if (session_status()==PHP_SESSION_NONE) {
            session_start();
        }
       
    }
    public  function add(string $key,$value){
        $_SESSION[$key] = $value;
    }

    public  function get(string $key){
        return $_SESSION[$key] ;
    }

    public  function isset(string $key){
       return isset($_SESSION[$key] ) ;
    }


    public  function unset(string $key){
        unset($_SESSION[$key] ) ;
     }
     public  function close():void{
        unset($_SESSION["userConnect"]);
        session_destroy();
    }
    public  function keyExist(string $key):bool{
        return isset($_SESSION[$key]);
        
    }
    public  function set(string $key, mixed $value):void{
        $_SESSION[$key]=$value;
        
    }
    public  function setObject(string $key, mixed $value):void{
        $_SESSION[$key]=json_decode(json_encode($value),true);
        
    }
  
}