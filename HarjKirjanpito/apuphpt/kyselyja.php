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
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji ORDER BY lajinimi');

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
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji ORDER BY lajinimi');
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
                . ' AND lajiprofiili.lajitunnus = laji.lajitunnus ORDER BY lajinimi');
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
                . ' AND lajiprofiili.lajitunnus = laji.lajitunnus ORDER BY lajinimi');
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

    public function haeLajiprofiilinSisalto($hetu, $lajitunnus) {
        $kysely = $this->valmistelut('SELECT tavoitekuvaus, tavoiteharjmaara FROM lajiprofiili WHERE 
            hetu = ? AND lajitunnus = ? ');

        if ($kysely->execute(array($hetu, $lajitunnus))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }

            return $sisalto;
        }
        return null;
    }

    public function muokkaaLajiprofiilia($tavoitekuvaus, $tavoiteharjmaara, $hetu, $lajitunnus) {
        $kysely = $this->valmistelut('UPDATE lajiprofiili SET tavoitekuvaus = ?, tavoiteharjmaara = ? 
            WHERE hetu = ? AND lajitunnus = ?');
        if ($kysely->execute(array($tavoitekuvaus, $tavoiteharjmaara, $hetu, $lajitunnus))) {
            return true;
        }
        return false;
    }

    public function haeKayttajanHarjoituskerrat($hetu) {
        $kysely = $this->valmistelut('SELECT lajitunnus, harjpvm, harjalku, harjkesto, vaikeusaste,
            harjkuvaus FROM harjoituskerta WHERE hetu = ? ORDER BY lajitunnus, harjpvm, harjalku');

        if ($kysely->execute(array($hetu))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function lisaaHarjoituskerta($hetu, $lajitunnus, $harjpvm, $harjalku, $harjkesto, $vaikeusaste, $harjkuvaus) {

        $kysely = $this->valmistelut('INSERT INTO harjoituskerta (hetu,
            lajitunnus, harjpvm, harjalku, harjkesto, vaikeusaste, harjkuvaus)
	VALUES (?, ?, ?, ?, ?, ?, ?)');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $harjalku,
                    $harjkesto, $vaikeusaste, $harjkuvaus))) {
            return true;
        }
        return false;
    }

    public function haeKayttajanHarjoituskertalajit($hetu) {
        $kysely = $this->valmistelut('SELECT DISTINCT lajinimi FROM laji, harjoituskerta 
            WHERE harjoituskerta.hetu = ? AND harjoituskerta.lajitunnus = laji.lajitunnus ORDER BY lajinimi');

        if ($kysely->execute(array($hetu))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function haeHarjoituskerranPaivamaarat($hetu, $lajitunnus) {
        $kysely = $this->valmistelut('SELECT DISTINCT harjpvm FROM harjoituskerta WHERE hetu = ? 
            AND lajitunnus = ? ORDER BY harjpvm');
        if ($kysely->execute(array($hetu, $lajitunnus))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function haeHarjoituskerranPaivamaaratIndeksein($hetu, $lajitunnus) {
        $kysely = $this->valmistelut('SELECT DISTINCT harjpvm FROM harjoituskerta WHERE hetu = ? 
            AND lajitunnus = ? ORDER BY harjpvm');
        if ($kysely->execute(array($hetu, $lajitunnus))) {
            $sisalto = array();

            while ($rivi = $kysely->fetch()) {
                $sisalto[$rivi['harjpvm']] = $rivi['harjpvm'];
            }
            return $sisalto;
        }
        return null;
    }

    public function haeHarjoituskerratIlmanHarjalkua($hetu, $lajitunnus, $harjpvm) {
        $kysely = $this->valmistelut('SELECT harjalku, harjkesto, vaikeusaste, harjkuvaus FROM harjoituskerta
            WHERE hetu = ? AND lajitunnus =? AND harjpvm =? ORDER BY harjalku');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function poistaHarjoituskerta($hetu, $lajitunnus, $harjpvm, $harjalku) {
        $kysely = $this->valmistelut('DELETE FROM harjoituskerta WHERE hetu = ? AND lajitunnus = ?
            AND harjpvm = ? AND harjalku = ?');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $harjalku))) {
            return true;
        }
        return false;
    }

    public function haeHarjoituskerta($hetu, $lajitunnus, $harjpvm, $harjalku) {
        $kysely = $this->valmistelut('SELECT harjkesto, vaikeusaste, harjkuvaus FROM harjoituskerta
            WHERE hetu = ? AND lajitunnus =? AND harjpvm =? AND harjalku = ?');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $harjalku))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function muokkaaHarjoituskertaa($hetu, $lajitunnus, $harjpvm, $harjalku, $harjkesto, $vaikeusaste, $harjkuvaus) {
        $kysely = $this->valmistelut('UPDATE harjoituskerta SET harjkesto = ?, vaikeusaste = ? , 
            harjkuvaus = ?
            WHERE hetu = ? AND lajitunnus = ? AND harjpvm = ? AND harjalku = ?');
        if ($kysely->execute(array($harjkesto, $vaikeusaste, $harjkuvaus,
                    $hetu, $lajitunnus, $harjpvm, $harjalku))) {
            return true;
        }
        return false;
    }

    public function haeKayttajanArvioidenTiedot($hetu) {

        $kysely = $this->valmistelut('SELECT lajitunnus, harjpvm, harjalku, yleisarvosana, 
            tyytyvaisyysarvo, sanallinenarvio FROM arvio WHERE hetu = ? AND arvioijahetu = ? ORDER BY
            lajitunnus, harjpvm, harjalku');

        if ($kysely->execute(array($hetu, $hetu))) {
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

    public function lisaaKayttajalleArvio($hetu, $lajitunnus, $harjpvm, $harjalku, $arvioijahetu, $yleisarvosana, $tyytyvaisyysarvo, $sanallinenarvio) {

        $kysely = $this->valmistelut('INSERT INTO arvio (hetu, lajitunnus, 
harjpvm, harjalku, arvioijahetu, yleisarvosana, tyytyvaisyysarvo, sanallinenarvio) VALUES (?, ?,
?, ?, ?, ?, ?, ?)');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $harjalku, $arvioijahetu, $yleisarvosana,
                    $tyytyvaisyysarvo, $sanallinenarvio))) {
            return true;
        }
        return false;
    }
    
    
    public function harjoituksetJoillaEiVielaArviota($hetu, $lajitunnus){
        $kysely = $this->valmistelut('SELECT DISTINCT harjpvm FROM harjoituskerta WHERE hetu = ? AND lajitunnus = ?
            AND harjpvm NOT IN (SELECT DISTINCT harjpvm FROM arvio WHERE hetu = ? AND lajitunnus = ? AND
            arvioijahetu = ?)');
        
        if($kysely->execute(array($hetu, $lajitunnus))){
            $sisalto = array();
            $indeksi = 0;
            while ($rivi = $kysely->fetch()) {
                $sisalto[$indeksi] = $rivi;
                $indeksi++;
            }
            return $sisalto;
        }
        return null;
    }

}

require 'palvelinasetukset.php';

$kyselyita = new Kyselyja($pdo);
?>

