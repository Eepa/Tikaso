<!-- Sivu lajiprofiilin poistamista varten. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Sivun tyylistä vastaa tyylitiedosto tyylit.css. Sivuun liittyvät myös linkkilista.php ja footer.php, 
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
        <title>Lajiprofiilin poistaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Lajiprofiilin poistaminen</h1>


        <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitLajinimella($sessio->hetu); ?>
        
         <!--Ohjeet lajiprofiilin poistamista varten.-->

        <div>
            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" poistettava profiili.</li>

                <br>

                <li>Paina tämän jälkeen nappulaa "Poista", jolloin profiili poistuu tiedoistasi.</li>
            </ol>

            <br>    
        </div>

         <!--Lomake lajiprofiilin poistamista varten.-->

        <div> 
            <form action="apuphpt/poistalajiprofiili.php" id="lajiprofiilipoisto" method="POST">

                <fieldset> 
                    <h3>Poista lajiprofiili:</h3>

                    <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                    <label for="lajiprofiili">Lajiprofiilin valinta:</label>

                    <select name="lajiprofiili" id="lajiprofiili" required>
                        <?php for ($x = 0; $x < count($kayttajanlajitnumero); $x++) { ?>
                            <option value="<?php echo $kayttajanlajitnumero[$x][0] ?>">
                                <?php echo $kayttajanlajitnumero[$x][0] ?></option>
                        <?php }
                        ?>
                    </select>

                    <br>

                    <input type="submit" value="Poista">

                </fieldset>

            </form>
        </div>

        <?php require 'apuphpt/footer.php'; ?>

    </body>
</html>
