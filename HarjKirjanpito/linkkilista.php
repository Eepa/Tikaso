<?php require_once 'tarkastus.php'; ?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="tyylitiedostot/linkkilistaTyyli.css" />

    </head>
    <body>
        <script language="JavaScript">
            document.addEventListener("DOMContentLoaded", function() {
                // dokumentin KAIKKI a-elementit
                linkit = document.getElementsByTagName("a");

                for (var a = 0; a < linkit.length; a++) {
                    if (document.location.href.match(linkit[a].href)) {
                        // a-elementti ilman href-attribuuttia on validi
                        linkit[a].removeAttribute("href");
                        linkit[a].setAttribute("class", "valittu");
                    }
                }
            }, false);
            
        </script>

        <?php if (on_kirjautunut()) { ?>

            <header>
                <div><ul id="navbar">

                        <li><a href="etusivu.php">Etusivu</a></li>
                        <li><a href="lajiprofiili.php">Lajiprofiili</a>
                            <ul>
                                <li><a href="lajiprofiilinlisaaminen.php">Lisääminen</a></li>
                                <li><a href="lajiprofiilinpoistaminen.php">Poistaminen</a></li>
                                <li><a href="lajiprofiilinmuokkaaminen.php">Muokkaaminen</a></li>
                            </ul>
                        </li>
                        <li><a href="harjoituskerta.php">Harjoituskerta</a>
                            <ul>
                                <li><a href="harjoituskerranlisaaminen.php">Lisääminen</a></li>
                                <li><a href="harjoituskerranpoistaminen.php">Poistaminen</a></li>
                                <li><a href="harjoituskerranmuokkaaminen.php">Muokkaaminen</a></li>
                            </ul>
                        </li>
                        <li><a href="arvio.php">Arvio</a>
                            <ul>
                                <li><a href="arvionlisaaminen.php">Lisääminen</a></li>
                                <li><a href="arvionpoistaminen.php">Poistaminen</a></li>
                                <li><a href="arvionmuokkaus.php">Muokkaaminen</a></li>
                            </ul>
                        </li>
                        <li><a href="kirjaudu.php?ulos">Uloskirjautuminen</a></li>
                    </ul>
                </div>
                <br>
            </header>

        <?php } ?>


    </body>
</html>
