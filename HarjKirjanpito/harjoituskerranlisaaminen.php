<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Harjoituskerran lisääminen</title>
    </head>
    <body>

        <h1>Harjoituskerran lisääminen</h1>

        <?php require 'linkkilista.php'; ?>

        <?php
        $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

        echo 'Käyttäjän lajit: <br>';

        for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
            echo $kayttajanlajitnumero[$x] . '<br>';
        }

        echo '<br>';
        ?>

        <?php
        $kayttajanharjoituskerrat = $kyselyita->haeKayttajanHarjoituskerrat($sessio->hetu);
        echo 'Käyttäjän harjoituskerrat: <br>';

        for ($x = 0; $x < count($kayttajanharjoituskerrat); $x++) {
            echo $kayttajanharjoituskerrat[$x][0] . " " . $kayttajanharjoituskerrat[$x][1] . " " .
            $kayttajanharjoituskerrat[$x][2] . " " . $kayttajanharjoituskerrat[$x][3] . " " .
            $kayttajanharjoituskerrat[$x][4] . " " . $kayttajanharjoituskerrat[$x][5];

            echo '<br>';
        }

        echo '<br>';
        ?>

        <div>
            <form action="harjoituskerranlisaaminen.php" id="lajiprofiilinvalinta" method="POST">
                <fieldset> 

                    <h3>Lajiprofiilin valinta:</h3>
                    <label for="lajiprofiili">Lajiprofiilin valinta:</label>

                    <select name="lajiprofiili" id="lajiprofiili" required>
                        <?php for ($x = 0; $x < count($kayttajanlajitnumero); $x++) { ?>
                            <option value="<?php echo $kayttajanlajitnumero[$x] ?>">
                                <?php echo $kayttajanlajitnumero[$x] ?></option>
                        <?php }
                        ?>
                    </select>

                    <br>
                    <input type="submit" value="Valitse">
                </fieldset>
            </form>
        </div>

        <br>

        <?php
        if (isset($_POST['lajiprofiili'])) {
            $lajinimi = $_POST['lajiprofiili'];
            $laji = $kyselyita->lajiIndeksi($lajinimi);
            ?>

            <h3> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h3>


            <div> 
                <form action="apuphpt/lisaaharjoituskerta.php" id="harjoituskerranlisaaminen" method="POST">

                    <fieldset> 
                        <h3>Lisää harjoituskerta:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <laber for="harjoitusaika">Harjoituspäivä ja harjoituksen alkamisaika</laber>
                        <input type="datetime-local" name="harjoitusaika" id="harjoitusaika" 
                                required>

                        <br>

                        <label for="harjkesto">Harjoituksen kesto minuutteina:</label>
                        <input type="number" name="harjkesto" id="harjkesto" 
                               min="0" max="1500" required>

                        <br>

                        <label for="vaikeusaste">Harjoituksen vaikeusaste:</label>
                        <input type="number" name="vaikeusaste" id="vaikeusaste" 
                               min="1" max="10" required>

                        <br>

                        <label for="harjkuvaus">Harjoituskuvaus:<br></label>
                        <textarea  name="harjkuvaus" form="harjoituskerranlisaaminen"
                                   rows="4" cols="50" maxlength="2000" id="harjkuvaus" 
                                   required></textarea>
                        <br>

                        <input type="submit" value="Lisää">

                    </fieldset>

                </form>

            </div>
            <?php
        }
        ?>




    </body>
</html>
