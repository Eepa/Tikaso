<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>



<?php

$kyselynsuoritus = $kyselyita->muokkaaHarjoituskertaa($_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjalku'], $_POST['harjkesto'], $_POST['vaikeusaste'], $_POST['harjkuvaus']);

if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Harjoituskerran muokkaaminen onnistui!'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Harjoituskerran muokkaaminen epäonnistui'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>");
}
?>