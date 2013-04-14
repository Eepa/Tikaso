<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$kaikkiLajitNumeroindeksi = $kyselyita->haeKaikkiLajitNumeroindeksi();
$kaikkiLajit = $kyselyita->haeKaikkiLajit();

$kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
$kayttajanLajitNumeroindeksi = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

$yhdistetyt = array_diff($kaikkiLajit, $kayttajanlajit);

function muodostaYhdistetytNumeroin($yhdistetyt, $kaikkilajit) {

    $yhdistetytnumeroin = array();
    $indeksi = 0;

    for ($int = 0; $int < count($kaikkilajit); $int++) {
        if (array_key_exists($kaikkilajit[$int], $yhdistetyt)) {

            $yhdistetytnumeroin[$indeksi] = $yhdistetyt[$kaikkilajit[$int]];
            $indeksi++;
        }
    }

    return $yhdistetytnumeroin;
}
?>

<?php return muodostaYhdistetytNumeroin($yhdistetyt, $kaikkiLajitNumeroindeksi); ?>