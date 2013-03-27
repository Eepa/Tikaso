<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$lajinimi = $_POST['laji'];
echo $lajinimi;

$kayttaja = $kyselyita->tunnistus('MIMA', 'mima1');
//$kyselyita->laji($_POST['laji']);

if($kayttaja){
    echo $kayttaja;
} else {
    ohjaa('lajiprofiilinlisaaminen.php');
}
echo 'lisäyssivy';
?>
