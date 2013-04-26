<!-- Koodi, joka suorittaa lajiprofiilin lisäämisen tietylle käyttäjälle. Lisäämisen 
onnistumisesta ja epäonnistumisesta ilmoitetaan JavaScript-ilmoituksen avulla. -->

<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$laji = $kyselyita->haeLajiIndeksi($_POST['lajinimi']);

$kyselynsuoritus = $kyselyita->lisaaLajiprofiili($_POST['hetu'], $laji->lajitunnus, $_POST['tavoitekuvaus'], $_POST['tavoiteharjmaara']);

if ($kyselynsuoritus) {
    echo "<script language='JavaScript'>window.alert('Lajiprofiilin lisääminen onnistui!'); 
        window.location.href = '../lajiprofiilinlisaaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Lajiprofiilin lisääminen epäonnistui.'); 
        window.location.href = '../lajiprofiilinlisaaminen.php';</script> <br>");
}
?>
