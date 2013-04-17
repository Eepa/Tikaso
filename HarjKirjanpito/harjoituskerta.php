<!-- Harjoituskerta tietosivu. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Sivulla kuvaillaan harjoituskertoja yleisesti. Sivun tyylistä vastaa 
tyylitiedosto tyylit.css. Sivuun liittyvät myös linkkilista.php ja footer.php 
jotka määrittelevät sivulle navigointipalkin ja alalaidan. -->

<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/tyylit.css" />
        <title>Harjoituskerta</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>

        <h1 class="otsikko">Harjoituskerta</h1>

        <div>
            <h2>Kuvaus</h2>
            <p>
                Harjoituskerran avulla pystyt merkitsemään ylös harjoituksesi, jotka olet suorittanut 
                tietyssä lajissa. Voi lisätä harjoituskertoja vain niihin lajeihin, joista sinulla on 
                <br> lajiprofiili tehtynä. Harjoituskerran voi merkitä tietylle päivämäärälle ja alkamisajalle. 
                Lisäksi voit kuvailla harjoitustasi sanallisesti ja antaa harjoituksen keston <br> 
                ja vaikeusasteen.
            </p>
            <br>
        </div>
        
        <!--Tuloste, joka kertoo kaikki käyttäjän lajit, joista on lisätty harjoituskertoja.-->

        <div>
            <h2>Lajisi, joista merkittyjä harjoituskertoja:</h2>

            <p>
                <?php
                $kayttajanlajit = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu);

                for ($x = 0; $x < count($kayttajanlajit); $x++) {
                    echo $kayttajanlajit[$x][0] . '<br>';
                }
                ?>
            </p>

        </div>
        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
