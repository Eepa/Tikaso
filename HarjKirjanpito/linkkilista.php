<?php require_once 'kirjautuminen/tarkastus.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
    </head>
    <body>
        <?php if (on_kirjautunut()) { ?>
            <p>
                <a href="kirjaudu.php?ulos">Uloskirjautuminen</a>
                <a href="etusivu.php">Etusivu</a>
                <a href="lajiprofiilinlisaaminen.php">Lajiprofiilin lisääminen</a>
            </p>
        <?php } ?>
            

    </body>
</html>
