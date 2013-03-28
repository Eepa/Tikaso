<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$lajinimi = $_POST['laji'];
//echo $lajinimi;

$laji = $kyselyita->lajiIndeksi($lajinimi);

if($laji){
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
