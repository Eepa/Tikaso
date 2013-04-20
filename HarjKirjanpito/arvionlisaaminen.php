<!-- Sivu arvion lisäämistä varten. Sivulle pääsee vain, jos järjestelmään on 
kirjautunut. Sivun tyylistä vastaa tyylitiedosto tyylit.css. Sivuun liittyvät myös linkkilista.php ja footer.php, 
jotka määrittelevät sivulle navigointipalkin ja alalaidan. -->

<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();

require_once 'apuphpt/tekstinmuokkaaja.php';
?>

<!--Tarkistus, onko lomakkeella lähetetyllä tietyllä päivällä harjoituskertoja. Jos harjoituskertoja ei 
ole, annetaan käyttäjälle ilmoitus, joka on kirjoitettu JavaScript-kielellä ja palataan takaisin 
arvion lisäämissivulle.-->


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
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/tyylit.css" />
        <title>Arvion lisääminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Arvion lisääminen</h1>

        <!--Ohjeet lisäämistä varten-->

        <div>
            <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu); ?>

            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" laji, jonka harjoituskertaan haluat lisätä 
                    arvion ja paina nappulaa "Valitse".</li>

                <br>

                <li>Valitse tämän jälkeen avautuvasta päivämäärän valintaruudusta arvioitavan
                    harjoituskerran päivämäärä. <br> Valitse sopiva päivä päivämäärävalikosta 
                    tai kirjoita päivä muodossa vvvv-kk-pp. Paina lopuksi "Valitse"-nappulaa.

                </li>
                <br>
                <li>Valitse avautuvasta listasta sopiva harjoituskerta ja paina sitten 
                    "Valitse harjoitus"-nappia siirtyäksesi arvion lisäämiseen.</li>

                <br>

                <li>
                    Täytä tämän jälkeen avautuvan lomakkeen kentät haluamallasi tavalla ja paina lopuksi 
                    "Lisää arvio"-nappia lisätäksesi uuden arvion. 
                    <br>
                    <br>
                    <ul>
                        <li>Harjoituksen yleisarvosana: Anna harjoituksen yleisarvosana väliltä 1-10.</li>

                        <li>Tyytyväisyysarvosana: Anna arvosana tyytyväisyydestäsi harjoitukseen väliltä 1-10.</li>

                        <li>Sanallinen arvio: Kirjoita harjoitukselle sanallinen arvio. Yläraja pituudelle on 2000 merkkiä.
                            <br> Jos haluat jättää kentän tyhjäksi, lisää kenttään esimerkiksi välilyönti.</li>
                    </ul>
                </li>
            </ol>

            <br>    
        </div>

        <!-- Lajiprofiilin valintalomake. Lajiprofiilin valinnan jälkeen palataan samalle sivulle, jolloin 
       päivämäärän valintalomake aukeaa.-->

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
                <br>
            </form>
        </div>

        <!--Jos lajiprofiili on valittu, valitaan seuraavassa päivämääränvalintalomakkeessa jonkin harjoituksen 
        päivämäärä, jonka harjoituksille halutaan lisätä arvio. Valinnan jälkeen palataan takaisin 
        samalle sivulle, jolloin harjoituskerran valintalomake aukeaa.-->

        <?php
        if (isset($_POST['lajiprofiili'])) {
            $lajinimi = $_POST['lajiprofiili'];
            $laji = $kyselyita->haeLajiIndeksi($lajinimi);

            $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaarat($sessio->hetu, $laji->lajitunnus);
            ?> 

            <!--Informaatiota valitusta lajiprofiilista ja päivämääristä, joina harjoituskertoja on.-->   

            <div>
                <h2> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h2>

                <h2>Päivämäärät, joina lajista harjoituksia:</h2>

                <?php
                for ($x = 0; $x < count($paivamaarat); $x++) {
                    $date = date_create($paivamaarat[$x][0]);
                    echo date_format($date, "d.m.Y") . '<br>';
                }
                echo '<br>';
                ?>
                <br>
            </div>

            <!--Päivämäärälista arvioista, joita valitulla lajiprofiililla on.-->

            <datalist name="paivamaaralista" id="paivamaaralista">
                <?php for ($x = 0; $x < count($paivamaarat); $x++) { ?>
                    <option value="<?php echo $paivamaarat[$x][0] ?>">
                        <?php echo $paivamaarat[$x][0] ?></option>
                <?php }
                ?>
            </datalist>

            <!--Päivämäärän valintalomake-->

            <div> 
                <form action="arvionlisaaminen.php" id="ajanvalinta" method="POST">

                    <fieldset> 
                        <h3>Valitse päivämäärä harjoitukselle, jolle arvio lisätään:</h3>

                        <input type="hidden" name="lajitunnus" id="lajitunnus" 
                               value="<?php echo $laji->lajitunnus ?>">

                        <input type="hidden" name="laji" id="laji" 
                               value="<?php echo $_POST['lajiprofiili'] ?>">

                        <laber for="harjpvm">Harjoitusaika 
                            (valitse valikosta tai anna muodossa vvvv-kk-pp):</laber>
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

        <!--Jos päivämäärä ja lajitunnus on valittu ja samaan aikaan harjoituskertaa 
        ei ole valittu, aukeaa harjoituskerran valintalomake. 
        Kun lomake lähetetään palataan takaisin samalle sivulle ja arvion 
        lisäyslomake aukeaa.-->

        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && !isset($_POST['harjoituskerta'])) {

            $arviot = $kyselyita->harjoituksetJoillaEiVielaArviota($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm']);
            ?> 

            <!--Informaatiota valitusta lajiprofiilista ja päivämäärästä.-->

            <div>
                <h2>Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h2>

                <h2>Päivämääräksi valittu: 
                    <?php
                    $date = date_create($_POST['harjpvm']);
                    echo date_format($date, "d.m.Y") . '<br>';
                    ?></h2>
                <br>
            </div>

            <!--Harjoituskerran valintalomake-->

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

                        <?php for ($int = 0; $int < count($arviot); $int++) { ?>

                            <input type="radio" name="harjoituskerta" id="harjoituskerta"
                                   value="<?php echo $arviot[$int][0]; ?>" required> 
                            <span id="tummennettu">Alkamisaika: </span> <?php echo substr($arviot[$int][0], 0, 5) . " " ?>
                            <span id="tummennettu">Kesto: </span> <?php echo $arviot[$int][1] . " " ?>
                            <span id="tummennettu">Vaikeusaste: </span> <?php echo $arviot[$int][2] . " " ?>
                            <span id="tummennettu">Kuvaus: </span><?php echo teeTeksti($arviot[$int][3]) . " " ?>

                            <br>    
                            <br>
                        <?php } ?>

                        <input type="submit" name="harjoitusaikavalittu" value="Valitse harjoitus">

                    </fieldset>
                </form>
            </div>
            <?php
        }
        ?>

        <!--Jos päivämäärä ja lajitunnus on valittu ja samaan aikaan harjoituskerta
        on valittu, aukeaa arvion lisäyslomake. 
        Kun lomake lähetetään siirrytään sivulle, joka lisää tietokantaan uuden arvion 
        valitulle harjoituskerralle.-->


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && isset($_POST['harjoituskerta'])) {

            $date = date_create($_POST['harjpvm']);

            $harjoituskerta = $kyselyita->haeHarjoituskerta($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjoituskerta']);
            ?>

            <!--Tietoa valitusta harjoituskerrasta-->

            <div>   
                <h2>Lajiprofiili: <?php echo $_POST['laji'] ?></h2>
                <h2>Harjoituspäivä: <?php echo date_format($date, "d.m.Y") ?></h2>
                <h2>Alkamisaika: <?php echo substr($_POST['harjoituskerta'], 0, 5); ?></h2>
                <h2>Kuvaus: <?php echo teeTeksti($harjoituskerta[0][2]); ?></h2>
                <br>
            </div>
            
            <!--Arvion lisäyslomake-->

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
