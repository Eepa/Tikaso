<?php

require_once '../tarkastus.php';
varmista_kirjautuminen();
?>


<?php

echo $_POST['hetu'] . " " . $_POST['lajitunnus'] . " " . $_POST['harjoitusaika'] . " "
        . $_POST['harjkesto'] . " " . 
        $_POST['vaikeusaste'] . " " . $_POST['harjkuvaus']  ;



?>
