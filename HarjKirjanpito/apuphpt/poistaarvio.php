<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$aika = $_POST['arvio'] . ".00";

$kyselynsuoritus = $kyselyita->poistaKayttajanArvio($_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $aika);

if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Arvion poistaminen onnistui!'); 
        window.location.href = '../arvionpoistaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Arvion poistaminen epäonnistui'); 
        window.location.href = '../arvionpoistaminen.php';</script> <br>");
}
?>
