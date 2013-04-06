<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$aika = $_POST['harjalku'] . ".00";

//echo $_POST['hetu'] . " " . $_POST['lajitunnus'] . " " . $_POST['harjpvm'] . " " . $aika . " "
//        
//    . $_POST['yleisarvosana'] . " "  . $_POST['tyytyvaisyysarvo'] . " " . $_POST['sanallinenarvio'];


$kyselynsuoritus = $kyselyita->lisaaKayttajalleArvio($_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'],
        $aika, $_POST['hetu'] ,$_POST['yleisarvosana'], $_POST['tyytyvaisyysarvo'] , $_POST['sanallinenarvio']);

if ($kyselynsuoritus) {

    echo "<script language='JavaScript'>window.alert('Lisääminen onnistui!'); 
        window.location.href = '../arvionlisaaminen.php';</script> <br>";
} else {
    die("<script language='JavaScript'>window.alert('Lisääminen epäonnistui'); 
        window.location.href = '../arvionlisaaminen.php';</script> <br>");
}

?>
