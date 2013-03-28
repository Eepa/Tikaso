<?php

require_once 'apuphpt/kyselyja.php';
require_once 'apuphpt/sessio.php';

function ohjaa($osoite){
    header("Location: $osoite");
    exit;
}

function on_kirjautunut(){
    global $sessio;
    return isset($sessio->hetu);
}

function varmista_kirjautuminen(){
    if(!on_kirjautunut()){
        ohjaa('kirjautuminen/sisaankirjaus.php');
    }
}


?>
