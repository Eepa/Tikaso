<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Lajiprofiilin muokkaaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Lajiprofiilin muokkaaminen</h1>


        <div>
            <?php
            $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

            echo 'Käyttäjän lajit: <br>';

            for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
                echo $kayttajanlajitnumero[$x] . '<br>';
            }

            echo '<br>';
            ?>
        </div>

        <div>
            <form action="lajiprofiilinmuokkaaminen.php" id="lajiprofiilinvalinta" method="POST">
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
            $lajiprofiilinsisalto = $kyselyita->haeLajiprofiilinSisalto($sessio->hetu, $laji->lajitunnus);
            ?>

            <h3> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h3>


            <div> 
                <form action="apuphpt/muokkaaprofiilia.php" id="lajiprofiilinmuokkaaminen" method="POST">

                    <fieldset> 
                        <h3>Muokkaa lajiprofiilia:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <label for="tavoitekuvaus">Tavoitekuvaus:<br></label>
                        <textarea  name="tavoitekuvaus" form="lajiprofiilinmuokkaaminen"
                                   rows="4" cols="50" maxlength="2000" id="tavoitekuvaus" 
                                   required><?php echo $lajiprofiilinsisalto[0][0]; ?></textarea>
                        <br>

                        <label for="tavoiteharjmaara">Tavoiteharjoitusmäärä viikossa:</label>
                        <input type="number" name="tavoiteharjmaara" id="tavoiteharjmaara" 
                               min="1" max="30" value="<?php echo $lajiprofiilinsisalto[0][1] ?>"required>

                        <br>

                        <input type="submit" value="Muokkaa">

                    </fieldset>

                </form>

            </div>
            <?php
        }
        ?>

        <?php require 'apuphpt/footer.php'; ?>
    </body>
</html>
