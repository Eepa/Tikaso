<?php
require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lajiprofiilin poistaminen</title>
    </head>
    <!--    <body onload="submit()">--> <body>

        <!--        <form action="apuphpt/muokkaalistoja.php?kaytlajitnumero" id="submitForm"></form>
                
                <script language='JavaScript'>
                    function submit(){
                        document.submitForm.submit();
                    };</script>
        -->
        <h1>Lajiprofiilin poistaminen</h1>

        <?php require 'linkkilista.php'; ?>

        <?php
        $kayttajanlajitnumero = $kyselyita->haeKayttajanLajitNumeroindeksi($sessio->hetu);

        echo 'Käyttjän lajit <br>';

        for ($x = 0; $x < count($kayttajanlajitnumero); $x++) {
            echo $kayttajanlajitnumero[$x] . '<br>';
        }
        ?>

        <div> 
            <form action="poistalajiprofiili.php" id="lajiprofiilipoisto" method="POST">

                <fieldset> 
                    <h3>Poista lajiprofiili:</h3>

                    <input type="hidden" name="hetu" id="hetu" value="<?php echo $sessio->hetu ?>">

                    <label for="lajiprofiili">Lajiprofiilin valinta:</label>

                    <select name="lajiprofiili" id="lajiprofiili" required>
                        <?php for ($x = 0; $x < count($kayttajanlajitnumero); $x++) { ?>
                            <option value="<?php echo $kayttajanlajitnumero[$x] ?>">
                                <?php echo $kayttajanlajitnumero[$x] ?></option>
                        <?php }
                        ?>
                    </select>

                    <br>

                    <input type="submit" value="Poista">

                </fieldset>


            </form>

        </div>

    </body>
</html>
