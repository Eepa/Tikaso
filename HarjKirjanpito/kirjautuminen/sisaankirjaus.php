<!--Järjestelmänkirjautumissivu, jonka kirjautumattomat käyttäjät pääsevät näkemään.
Sivun avulla käyttäjä voi syöttää järjestelmään salasanansa ja käyttäjätunnuksensa ja 
kirjautua sivustolle.-->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../tyylitiedostot/tyylit.css" />
        <title>Harjoituskirjanpitojärjestelmä</title>

    </head>

    <body>
        <h1 class="otsikko">Harjoituskirjanpitojärjestelmä</h1>

        <!--Sisäänkirjautumislomake, johon käyttäjä syöttää tarvittavat tiedot.-->

        <div> 
            <h2>Kirjaudu järjestelmään</h2>

            <form action="../kirjaudu.php?sis" method="POST">
                <?php if (isset($_GET['epao'])) { ?> 
                    <p id="virhe">
                        <?php
                        echo 'Salasana tai käyttäjätunnus oli väärä';
                    }
                    ?> </p>


                <p>Syötä tunnuksesi ja salasanasi:</p>

                <fieldset class="kirjautuminenfieldset" id="sisaankirjaus">

                    
                        <label class="kirjautuminenlabel" for="kayttajatunnus">Käyttäjätunnus:</label>

                        <input type="text" name="kayttajatunnus" id="kayttajatunnus" maxlength="30" required><br>
                    

                   
                        <label class="kirjautuminenlabel" for="salasana">Salasana:</label> 
                        
                        <input type="password" name="salasana" id="salasana" maxlength="30" required><br>
                    
                    <br>

                    <input class="kirjnappula" type="submit" value="Kirjaudu">
                </fieldset>

            </form>
        </div>

        <div> <p> <a href="../index.html">Etusivulle</a> </p> </div>

    </body>

</html>
