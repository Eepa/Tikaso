<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

//if (isset($_GET['kaytlajitnumero'])) {
////    echo 'testi';
//    $kayttajanLajitNumeroindeksi = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);
//    
//    if($kayttajanLajitNumeroindeksi){
//        return $kayttajanLajitNumeroindeksi;
//    } else {
//        echo 'Epäonnistui';
//    }
//    
//}
//
?>

<?php

$kaikkiLajitNumeroindeksi = $kyselyita->haeKaikkiLajitNumeroindeksi();
$kaikkiLajit = $kyselyita->haeKaikkiLajit();

for ($int = 0; $int < count($kaikkiLajitNumeroindeksi); $int++) {
    echo $kaikkiLajitNumeroindeksi[$int] . '<br>';
}

echo '<br> Käyttäjän lajit: <br>';

$kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
$kayttajanLajitNumeroindeksi = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

for ($int = 0; $int < count($kayttajanLajitNumeroindeksi); $int++) {
    echo $kayttajanLajitNumeroindeksi[$int] . '<br>';
}


$yhdistetyt = array_diff($kaikkiLajit, $kayttajanlajit);

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




return muodostaYhdistetytNumeroin($yhdistetyt, $kaikkiLajitNumeroindeksi);
?>