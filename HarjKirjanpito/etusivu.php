<?php
require_once 'tarkastus.php';

varmista_kirjautuminen();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Etusivu - harjoituskirjanpitojärjestelmä</title>
    </head>


    <body>
        <h1>Tervetuloa harjoituskirjanpitojärjestelmään!</h1>

<?php require 'linkkilista.php'; ?>


        <div>
            <h2>Sisältö</h2>
            <p>Harjoituskirjanpitojärjestelmässä voit merkata ylös omat treenikertasi
                ja antaa treeniarvioita itsellesi. Lisäksi voit lisätä itsellesi lajiprofiileita.</p>
        </div>


<?php require 'apuphpt/footer.php'; ?>

    </body>




</html>
