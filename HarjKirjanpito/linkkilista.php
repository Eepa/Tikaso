<?php require_once 'tarkastus.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

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
                    }
                }
            }, false);
    
        </script>

        <?php if (on_kirjautunut()) { ?>
            <p>
                <a href="kirjaudu.php?ulos">Uloskirjautuminen</a>
                <a href="etusivu.php">Etusivu</a>
                <a href="lajiprofiilinlisaaminen.php">Lajiprofiilin lisääminen</a>
                <a href="lajiprofiilinpoistaminen.php">Lajiprofiilin poistaminen</a>
                <a href="lajiprofiilinmuokkaaminen.php">Lajiprofiilin muokkaaminen</a>
            </p>
        <?php } ?>


    </body>
</html>
