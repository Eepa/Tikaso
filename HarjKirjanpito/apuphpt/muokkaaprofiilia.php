<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>


<?php

$kyselynsuoritus = $kyselyita->muokkaaLajiprofiilia($_POST['tavoitekuvaus'], $_POST['tavoiteharjmaara'], $_POST['hetu'], $_POST['lajitunnus']);

if ($kyselynsuoritus) {
    echo "<script language='JavaScript'>window.alert('Muokkaaminen onnistui!'); 
        window.location.href = '../lajiprofiilinmuokkaaminen.php';</script> <br>";
} else {
    die( "<script language='JavaScript'>window.alert('Muokkaaminen epäonnistui'); 
        window.location.href = '../lajiprofiilinmuokkaaminen.php';</script> <br>");
}
?>
