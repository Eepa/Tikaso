<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Harjoituskerta</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
