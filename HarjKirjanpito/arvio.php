<!-- Arvio tietosivu. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Sivulla kuvaillaan arvioita yleisesti. Sivun tyylistä vastaa 
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
        <title>Arvio</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>

        <h1 class="otsikko">Arvio</h1>

        <div>
            <h2>Kuvaus</h2>
            <p>
                Arvion avulla pystyt arvioimaan jotakin tiettyä järjestelmään merkitsemääsi harjoituskertaa. 
                Arvion avulla pystyt kuvailemaan ja arvioimaan harjoituskertaa <br>
                sanallisesti sekä antamaan 
                harjoituskerrasta numeroarvosanan. Lisäksi voit arvioida tyytyväisyyttäsi harjoitukseen 
                numeroarvosanalla ja kuvailemalla <br> tyytyväisyyttä sanalliesti.
            </p>
            <br>
        </div>

        <!--Tuloste, joka kertoo kaikki käyttäjän lajit, joista on lisätty arvioita.-->
        
        <div>
            <h2>Lajisi, joista merkittyjä arvioita:</h2>

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
