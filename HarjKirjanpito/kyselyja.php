<?php

class Kyselyja {

    private $_pdo;

    public function __construct($pdo) {
        $this->_pdo = $pdo;
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
        $kysely->execute();
        
        $lajit = array();
        $indeksi = 0;

        while ($rivi = $kysely->fetch()) {
            
            $lajit[$indeksi] = $rivi['lajinimi'];
            $indeksi++;
        }
                
        return $lajit;
    }
    
    public function haeKayttajanLajit($kayttajatunnus) {
        $kysely = $this->valmistelut('SELECT lajinimi FROM laji, lajiprofiili WHERE lajiprofiili.hetu = ' . $kayttajatunnus 
                . ' AND lajiprofiili.lajitunnus = laji.lajitunnus');
        $kysely->execute();
        
        $lajit = array();
        $indeksi = 0;

        while ($rivi = $kysely->fetch()) {
            
            $lajit[$indeksi] = $rivi['lajinimi'];
            $indeksi++;
        }
                
        return $lajit;
    }

    private function valmistelut($kyselylause) {
        return $this->_pdo->prepare($kyselylause);
    }

}

require 'palvelinasetukset.php';

$kyselyita = new Kyselyja($pdo);
?>

