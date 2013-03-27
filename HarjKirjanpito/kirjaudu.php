<?php

require_once 'kirjautuminen/tarkastus.php';

if (isset($_GET['sis'])) {

    $kayttaja = $kyselyita->tunnistus($_POST['kayttajatunnus'], $_POST['salasana']);
    if ($kayttaja) {
        $sessio->hetu = $kayttaja->hetu;
        ohjaa('etusivu.php');
    } else {
        ohjaa('kirjautuminen/sisaankirjaus.php');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->hetu);
    ohjaa('kirjautuminen/sisaankirjaus.php');
} else {
    die('Jotain hämärää tapahtui..');
}
?>
