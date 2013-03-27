<?php require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lajiprofiilin lisääminen</title>
    </head>
    <body>
        
        <h1>Lajiprofiilin lisääminen</h1>
        
        <?php require 'linkkilista.php';?>
        <?php echo 'MOI <br>';
         ?>
        <?php 
        
        $lajit = $kyselyita->haelajit();
        
        $arrlength = count($lajit);

        for ($x = 0; $x < $arrlength; $x++) {
            echo $lajit[$x];
            echo "<br>";
        }
        
        
        
        ?>
        <br>
        <?php echo 'MOI';?>
        
        
    </body>
</html>
