<?php
require_once 'tarkastus.php';

varmista_kirjautuminen();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Etusivu - harjoituskirjanpitojärjestelmä</title>
    </head>


    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Tervetuloa harjoituskirjanpitojärjestelmään!</h1>




        <div>
            <h2>Sisältö</h2>
            <p>Harjoituskirjanpitojärjestelmässä voit merkata ylös omat treenikertasi
                ja antaa treeniarvioita itsellesi. Lisäksi voit lisätä itsellesi lajiprofiileita.</p>
        </div>


        <?php require 'apuphpt/footer.php'; ?>

    </body>




</html>
