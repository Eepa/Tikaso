<!-- Sivu lajiprofiilin muokkaamista varten. Sivulle pääsee vain, jos järjestelmään on 
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
        <title>Lajiprofiilin muokkaaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Lajiprofiilin muokkaaminen</h1>

        <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu); ?>

        <!--Ohjeet muokkaamista varten-->

        <div>
            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" profiili, jota haluat muokata ja paina "Valitse"
                    -nappulaa.</li>
                <br>
                <li>Muokkaa avautuvassa muokkausnäytössä valitun lajiprofiilin tavoitekuvausta ja tavoiteharjoitusmäärää
                    haluamallasi tavalla.</li>

                <p>Huom! Lajiprofiilin alkuperäinen sisältö näkyy aluksi "Tavoitekuvaus"- ja "Tavoiteharjoitusmäärä"
                    -laatikoissa, kun muokattava profiili on valittu</p>

                <li>Lopuksi paina nappulaa "Muokkaa", jolloin muutokset tallentuvat lajiprofiiliisi.</li>
            </ol>

            <br>    
        </div>


        <!-- Lajiprofiilin valintalomake. Lajiprofiilin valinnan jälkeen palataan samalle sivulle, jolloin 
        muokkauslomake aukeaa.-->

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
            <br>
        </div>

        <!--Lajiprofiilin muokkauslomake, joka tulee näkyviin, jos muokattava lajiprofiili on valittu.-->

        <?php
        if (isset($_POST['lajiprofiili'])) {
            $laji = $kyselyita->lajiIndeksi($_POST['lajiprofiili']);
            $lajiprofiilinsisalto = $kyselyita->haeLajiprofiilinSisalto($sessio->hetu, $laji->lajitunnus);
            ?>

            <div> 
                <h2> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h2> <br>

                <form action="apuphpt/muokkaaprofiilia.php" id="lajiprofiilinmuokkaaminen" method="POST">

                    <fieldset> 
                        <h3>Muokkaa lajiprofiilia:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">
                        
                        <!--Tekstikenttä, johon ilmestyy aluksi aikaisempi tavoitekuvauksen sisältö.-->

                        <label for="tavoitekuvaus">Tavoitekuvaus:<br></label>
                        <textarea  name="tavoitekuvaus" form="lajiprofiilinmuokkaaminen"
                                   rows="4" cols="50" maxlength="2000" id="tavoitekuvaus" 
                                   required><?php echo $lajiprofiilinsisalto[0][0]; ?></textarea>
                        <br>
                        
                        <!--Numerokenttä, johon ilmestyy aluksi aikaisempi tavoiteharjoitusmäärän sisältö.-->

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
