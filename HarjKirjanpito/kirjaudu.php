<?php

require_once 'tarkastus.php';
require_once 'kyselyja.php';
require_once 'sessio.php';

if (isset($_GET['sis'])) {


    $kayttaja = $kyselyja->tunnistus($_POST['kayttajatunnus'], $_POST['salasana']);
    if ($kayttaja) {

        $sessio->hetu = $kayttaja->hetu;
        ohjaa('etusivu.php');
    } else {
        ohjaa('sisaankirjaus.php');
    }
}
//elseif (isset($_GET['ulos'])) {
//    unset($sessio->hetu);
//    ohjaa('index.php');
//} else {
//    die('Jotain hämärää tapahtui?');
//}
?>
