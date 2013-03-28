<?php
require_once 'tarkastus.php';
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

        <?php require 'linkkilista.php'; ?>
        <?php echo 'Kaikki lajit: <br>';
        ?>
        <?php

        $yhdistetytnumeroin = require 'apuphpt/muokkaalistoja.php';

        echo '<br> Lajit joita ei vielä käyttäjällä <br>';

        for ($x = 0; $x < count($yhdistetytnumeroin); $x++) {
            echo $yhdistetytnumeroin[$x] . '<br>';
        }
        
        echo '<br>';
        
        ?>

        <div> 
            <form action="apuphpt/lisaalajiprofiili.php" id="lajiprofiililisays" method="POST">

                <fieldset> 
                    <h3>Lisää uusi lajiprofiili:</h3>
                    
                    <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu?>">

                    <label for="laji">Lajivalinta:</label>

                    <select name="laji" required>
                        <?php for ($x = 0; $x < count($yhdistetytnumeroin); $x++) { ?>
                            <option value="<?php echo $yhdistetytnumeroin[$x] ?>">
                                <?php echo $yhdistetytnumeroin[$x] ?></option>
                        <?php }
                        ?>
                    </select>
                    
                    <br>
                    
                    <label for="tavoitekuvaus">Tavoitekuvaus:<br></label>
                    <textarea  name="tavoitekuvaus" form="lajiprofiililisays"
                           rows="4" cols="50" maxlength="2000" id="tavoitekuvaus" required></textarea>
                    
                    <br>
                    
                    <label for="tavoiteharjmaara">Tavoiteharjoitusmäärä viikossa:</label>
                    <input type="number" name="tavoiteharjmaara" id="tavoiteharjmaara" 
                           min="1" max="30" required>
                    
                    <br>
                    
                    <input type="submit" value="Lisää">
                    
                </fieldset>


            </form>

        </div>



    </body>
</html>
