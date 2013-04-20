<!-- Sivu harjoituskerran poistamista varten. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Sivun tyylistä vastaa tyylitiedosto tyylit.css. Sivuun liittyvät myös linkkilista.php ja footer.php, 
jotka määrittelevät sivulle navigointipalkin ja alalaidan. -->

<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();

require_once 'apuphpt/tekstinmuokkaaja.php';
?>

<!--Tarkistus, onko lomakkeella lähetetyllä tietyllä päivällä harjoituskertoja. Jos harjoituskertoja ei 
ole, annetaan käyttäjälle ilmoitus, joka on kirjoitettu JavaScript-kielellä ja palataan takaisin 
harjoituskerran poistamissivulle.-->

<?php
if (isset($_POST['harjpvm'])) {
    $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaaratIndeksein($sessio->hetu, $_POST['lajitunnus']);

    if (!array_key_exists($_POST['harjpvm'], $paivamaarat)) {
        echo "<script language='JavaScript'>window.alert('Ei harjoituskertoja kyseiselle päivälle'); 
        window.location.href = 'harjoituskerranpoistaminen.php';</script> <br>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/tyylit.css" />
        <title>Harjoituskerran poistaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Harjoituskerran poistaminen</h1>

        <!--Ohjeet poistamista varten.-->

        <div>
            <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu); ?>

            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" laji, josta haluat poistaa harjoituskerran
                    ja paina nappulaa "Valitse".</li>

                <br>

                <li>Valitse tämän jälkeen avautuvasta päivämäärän valintaruudusta päivämäärä, 
                    jolta haluat poistaa harjoituskerran. <br> Valitse sopiva päivä päivämäärävalikosta 
                    tai kirjoita päivä muodossa vvvv-kk-pp. Paina lopuksi "Valitse"-nappulaa.

                </li>

                <br>

                <li>Valitse lopuksi avautuvasta listasta poistettava harjoituskerta ja paina sitten 
                    "Poista"-nappia poistaaksesi valitun harjoituskerran.</li>
            </ol>

            <br>    
        </div>

        <!-- Lajiprofiilin valintalomake. Lajiprofiilin valinnan jälkeen palataan samalle sivulle, jolloin 
        päivämäärän valintalomake aukeaa.-->

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
            <br>
        </div>
     
        <!--Jos lajiprofiili on valittu, valitaan seuraavassa päivämääränvalintalomakkeessa jonkin harjoituksen 
        päivämäärä, jonka harjoituksille halutaan tehdä toimenpiteitä. Valinnan jälkeen palataan takaisin 
        samalle sivulle, jolloin poistolomake aukeaa.-->

        <?php
        if (isset($_POST['lajiprofiili'])) {
            $lajinimi = $_POST['lajiprofiili'];
            $laji = $kyselyita->haeLajiIndeksi($lajinimi);

            $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaarat($sessio->hetu, $laji->lajitunnus);
            ?> 

            <!--Informaatiota valitusta lajiprofiilista ja päivämääristä, joina harjoituskertoja on.-->

            <div>
                <h2> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h2>

                <h2>Päivämäärät, joina lajin harjoituksia:</h2>

                <?php
                for ($x = 0; $x < count($paivamaarat); $x++) {
                    $date = date_create($paivamaarat[$x][0]);
                    echo date_format($date, "d.m.Y") . '<br>';
                }
                echo '<br>';
                ?>
                <br>
            </div>

            <!--Päivämäärälista harjoituksista, joita valitulla lajiprofiililla on.-->

            <datalist name="paivamaaralista" id="paivamaaralista">
                <?php for ($x = 0; $x < count($paivamaarat); $x++) { ?>
                    <option value="<?php echo $paivamaarat[$x][0] ?>">
                        <?php echo $paivamaarat[$x][0] ?></option>
                <?php }
                ?>
            </datalist>

            <!--Päivämäärän valintalomake-->

            <div> 
                <form action="harjoituskerranpoistaminen.php" id="ajanvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse poistettavan harjoituksen päivämäärä:</h3>

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <input type="hidden" name="laji" id="laji" 
                               value="<?php echo $_POST['lajiprofiili'] ?>">

                        <laber for="harjpvm">Harjoituspäivä (valitse listasta
                            tai anna muodossa vvvv-kk-pp):</laber>
                        <input type="date" name="harjpvm" id="harjpvm" 
                               list="paivamaaralista" required>

                        <br>

                        <input type="submit" value="Valitse">

                    </fieldset>
                </form>
            </div>
        <?php } ?>

        <!--Jos päivämäärä ja lajiprofiili on valittu, aukeaa harjoituskerran valintalomake. 
        Kun lomake lähetetään siirrytään sivulle, joka poistaa harjiotuskerran tietokannasta.-->

        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus'])) {

            $harjoituskerrat = $kyselyita->haeHarjoituskerratJaNiidenHarjalku($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm']);
            ?> 

            <!--Informaatiota valitusta lajiprofiilista ja päivämäärästä.-->

            <div>
                <h2>Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h2>

                <h2>Päivämääräksi valittu: 
                    <?php
                    $date = date_create($_POST['harjpvm']);
                    echo date_format($date, "d.m.Y");
                    ?></h2>

                <br>
            </div>

            <!--Harjoituskerran valintalomake-->

            <div> 
                <form action="apuphpt/poistaharjoituskerta.php" id="harjoituksenpoisto" method="POST">

                    <fieldset> 
                        <h3>Valitse poistettava harjoitus:</h3>
                        <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $_POST['lajitunnus'] ?>">

                        <input type="hidden" name="harjpvm" id="harjpvm" 
                               value="<?php echo $_POST['harjpvm'] ?>">

                        <input type="hidden" name="harjkertojenmaara" id="harjkertojenmaara"
                               value="<?php echo count($harjoituskerrat); ?>">

                        <?php for ($int = 0; $int < count($harjoituskerrat); $int++) { ?>

                            <input type="radio" name="harjoituskerta" id="harjoituskerta"
                                   value="<?php echo $harjoituskerrat[$int][0]; ?>" required> 
                            <span id="tummennettu">Alkamisaika: </span> <?php echo substr($harjoituskerrat[$int][0], 0, 5) . " " ?>
                            <span id="tummennettu">Kesto: </span> <?php echo $harjoituskerrat[$int][1] . " " ?>
                            <span id="tummennettu">Vaikeusaste: </span> <?php echo $harjoituskerrat[$int][2] . " " ?>
                            <span id="tummennettu">Kuvaus: </span><?php echo teeTeksti($harjoituskerrat[$int][3]) . " " ?>

                            <br>    
                            <br>
                        <?php } ?>

                        <input type="submit" name="poista" value="Poista">

                    </fieldset>
                </form>
            </div>
            <?php
        }
        ?>

        <?php require 'apuphpt/footer.php'; ?>

    </body>
</html>
