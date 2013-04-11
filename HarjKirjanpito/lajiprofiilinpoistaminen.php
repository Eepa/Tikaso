<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Lajiprofiilin poistaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>


        <h1 class="otsikko">Lajiprofiilin poistaminen</h1>


        <?php
        $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

        echo 'Käyttäjän lajit: <br>';

        for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
            echo $kayttajanlajitnumero[$x] . '<br>';
        }

        echo '<br>';
        ?>

        <div> 
            <form action="apuphpt/poistalajiprofiili.php" id="lajiprofiilipoisto" method="POST">

                <fieldset> 
                    <h3>Poista lajiprofiili:</h3>

                    <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                    <label for="lajiprofiili">Lajiprofiilin valinta:</label>

                    <select name="lajiprofiili" id="lajiprofiili" required>
                        <?php for ($x = 0; $x < count($kayttajanlajitnumero); $x++) { ?>
                            <option value="<?php echo $kayttajanlajitnumero[$x] ?>">
                                <?php echo $kayttajanlajitnumero[$x] ?></option>
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
