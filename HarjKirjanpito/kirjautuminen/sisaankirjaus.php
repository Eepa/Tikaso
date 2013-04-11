
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../tyylitiedostot/linkkilistaTyyli.css" />
        <title>Harjoituskirjanpitojärjestelmä</title>

    </head>


    <body>
        <h1 class="otsikko">Harjoituskirjanpitojärjestelmä</h1>

        <div> 
            <h3>Kirjaudu järjestelmään</h3>

            <form action="../kirjaudu.php?sis" method="POST">
                <p>Syötä tunnuksesi ja salasanasi:</p>
                <fieldset class="tesf">

                    <label for="kayttajatunnus">Käyttäjätunnus:</label> 

                    <input type="text" name="kayttajatunnus" id="kayttajatunnus" maxlength="30" required><br>

                    <label for="salasana">Salasana:</label> 
                    <input type="password" name="salasana" id="salasana" maxlength="30" required><br>

                    <input type="submit" value="Kirjaudu">
                </fieldset>


            </form>
        </div>

        <div>
            <p>
                <a href="../index.html">Etusivulle</a>
            </p>
        </div>

    </body>




</html>
