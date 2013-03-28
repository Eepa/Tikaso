<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$lajinimi = $_POST['laji'];
echo $lajinimi;

$kayttaja = $kyselyita->lajiIndeksi($lajinimi);
//$kyselyita->laji($_POST['laji']);

if($kayttaja){
//    echo var_dump($kayttaja);
    echo $kayttaja->lajitunnus;
}
//else {
//    ohjaa('lajiprofiilinlisaaminen.php');
//}
echo 'lisäyssivy';
?>
