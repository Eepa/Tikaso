<!--Järjestelmässä käytettävät kyselyt ja niiden suorittaja. Kyselynsuorittaja 
määritellään luokasta Kyselyja.--> 

<?php

class Kyselyja {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
    }

    private function valmistelut($kyselylause) {
        return $this->_pdo->prepare($kyselylause);
    }

    private function palautaTaulukko($kysely) {
        $uusiTaulukko = array();
        $indeksi = 0;
        while ($rivi = $kysely->fetch()) {
            $uusiTaulukko[$indeksi] = $rivi;
            $indeksi++;
        }
        return $uusiTaulukko;
    }

    public function tunnistus($kayttajatunnus, $salasana) {
        $kysely = $this->valmistelut('SELECT hetu FROM kayttaja WHERE kayttajanimi = ? AND salasana = ?');

        if ($kysely->execute(array($kayttajatunnus, $salasana))) {
            return $kysely->fetchObject();
        }
        return null;
    }

    public function kaikkiLajiprofiilitJoitaEiKayttajalla($hetu) {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji WHERE lajitunnus  
            NOT IN (SELECT DISTINCT lajitunnus FROM 
            lajiprofiili WHERE hetu = ?)');

        if ($kysely->execute(array($hetu))) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeKaikkiLajinimet() {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji ORDER BY lajinimi');
      
        if ($kysely->execute()) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeKayttajanLajitLajinimella($kayttajatunnus) {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji, lajiprofiili WHERE lajiprofiili.hetu = ? AND lajiprofiili.lajitunnus = laji.lajitunnus ORDER BY lajinimi');
       
        if ($kysely->execute(array($kayttajatunnus))) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeLajiIndeksi($lajinimi) {
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
            return $this->palautaTaulukko($kysely);
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
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeHarjoituskerranPaivamaarat($hetu, $lajitunnus) {
        $kysely = $this->valmistelut('SELECT DISTINCT harjpvm FROM harjoituskerta WHERE hetu = ? 
            AND lajitunnus = ? ORDER BY harjpvm');
        
        if ($kysely->execute(array($hetu, $lajitunnus))) {
            return $this->palautaTaulukko($kysely);
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

    public function haeHarjoituskerratJaNiidenHarjalku($hetu, $lajitunnus, $harjpvm) {
        $kysely = $this->valmistelut('SELECT harjalku, harjkesto, vaikeusaste, harjkuvaus FROM harjoituskerta
            WHERE hetu = ? AND lajitunnus =? AND harjpvm =? ORDER BY harjalku');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm))) {
            return $this->palautaTaulukko($kysely);
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
            return $this->palautaTaulukko($kysely);
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

    public function harjoituksetJoillaEiVielaArviota($hetu, $lajitunnus, $harjpvm) {
        $kysely = $this->valmistelut('SELECT DISTINCT harjalku, harjkesto, vaikeusaste, harjkuvaus FROM harjoituskerta WHERE hetu = ? AND lajitunnus = ?
            AND harjpvm = ? AND harjalku NOT IN (SELECT DISTINCT harjalku FROM arvio WHERE hetu = ? AND lajitunnus = ? AND
            arvioijahetu = ? AND harjpvm = ?)');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $hetu, $lajitunnus, $hetu, $harjpvm))) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeArvionPaivamaarat($hetu, $lajitunnus) {
        $kysely = $this->valmistelut('SELECT DISTINCT harjpvm FROM arvio WHERE hetu = ? 
            AND lajitunnus = ? AND arvioijahetu = ? ORDER BY harjpvm');
        if ($kysely->execute(array($hetu, $lajitunnus, $hetu))) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function haeArviotTiettynaPaivanaTietylleLajille($hetu, $lajitunnus, $harjpvm) {
        $kysely = $this->valmistelut('SELECT harjalku, yleisarvosana, tyytyvaisyysarvo, sanallinenarvio 
            FROM arvio WHERE hetu = ? AND lajitunnus = ?
            AND harjpvm = ? AND arvioijahetu = ? ORDER BY harjalku');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $hetu))) {
            return $this->palautaTaulukko($kysely);
        }
        return null;
    }

    public function poistaKayttajanArvio($hetu, $lajitunnus, $harjpvm, $harjalku) {
        $kysely = $this->valmistelut('DELETE FROM arvio WHERE hetu  = ? AND lajitunnus = ? AND 
            harjpvm = ? AND harjalku = ? AND arvioijahetu = ?');

        if ($kysely->execute(array($hetu, $lajitunnus, $harjpvm, $harjalku, $hetu))) {
            return true;
        }
        return false;
    }

    public function muokkaaArviota($hetu, $lajitunnus, $harjpvm, $harjalku, $yleisarvosana, $tyytyvaisyysarvo, $sanallinenarvio) {

        $kysely = $this->valmistelut('UPDATE arvio SET yleisarvosana = ?, tyytyvaisyysarvo = ? , 
            sanallinenarvio = ?
            WHERE hetu = ? AND lajitunnus = ? AND harjpvm = ? AND harjalku = ? AND arvioijahetu = ?');
        if ($kysely->execute(array($yleisarvosana, $tyytyvaisyysarvo,
                    $sanallinenarvio,
                    $hetu, $lajitunnus, $harjpvm, $harjalku, $hetu))) {
            return true;
        }
        return false;
    }

}

require 'palvelinasetukset.php';

$kyselyita = new Kyselyja($pdo);
?>

