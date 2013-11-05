<!-- Harjoituskirjanpitojärjestelmän etusivu. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Etusivulla kuvaillaan järjestelmää yleisesti. Sivun tyylistä vastaa 
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
        <title>Etusivu - harjoituskirjanpitojärjestelmä</title>
    </head>

    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Tervetuloa harjoituskirjanpitojärjestelmään!</h1>

        <div>
            <h2>Sisältö</h2>
            <p>Harjoituskirjanpitojärjestelmässä voit merkata ylös omat treenikertasi
                ja antaa treeniarvioita itsellesi. <br> Lisäksi voit lisätä itsellesi lajiprofiileita, 
                joihin liittyen harjoituskertoja lisätään.</p>
        </div>

        <?php require 'apuphpt/footer.php'; ?>

    </body>

</html>
