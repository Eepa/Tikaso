<?php

require_once 'sessio.php';
require_once 'kyselyja.php';

function ohjaa($osoite){
    header("Location: $osoite");
    exit;
}

function on_kirjautunut(){
    global $sessio;
    return isset($sessio->kayttajatunnus);
}

function tarkista_onkoKirjautunut(){
    if(!on_kirjautunut()){
        ohjaa('sisaankirjaus.php');
    }
}


?>
