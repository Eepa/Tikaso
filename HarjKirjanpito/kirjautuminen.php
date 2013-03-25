<?php

require_once 'tarkastus.php';

if(isset($_GET['sisaan'])){
    
    $kayttaja = $kyselija->tunnistus($_POST['kayttajatunnus'], $_POST['salasana']);
    if($kayttaja) {
        $sessio->kayttajahetu = $kayttaja->hetu;
        
        ohjaa('etusivu.php');
        
    } else {
        ohjaa('sisaankirjaus.php');
    }
    
    
    
} elseif(isset ($_GET['ulos'])){
    unset($sessio->kayttajahetu);
    ohjaa('etusivu.php');
} else {
    die('Jotain hämärää tapahtui?');
}


?>
