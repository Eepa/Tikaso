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
//?>

<?php

$kaikkiLajitNumeroindeksi = $kyselyita->haeKaikkiLajitNumeroindeksi();
$kaikkiLajit = $kyselyita->haeKaikkiLajit();

echo $kaikkiLajitNumeroindeksi[0] . " " . $kaikkiLajitNumeroindeksi[1] . " " . $kaikkiLajitNumeroindeksi[2] . ' ' . $kaikkiLajitNumeroindeksi[3] . '<br>';




echo 'Käyttäjän lajit <br>';

$kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
$kayttajanLajitNumeroindeksi = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

echo $kayttajanLajitNumeroindeksi[0] . " " . $kayttajanLajitNumeroindeksi[1] . " " .
 $kayttajanLajitNumeroindeksi[2] . ' <br>';

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