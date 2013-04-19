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
        window.location.href = 'arvionpoistaminen.php';</script> <br>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/tyylit.css" />
        <title>Arvion poistaminen</title>
    </head>
    <body>
        <?php require 'linkkilista.php'; ?>
        <h1 class="otsikko">Arvion poistaminen</h1>

        <div>

            <?php $kayttajanlajitnumero = $kyselyita->haeKayttajanHarjoituskertaLajit($sessio->hetu); ?>

            <h2>Ohjeet</h2>

            <ol>
                <li>Valitse kohdasta "Lajiprofiilin valinta" laji, jonka arvion haluat poistaa 
                    ja paina nappulaa "Valitse".</li>

                <br>

                <li>Valitse tämän jälkeen avautuvasta päivämäärän valintaruudusta poistettavan 
                    arvion päivämäärä. <br> Valitse sopiva päivä päivämäärävalikosta 
                    tai kirjoita päivä muodossa vvvv-kk-pp. Paina lopuksi "Valitse"-nappulaa.

                </li>
                <br>
                <li>Valitse avautuvasta listasta poistettava arvio ja paina sitten 
                    "Poista arvio"-nappia poistaaksesi valitun arvion.</li>

                <br>    

                </div>
                <div>
                    <form action="arvionpoistaminen.php" id="lajiprofiilinvalinta" method="POST">
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
                    $laji = $kyselyita->haeLajiIndeksi($lajinimi);

                    $paivamaarat = $kyselyita->haeArvionPaivamaarat($sessio->hetu, $laji->lajitunnus);
                    ?> 


                    <div>
                        <h2> Lajiprofiiliksi valittu: <?php echo $_POST['lajiprofiili'] ?></h2>

                        <h2>Päivämäärät, joina lajista arvioita:</h2>

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
                        <form action="arvionpoistaminen.php" id="ajanvalinta" method="POST">

                            <fieldset> 
                                <h3>Valitse päivämäärä arvioille:</h3>

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
                if (isset($_POST['harjpvm']) && isset($_POST['lajitunnus'])) {

                    $arviot = $kyselyita->haeArviotTiettynaPaivanaTietylleLajille($sessio->hetu, $_POST['lajitunnus'], $_POST['harjpvm']);
                    ?> 

                    <div>
                        <h2> Lajiprofiiliksi valittu: <?php echo $_POST['laji'] ?></h2>

                        <h2>Päivämääräksi valittu: 
                            <?php
                            $date = date_create($_POST['harjpvm']);
                            echo date_format($date, "d.m.Y") . '<br>';
                            ?></h2>

                        <br>

                    </div>

                    <div> 
                        <form action="apuphpt/poistaarvio.php" id="arvionpoistaminen" method="POST">

                            <fieldset> 
                                <h3>Valitse poistettava arvio:</h3>
                                <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                                <input type="hidden" name="lajitunnus" id="lajitunnus" 
                                       value="<?php echo $_POST['lajitunnus'] ?>">

                                <input type="hidden" name="harjpvm" id="harjpvm" 
                                       value="<?php echo $_POST['harjpvm'] ?>">

                                <input type="hidden" name="laji" id="laji" 
                                       value="<?php echo $_POST['laji'] ?>">

                                <?php for ($int = 0; $int < count($arviot); $int++) { ?>

                                    <input type="radio" name="arvio" id="arvio"
                                           value="<?php echo $arviot[$int][0]; ?>" required> 
                                    <span id="tummennettu">Harjoituksen alkamisaika: </span> <?php echo substr($arviot[$int][0], 0, 5) . " " ?>
                                    <span id="tummennettu">Yleisarvosana: </span> <?php echo $arviot[$int][1] . " " ?>
                                    <span id="tummennettu">Tyytyväisyysarvo: </span> <?php echo $arviot[$int][2] . " " ?>
                                    <span id="tummennettu">Sanallinen arvio: </span><?php echo teeTeksti($arviot[$int][3]) . " " ?>

                                    <br>    
                                    <br>
                                <?php } ?>

                                <input type="submit" name="poistettuarvio" value="Poista arvio">
                            </fieldset>

                        </form>
                    </div>

                    <?php
                }
                ?>


                <?php require 'apuphpt/footer.php'; ?>
                </body>
                </html>
