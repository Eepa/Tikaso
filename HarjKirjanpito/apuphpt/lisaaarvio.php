<!-- Koodi, joka suorittaa arvion lisäämisen tietylle käyttäjälle liittyen tiettyyn 
harjoituskertaan. Lisäämisen onnistumisesta ja epäonnistumisesta ilmoitetaan 
JavaScript-ilmoituksen avulla. -->

<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$aika = $_POST['harjalku'] . ".00";

$kyselynsuoritus = $kyselyita->lisaaKayttajalleArvio($_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $aika, $_POST['hetu'], $_POST['yleisarvosana'], $_POST['tyytyvaisyysarvo'], $_POST['sanallinenarvio']);

if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Arvion lisääminen onnistui!'); 
        window.location.href = '../arvionlisaaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Arvion lisääminen epäonnistui.'); 
        window.location.href = '../arvionlisaaminen.php';</script> <br>");
}
?>
