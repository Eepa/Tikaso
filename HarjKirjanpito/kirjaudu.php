<!--Kirjautumisen suorittava koodi. Kirjautumisen apuna kutsutaan tarkastus.php:tä, jonka avulla 
välitetään tietokantakyselyitä suorittavan luokan ilmentymä kirjautumistarkistusta varten. 
Ohjaa käyttäjän oikealle sivulle sen mukaan, mitä käyttäjä oli tekemässä (uloskirjautuminen, onnistunut 
sisäänkirjautuminen, epäonnistunut sisäänkirjautuminen).-->

<?php

require_once 'tarkastus.php';

if (isset($_GET['sis'])) {

    $kayttaja = $kyselyita->tunnistus($_POST['kayttajatunnus'], $_POST['salasana']);
    if ($kayttaja) {
        $sessio->hetu = $kayttaja->hetu;
        ohjaa('etusivu.php');
    } else {
        ohjaa('kirjautuminen/sisaankirjaus.php?epao');
    }
} elseif (isset($_GET['ulos'])) {
    unset($sessio->hetu);
    ohjaa('kirjautuminen/sisaankirjaus.php');
} else {
    die('Jotain hämärää tapahtui..');
}
?>
