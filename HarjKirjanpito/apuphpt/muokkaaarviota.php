<!-- Koodi, joka suorittaa valitun arvion muokkaamisen. Muokkaamisen 
onnistumisesta ja epäonnistumisesta ilmoitetaan JavaScript-ilmoituksen avulla. -->

<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$aika = $_POST['harjalku'] . ".00";

$kyselynsuoritus = $kyselyita->muokkaaArviota($_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $aika, $_POST['yleisarvosana'], $_POST['tyytyvaisyysarvo'], $_POST['sanallinenarvio']);

if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Arvion muokkaaminen onnistui!'); 
        window.location.href = '../arvionmuokkaus.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Arvion muokkaaminen epäonnistui.'); 
        window.location.href = '../arvionmuokkaus.php';</script> <br>");
}
?>
