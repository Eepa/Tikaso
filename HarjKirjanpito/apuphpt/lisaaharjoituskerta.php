<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>


<?php

$jaetut = explode("T", $_POST['harjoitusaika']);
$paiva = $jaetut[0];
$aika = $jaetut[1] . ":00.00";

//echo $_POST['hetu'] . " " . $_POST['lajitunnus'] . " " . $paiva  . " "
//        . $aika . " " . $_POST['harjkesto'] . " " . 
//        $_POST['vaikeusaste'] . " " . $_POST['harjkuvaus']  ;

$kyselynsuoritus = $kyselyita->lisaaHarjoituskerta(
       $_POST['hetu'] , $_POST['lajitunnus'] , $paiva ,
        $aika ,$_POST['harjkesto'] , 
        $_POST['vaikeusaste'] ,$_POST['harjkuvaus'] );


if ($kyselynsuoritus) {
   
    echo "<script language='JavaScript'>window.alert('Lisääminen onnistui!'); 
        window.location.href = '../harjoituskerranlisaaminen.php';</script> <br>";
} 
else {
    die( "<script language='JavaScript'>window.alert('Lisääminen epäonnistui'); 
        window.location.href = '../harjoituskerranlisaaminen.php';</script> <br>");
}


?>
