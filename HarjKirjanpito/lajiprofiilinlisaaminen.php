<!-- Sivu lajiprofiilin lisäämistä varten. Sivulle pääsee vain, jos järjestelmään on 
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
        <title>Lajiprofiilin lisääminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Lajiprofiilin lisääminen</h1>
        
        <?php $kayttamattomatlajit = require 'apuphpt/muokkaalistoja.php'; ?>

         <!--Ohjeet lajiprofiilin lisäämistä varten.-->
        <div>
            
            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajivalinta" sopiva laji uuteen profiiliin.</li>

                <p>Huom! Jos kohta "Lajivalinta" on tyhjä, tarkoittaa se, että olet lisännyt itsellesi jo 
                    kaikki harjoituskirjanpitojärjestelmässä olevat lajit. <br> Pääset muokkaamaan ja poistamaan 
                    lajiprofiileitasi sivuilla 
                    <a href="lajiprofiilinmuokkaaminen.php">Lajiprofiilin muokkaaminen</a> ja 
                    <a href="lajiprofiilinpoistaminen.php">Lajiprofiilin poistaminen</a>.</p>

                <li>Täytä seuraavaksi kohta "Tavoitekuvaus" haluamallasi kuvauksella lajin treenaamisen 
                    tavoitteista. Yläraja pituudelle on 2000 merkkiä.<br>Jos haluat jättää kentän tyhjäksi, lisää kenttään esimerkiksi välilyönti.</li>
                <br>

                <li>Lopuksi täytä tavoiteharjoitusmäärä viikossa (väliltä 1-30 kertaa/vko) ja paina "Lisää"-nappia, 
                    jolloin uusi profiilisi tallentuu.</li>
            </ol>

            <br>    
        </div>
        
        <!--Lomake lajiprofiilin lisäämistä varten.-->

        <div> 
            <form action="apuphpt/lisaalajiprofiili.php" id="lajiprofiililisays" method="POST">

                <fieldset> 
                    <h3>Lisää uusi lajiprofiili:</h3>

                    <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                    <label for="laji">Lajivalinta:</label>

                    <select name="laji" required>
                        <?php for ($x = 0; $x < count($kayttamattomatlajit); $x++) { ?>
                            <option value="<?php echo $kayttamattomatlajit[$x] ?>">
                                <?php echo $kayttamattomatlajit[$x] ?></option>
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

        <?php require 'apuphpt/footer.php'; ?>

    </body>
</html>
