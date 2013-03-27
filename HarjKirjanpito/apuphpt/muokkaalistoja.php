<?php

require_once 'kirjautuminen/tarkastus.php';
varmista_kirjautuminen();
?>


<?php


$kaikkilajit = $kyselyita->haeKaikkiLajitNumeroindekseilla();
$kaikkilajitkirjaimin = $kyselyita->haeKaikkiLajit();

echo $kaikkilajit[0] . " " . $kaikkilajit[1] . " " . $kaikkilajit[2] . ' ' . $kaikkilajit[3] . '<br>';


echo 'Käyttäjän lajit <br>';

$kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
$kayttajanlajitnumeroindekseilla = $kyselyita->haeKayttajanLajitNumeroindeksilla($sessio->hetu);

echo $kayttajanlajitnumeroindekseilla[0] . " " . $kayttajanlajitnumeroindekseilla[1] . " " .
 $kayttajanlajitnumeroindekseilla[2] . ' ' . $kayttajanlajitnumeroindekseilla[3] . '<br>';

$yhdistetyt = array_diff($kaikkilajitkirjaimin, $kayttajanlajit);

function muodostaYhdistetytNumeroin($yhdistetyt, $kaikkilajit) {

    $yhdistetytnumeroin = array();
    $indeksi = 0;

    for ($int = 0; $int < count($kaikkilajit); $int++) {
        if (array_key_exists($kaikkilajit[$int], $yhdistetyt)) {
//            echo $yhdistetyt[$kaikkilajit[$int]] . '<br>';
            $yhdistetytnumeroin[$indeksi] = $yhdistetyt[$kaikkilajit[$int]];
            $indeksi++;
        }
    }

    return $yhdistetytnumeroin;
}

//        echo 'juttuja <br>';
//        
//        for($x = 0; $x < count($yhdistetytnumeroin); $x++){
//            echo $yhdistetytnumeroin[$x] . '<br>';
//        }
//        




return muodostaYhdistetytNumeroin($yhdistetyt, $kaikkilajit);
?>