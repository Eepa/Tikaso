<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$lajinimi = $_POST['laji'];
//echo $lajinimi;

echo $_POST['hetu'] . " " . $lajinimi . " ". $_POST['tavoitekuvaus'] . " " . $_POST['tavoiteharjmaara'] . "<br>";

$laji = $kyselyita->lajiIndeksi($lajinimi);

$kyselynsuoritus = $kyselyita->lisaaLajiprofiili($_POST['hetu'], 
        $laji->lajitunnus, 
        $_POST['tavoitekuvaus'], 
        $_POST['tavoiteharjmaara']);

if($kyselynsuoritus){
    
    echo "<script language='JavaScript'>window.alert('Lisäys onnistui!'); 
        window.location.href = 'lajiprofiilinlisaaminen.php';</script> <br>";
} else {
    die('Outo virhe ilmaantui lisättäessä');
}


//if($kayttaja){
////    echo var_dump($kayttaja);
//    echo $kayttaja->lajitunnus;
//}
//else {
//    ohjaa('lajiprofiilinlisaaminen.php');
//}
?>
