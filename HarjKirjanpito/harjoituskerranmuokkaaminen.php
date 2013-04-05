<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php
if (isset($_POST['harjpvm'])) {
    $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaaratIndeksein($sessio->hetu, $_POST['lajitunnus']);

    if (!array_key_exists($_POST['harjpvm'], $paivamaarat)) {
        echo "<script language='JavaScript'>window.alert('Ei harjoituskertoja kyseiselle päivälle'); 
        window.location.href = 'harjoituskerranmuokkaaminen.php';</script> <br>";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Harjoituskerran muokkaaminen</title>
    </head>
    <body>
        <h1>Harjoituskerran muokkaaminen</h1>

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
            <form action="harjoituskerranmuokkaaminen.php" id="lajiprofiilinvalinta" method="POST">
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



            <datalist name="paivamaaralista" id="paivamaaralista">
                <?php for ($x = 0; $x < count($paivamaarat); $x++) { ?>
                    <option value="<?php echo $paivamaarat[$x][0] ?>">
                        <?php echo $paivamaarat[$x][0] ?></option>
                <?php }
                ?>
            </datalist>

            <div> 
                <form action="harjoituskerranmuokkaaminen.php" id="ajanvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse muokattavan harjoituksen päivämäärä:</h3>

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <input type="hidden" name="laji" id="laji" 
                               value="<?php echo $_POST['lajiprofiili'] ?>">

                        <laber for="harjpvm">Harjoitusaika:</laber>
                        <input type="date" name="harjpvm" id="harjpvm" 
                               list="paivamaaralista" required>

                        <br>

                        <input type="submit" value="Valitse">

                    </fieldset>

                </form>

            </div>
            <?php
        }
        ?>


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && !isset($_POST['harjoituskerta'])) {

            $harjoituskerrat = $kyselyita->haeHarjoituskerratIlmanHarjalkua($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm']);

            for ($int = 0; $int < count($harjoituskerrat); $int++) {
                echo $harjoituskerrat[$int][0] . " " . $harjoituskerrat[$int][1] . " " .
                $harjoituskerrat[$int][2] . " " .
                $harjoituskerrat[$int][3];
            }
            ?>
            <h3> Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h3>

            <div> 
                <form action="harjoituskerranmuokkaaminen.php" id="harjoituksenvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse poistettava harjoitus:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $_POST['lajitunnus'] ?>">

                        <input type="hidden" name="harjpvm" id="harjpvm" 
                               value="<?php echo $_POST['harjpvm'] ?>">

                        <input type="hidden" name="laji" id="laji" 
                               value="<?php echo $_POST['laji'] ?>">

                        <?php for ($int = 0; $int < count($harjoituskerrat); $int++) { ?>

                            <input type="radio" name="harjoituskerta" id="harjoituskerta"
                                   value="<?php echo $harjoituskerrat[$int][0];
                            ?>" required> <label for="harjoituskerta">
                                Alkamisaika: <?php echo substr($harjoituskerrat[$int][0], 0, 5) . " " ?>
                                Kesto: <?php echo $harjoituskerrat[$int][1] . " " ?>
                                Vaikeusaste: <?php echo $harjoituskerrat[$int][2] . " " ?>
                                Kuvaus: <?php echo $harjoituskerrat[$int][3] . " " ?>
                            </label>
                            <br>    
                        <?php } ?>
                        <br>

                        <input type="submit" name="harjoitusaikavalittu" value="Valitse harjoitus">



                    </fieldset>

                </form>

            </div>


            <?php
        }
        ?>


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && isset($_POST['harjoituskerta'])) {



            $harjoituskerransisalto = $kyselyita->haeHarjoituskerta(
                    $sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjoituskerta']);
            echo $harjoituskerransisalto[0][0] . " " . $harjoituskerransisalto[0][1] . " " .
            $harjoituskerransisalto[0][2];
            ?>

            <h3>Lajiprofiili: <?php echo $_POST['laji'] ?></h3>
            <h3>Harjoituspäivä: <?php echo date('d F Y', $_POST['harjpvm']) ?></h3>
            <h3>Alkamisaika: <?php echo date('H:i', $_POST['harjoituskerta']) ?></h3>


            <div> 
                <form action="apuphpt/muokkaaharjoituskertaa.php" id="harjoituskerranmuokkaaminen" method="POST">

                    <fieldset> 
                        <h3>Muokkaa harjoituskertaa:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $_POST['lajitunnus'] ?>">

                        <input type="hidden" name="harjpvm" id="harjpvm" 
                               value="<?php echo $_POST['harjpvm'] ?>">

                        <input type="hidden" name="harjalku" id="harjalku" 
                               value="<?php echo $_POST['harjoituskerta'] ?>">

                        <label for="harjkesto">Harjoituksen kesto minuutteina:</label>
                        <input type="number" name="harjkesto" id="harjkesto" 
                               min="0" max="1500" value="<?php echo $harjoituskerransisalto[0][0] ?>"required>

                        <br>

                        <label for="vaikeusaste">Vaikeusaste:</label>
                        <input type="number" name="vaikeusaste" id="vaikeusaste" 
                               min="1" max="10" value="<?php echo $harjoituskerransisalto[0][1] ?>"required>
                        <br>

                        <label for="harjoituskuvaus">Harjoituskuvaus:<br></label>
                        <textarea  name="harjkuvaus" form="harjoituskerranmuokkaaminen"
                                   rows="4" cols="50" maxlength="2000" id="harjkuvaus" 
                                   required><?php echo $harjoituskerransisalto[0][2]; ?></textarea>
                        <br>


                        <input type="submit" name="muokkaa" value="Muokkaa">

                    </fieldset>

                </form>

            </div>

        <?php } ?>

        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
