<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Lajiprofiili</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>

        <h1 class="otsikko">Lajiprofiili</h1>

        <div>
            <h2>Kuvaus</h2>
            <p>
                Lajiprofiili tarkoittaa johonkin tiettyyn lajiin liittyvää 
                kuvausta tämän lajin harjoittelun tavoitteista. 
                Sinulla voi olla useampi tai ei yhtään lajiprofiilia määriteltynä. <br>

                Kaikkiin määrittelemiisi lajiprofiileihin pystyt lisäämään kyseisen lajin harjoituskertoja.
                Tämän järjestelmän avulla pystyt luomaan itsellesi uusia lajiprofiileita ja <br> 
                muokkaamaan tai 
                poistamaan jo luomiasi profiileita.
            </p>
            <br>

        </div>

        <div>
            <h2>Järjestelmän kaikki lajit:</h2>

            <?php
            $kaikkiLajitNumeroindeksi = $kyselyita->haeKaikkiLajitNumeroindeksi();
            $kaikkiLajit = $kyselyita->haeKaikkiLajit();

            for ($int = 0; $int < count($kaikkiLajitNumeroindeksi); $int++) {
                echo $kaikkiLajitNumeroindeksi[$int] . '<br>';
            }
            ?>

        </div>


        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
