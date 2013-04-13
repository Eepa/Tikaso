<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />
        <title>Harjoituskerran lisääminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Harjoituskerran lisääminen</h1>

        <div>
            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" laji, johon haluat lisätä harjoituskerran
                    ja paina nappulaa "Valitse".</li>


                <br>

                <li>Täytä tämän jälkeen avautuvaan "Lisää harjoituskerta"-muokkausvalikkoon 
                    uuden harjoituskerran tiedot.
                    <br>
                    <br>
                    <ul>
                        <li>Harjoituspäivä: Valitse sopiva päivä päivämäärävalikosta tai kirjoita päivä 
                        muodossa vvvv-kk-pp.</li>
                        
                        <li>Harjoituksen alkamisaika: Anna alkamisaika muodossa hh:mm.</li>
                        
                        <li>Harjoituksen kesto: Anna harjoituksen kesto minuutteina väliltä 0-1500.</li>
                        
                        <li>Harjoituksen vaikeusaste: Anna vaikeusaste väliltä 1-10.</li>
                        
                        <li>Harjoituskuvaus: Kirjoita harjoitukselle sanallinen kuvaus. Yläraja pituudelle on 2000 merkkiä.
                            <br> Jos haluat jättää kentän tyhjäksi, lisää kenttään esimerkiksi välilyönti.</li>
                        
                    </ul>
                </li>
                <br>
                <li>Paina tämän jälkeen "Lisää"-nappulaa tallentaaksesi uuden harjoituskerran.</li>
            </ol>

            <br>    


        </div>

        <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu); ?>



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
            <div>
                <h2> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h2>
                <br>
            </div>

            <div> 
                <form action="apuphpt/lisaaharjoituskerta.php" id="harjoituskerranlisaaminen" method="POST">

                    <fieldset> 
                        <h3>Lisää harjoituskerta:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <laber for="harjpvm">Harjoituspäivä (valitse valikosta tai anna muodossa vvvv-kk-pp):</laber>
                        <input type="date" name="harjpvm" id="harjpvm" 
                               required>

                        <br>

                        <laber for="harjalku">Harjoituksen alkamisaika (anna muodossa hh:mm):</laber>
                        <input type="time" name="harjalku" id="harjalku" 
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

        <?php require 'apuphpt/footer.php'; ?>


    </body>
</html>
