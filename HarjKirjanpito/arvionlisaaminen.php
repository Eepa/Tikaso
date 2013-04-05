<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php
if (isset($_POST['harjpvm'])) {
    $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaaratIndeksein($sessio->hetu, $_POST['lajitunnus']);

    if (!array_key_exists($_POST['harjpvm'], $paivamaarat)) {
        echo "<script language='JavaScript'>window.alert('Ei harjoituskertoja kyseiselle päivälle'); 
        window.location.href = 'arvionlisaaminen.php';</script> <br>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Arvion lisääminen</title>
    </head>
    <body>
        <h1>Arvion lisääminen</h1>

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
        
        echo 'Käyttäjän arviot: <br>';
        
        $kayttajanarviot = $kyselyita->haeKayttajanArvioidenTiedot($sessio->hetu);
        
         for ($x = 0; $x < count($kayttajanarviot); $x++) {
            echo $kayttajanarviot[$x][0] . " " . $kayttajanarviot[$x][1] . " " .
            $kayttajanarviot[$x][2] . " " . $kayttajanarviot[$x][3] . " " .
            $kayttajanarviot[$x][4] . " " . $kayttajanarviot[$x][5];

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
            <form action="arvionlisaaminen.php" id="lajiprofiilinvalinta" method="POST">
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

            $paivamaarat = $kyselyita->harjoituksetJoillaEiVielaArviota($sessio->hetu, $laji->lajitunnus);

            for ($x = 0; $x < count($paivamaarat); $x++) {
                echo $paivamaarat[$x][0] . " " . $paivamaarat[$x][1] . '<br>';
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
                <form action="arvionlisaaminen.php" id="ajanvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse päivämäärä harjoitukselle, jolle arvio lisätään:</h3>

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
                <form action="arvionlisaaminen.php" id="harjoituksenvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse harjoitus, johon arvio lisätään:</h3>
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
                                Kuvaus: <?php echo $harjoituskerrat[$int][3] . " " ?></label>
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


        <?php if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && isset($_POST['harjoituskerta'])) {
            ?>

            <h3>Lajiprofiili: <?php echo $_POST['laji'] ?></h3>
            <h3>Harjoituspäivä: <?php echo date('d F Y', $_POST['harjpvm']) ?></h3>
            <h3>Alkamisaika: <?php echo date('H:i', $_POST['harjoituskerta']) ?></h3>


            <div> 
                <form action="apuphpt/lisaaarvio.php" id="arvionlisaaminen" method="POST">

                    <fieldset> 
                        <h3>Lisää arvio:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $_POST['lajitunnus'] ?>">

                        <input type="hidden" name="harjpvm" id="harjpvm" 
                               value="<?php echo $_POST['harjpvm'] ?>">

                        <input type="hidden" name="harjalku" id="harjalku" 
                               value="<?php echo $_POST['harjoituskerta'] ?>">

                        <label for="yleisarvosana">Harjoituksen yleisarvosana:</label>
                        <input type="number" name="yleisarvosana" id="yleisarvosana" 
                               min="1" max="10" required>

                        <br>

                        <label for="tyytyvaisyysarvo">Tyytyväisyysarvosana:</label>
                        <input type="number" name="tyytyvaisyysarvo" id="tyytyvaisyysarvo" 
                               min="1" max="10" required>
                        <br>

                        <label for="sanallinenarvio">Sanallinenarvio:<br></label>
                        <textarea  name="sanallinenarvio" form="arvionlisaaminen"
                                   rows="4" cols="50" maxlength="2000" id="sanallinenarvio" 
                                   required></textarea>
                        <br>


                        <input type="submit" name="lisaa" value="Lisää arvio">

                    </fieldset>

                </form>

            </div>

        <?php } ?>



        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
