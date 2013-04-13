<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
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

        <div>
            <h2>Lajisi, joista merkittyjä arvioita:</h2>

            <p>
                <?php
                $kayttajanlajitnumero = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu);

                for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
                    echo $kayttajanlajitnumero[$x][0] . '<br>';
                }
                ?>
            </p>

        </div>

        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
