<?php

class Kyselyja {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
    }

    private function valmistelut($kyselylause) {
        return $this->_pdo->prepare($kyselylause);
    }

    public function tunnistus($kayttajatunnus, $salasana) {
        $kysely = $this->valmistelut('SELECT hetu FROM kayttaja WHERE kayttajanimi = ? AND salasana = ?');

        if ($kysely->execute(array($kayttajatunnus, $salasana))) {
            return $kysely->fetchObject();
        } else {
            return null;
        }
    }

    public function haeKaikkiLajit() {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji');

        if ($kysely->execute()) {
            $lajit = array();
            while ($rivi = $kysely->fetch()) {
                $lajit[$rivi['lajinimi']] = $rivi['lajinimi'];
            }
            return $lajit;
        }
        return null;
    }

    public function haeKaikkiLajitNumeroindeksi() {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji');
        if ($kysely->execute()) {
            $lajit = array();
            $indeksi = 0;

            while ($rivi = $kysely->fetch()) {
                $lajit[$indeksi] = $rivi['lajinimi'];
                $indeksi++;
            }
            return $lajit;
        }
        return null;
    }

    public function haeKayttajanLajitNumeroindeksi($kayttajatunnus) {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji, lajiprofiili WHERE lajiprofiili.hetu = ' . $kayttajatunnus
                . ' AND lajiprofiili.lajitunnus = laji.lajitunnus');
        if ($kysely->execute()) {
            $lajit = array();
            $indeksi = 0;

            while ($rivi = $kysely->fetch()) {
                $lajit[$indeksi] = $rivi['lajinimi'];
                $indeksi++;
            }

            return $lajit;
        }
        return null;
    }

    public function haeKayttajanLajit($kayttajatunnus) {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji, lajiprofiili WHERE lajiprofiili.hetu = ' . $kayttajatunnus
                . ' AND lajiprofiili.lajitunnus = laji.lajitunnus');
        if ($kysely->execute()) {
            $lajit = array();

            while ($rivi = $kysely->fetch()) {
                $lajit[$rivi['lajinimi']] = $rivi['lajinimi'];
            }

            return $lajit;
        }
        return null;
    }

    public function lajiIndeksi($lajinimi) {
        $kysely = $this->valmistelut('SELECT lajitunnus FROM laji WHERE lajinimi = ?');
        if ($kysely->execute(array($lajinimi))) {
            return $kysely->fetchObject();
        }
        return null;
    }

    public function lisaaLajiprofiili($hetu, $lajitunnus, $tavoitekuvaus, $tavoiteharjmaara) {
//        $kysely = $this->valmistelut('INSERT INTO lajiprofiili 
//            (hetu, lajitunnus, tavoitekuvaus, tavoiteharjmaara) VALUES (' . $hetu . ',' .
//                $lajitunnus . ',' 
//                . $tavoitekuvaus . ','.
//                $tavoiteharjmaara . ')');

        $kysely = $this->valmistelut('INSERT INTO lajiprofiili 
            (hetu, lajitunnus, tavoitekuvaus, tavoiteharjmaara) VALUES (?, ?, ?, ?)');
        if ($kysely->execute(array($hetu, $lajitunnus, $tavoitekuvaus, $tavoiteharjmaara))) {
            return true;
        }

        return false;
    }

    public function poistaLajiprofiili($hetu, $lajitunnus) {

        $kysely = $this->valmistelut('DELETE FROM lajiprofiili WHERE hetu = ? and lajitunnus = ?');

        if ($kysely->execute(array($hetu, $lajitunnus))) {
            return true;
        }
        return false;
    }

}

require 'palvelinasetukset.php';

$kyselyita = new Kyselyja($pdo);
?>

