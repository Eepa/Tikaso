<?php

class Sessio {

    public function __construct() {
        session_start();
    }

    public function __set($hetu, $arvo) {
        $_SESSION[$hetu] = $arvo;
    }

    public function __get($hetu) {
        if ($this->__isset($hetu)) {
            return $_SESSION[$hetu];
        }
        return null;
    }

    public function __isset($hetu) {
        return isset($_SESSION[$hetu]);
    }

    public function __unset($hetu) {
        unset($_SESSION[$hetu]);
    }

}

$sessio = new Sessio();
?>
