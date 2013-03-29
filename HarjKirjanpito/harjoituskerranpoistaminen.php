<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Harjoituskerran poistaminen</title>
    </head>
    <body>

        <h1>Harjoituskerran poistaminen</h1>

        <?php require 'linkkilista.php'; ?>

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


        <?php
        $kayttajanlajitnumero = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu);

        echo 'Käyttäjän lajit: <br>';

        for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
            echo $kayttajanlajitnumero[$x][0] . '<br>';
        }

        echo '<br>';
        ?>

        <div>
            <form action="harjoituskerranpoistaminen.php" id="lajiprofiilinvalinta" method="POST">
                <fieldset> 

                    <h3>Lajiprofiilin valinta:</h3>
                    <label for="lajiprofiili">Lajiprofiilin valinta:</label>

                    <select name="lajiprofiili" id="lajiprofiili" required>
                        <?php for ($x = 0; $x < count($kayttajanlajitnumero); $x++) { ?>
                            <option value="<?php echo $kayttajanlajitnumero[$x][0] ?>">
                                <?php echo $kayttajanlajitnumero[$x][0] ?></option>
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

            $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaarat($sessio->hetu, $laji->lajitunnus);

            for ($x = 0; $x < count($paivamaarat); $x++) {
                echo $paivamaarat[$x][0] . '<br>';
            }

            echo '<br>';
            ?>

            <h3> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h3>



            <datalist name="kuukaudetvuodet" id="kuukaudetvuodet">
                <?php for ($x = 0; $x < count($paivamaarat); $x++) { ?>
                    <option value="<?php echo $paivamaarat[$x][0] ?>">
                        <?php echo $paivamaarat[$x][0] ?></option>
                <?php }
                ?>
            </datalist>

            <div> 
                <form action="harjoituskerranpoistaminen.php" id="ajanvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse poistettavan harjoituksen päivämäärä:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">
                        
                        <input type="hidden" name="laji" id="laji" 
                               value="<?php echo $_POST['lajiprofiili'] ?>">

                        <laber for="harjpvm">Harjoitusaika:</laber>
                        <input type="date" name="harjpvm" id="harjpvm" 
                               list="kuukaudetvuodet" required>

                        <br>

                        <input type="submit" value="Valitse">

                    </fieldset>

                </form>

            </div>
            <?php
        }
        ?>


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus'])) {
            ?>
            <h3> Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h3>

            <div> 
                <form action="apuphpt/poistaharjoituskerta.php" id="harjoituksenpoisto" method="POST">

                    <fieldset> 
                        <h3>Valitse poistettava harjoitus:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $_POST['lajitunnus'] ?>">

                        <input type="hidden" name="harjpvm" id="harjpvm" 
                               value="<?php echo $_POST['harjpvm'] ?>">



                        <input type="submit" name="poista" value="Poista">



                    </fieldset>

                </form>

            </div>


            <?php
        }
        ?>



    </body>
</html>
