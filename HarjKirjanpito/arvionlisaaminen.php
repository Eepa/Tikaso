<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();

function teeTeksti($alkup) {

    $taulukko = explode(" ", $alkup, 16);

    $palautettava = "";
    $uusitaulukko = array();
    if (count($taulukko) >= 16) {

        for ($int = 0; $int <= 15; $int++) {
            if ($int == 15) {
                $uusitaulukko[$int] = "...";
            } else {
                $uusitaulukko[$int] = $taulukko[$int];
            }
        }
    } else {
        $uusitaulukko = $taulukko;
    }

    for ($int = 0; $int < count($uusitaulukko); $int++) {
        $palautettava = $palautettava . $uusitaulukko[$int] . " ";
    }
    return $palautettava;
}
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
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/tyylit.css" />
        <title>Arvion lisääminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Arvion lisääminen</h1>

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

            $paivamaarat = $kyselyita->haeHarjoituskerranPaivamaarat($sessio->hetu, $laji->lajitunnus);
            ?> 

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


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && !isset($_POST['harjoituskerta'])) {

            $arviot = $kyselyita->harjoituksetJoillaEiVielaArviota($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm']);
            ?> 


            <div>
                <h2>Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h2>

                <h2>Päivämääräksi valittu: 
                    <?php
                    $date = date_create($_POST['harjpvm']);
                    echo date_format($date, "d.m.Y") . '<br>';
                    ?></h2>

                <br>
            </div>

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


        <?php
        if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus']) && isset($_POST['harjoituskerta'])) {

            $date = date_create($_POST['harjpvm']);

            $harjoituskerta = $kyselyita->haeHarjoituskerta($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjoituskerta']);
            ?>

            <div>   
                <h2>Lajiprofiili: <?php echo $_POST['laji'] ?></h2>
                <h2>Harjoituspäivä: <?php echo date_format($date, "d.m.Y") ?></h2>
                <h2>Alkamisaika: <?php echo substr($_POST['harjoituskerta'], 0, 5); ?></h2>
                <h2>Kuvaus: <?php echo teeTeksti($harjoituskerta[0][2]); ?></h2>
                <br>
            </div>

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
