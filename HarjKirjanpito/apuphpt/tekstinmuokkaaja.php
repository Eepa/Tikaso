<!--Funktio, joka muokkaa annetusta tekstistä viisitoista sanaa pitkän tekstin.-->

<?php

function teeTeksti($alkup) {

        $taulukko = explode(" ", $alkup, 16);

        $palautettava = "";
        $uusitaulukko = array();
        if (count($taulukko) >= 16) {

            for ($int = 0; $int <= 15; $int++) {
                if ($int == 15) {
                    $uusitaulukko[$int] = "...";
                } else {
                    $uusitaulukko[$int] = $taulukko[$int];
                }
            }
        } else {
            $uusitaulukko = $taulukko;
        }

        for ($int = 0; $int < count($uusitaulukko); $int++) {
            $palautettava = $palautettava . $uusitaulukko[$int] . " ";
        }
        return $palautettava;
    }

?>
