<?php

class Sessio{
    
    public function __construct() {
        session_start();
    }
    
    public function __set($kayttajatunnus, $salasana) {
        $_SESSION[$kayttajatunnus] = $salasana;
    }
    
    public function __get($kayttajatunnus) {
        if($this->__isset($kayttajatunnus)){
            return $_SESSION[$kayttajatunnus];
        }
        return null;
    }
    
    public function __isset($kayttajatunnus) {
        return isset($_SESSION[$kayttajatunnus]);
    }
    
    public function __unset($kayttajatunnus) {
        unset($_SESSION[$kayttajatunnus]);
    }
        
}


$sessio = new Sessio();

?>
