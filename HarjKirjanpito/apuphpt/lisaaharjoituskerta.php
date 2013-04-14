<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>


<?php

$aika = $_POST['harjalku'] . ":00.00";

$kyselynsuoritus = $kyselyita->lisaaHarjoituskerta(
        $_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $aika, $_POST['harjkesto'], $_POST['vaikeusaste'], $_POST['harjkuvaus']);


if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Harjoituskerran lisääminen onnistui!'); 
        window.location.href = '../harjoituskerranlisaaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Harjoituskerran lisääminen epäonnistui.'); 
        window.location.href = '../harjoituskerranlisaaminen.php';</script> <br>");
}
?>
