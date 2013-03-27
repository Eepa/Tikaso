<?php

require_once 'tarkastus.php';

class ListojenMuokkaaja {
    private $kyselyita;
    public function __construct() {
        require 'palvelinasetukset.php';

        $this->kyselyita = new Kyselyja($pdo);
    }

    public function haeKaikkiLajitKirjaimin() {

        $kaikkilajitkirjaimin = $this->kyselyita->haeKaikkiLajit();
        return $kaikkilajitkirjaimin;
    }

    public function haeKaikkiLajitNumeroindekseilla() {
        $kaikkilajit = $this->kyselyita->haeKaikkiLajitNumeroindekseillä();
        return $kaikkilajit;
    }

    public function haeKayttajanLajit() {
        $kayttajanlajit = $this->kyselyita->haeKayttajanLajit($sessio->hetu);
        return $kayttajanlajit;
    }

    public function muodostaYhdistettyLista() {
        $yhdistetyt = array_diff(haeKaikkiLajitKirjaimin(), haeKayttajanLajit());
        return $yhdistetyt;
    }

    public function muodostaYhdistetytNumeroin() {
        $yhdistetytnumeroin = array();
        $indeksi = 0;
        $kaikkilajit = haeKaikkiLajitKirjaimin();
        $yhdistetyt = muodostaYhdistettyLista();

        for ($int = 0; $int < count($kaikkilajit); $int++) {
            if (array_key_exists($kaikkilajit[$int], $yhdistetyt)) {
//                echo $yhdistetyt[$kaikkilajit[$int]] . '<br>';
                $yhdistetytnumeroin[$indeksi] = $yhdistetyt[$kaikkilajit[$int]];
                $indeksi++;
            }
        }

        return $yhdistetytnumeroin;
    }

    public function tulostaYhdistetyt() {
        $yhdistetytnumeroin = muodostaYhdistetytNumeroin();
        for ($x = 0; $x < count($yhdistetytnumeroin); $x++) {
            echo $yhdistetytnumeroin[$x] . '<br>';
        }
    }

}

//$listojenMuokkaaja = new ListojenMuokkaaja();
?>