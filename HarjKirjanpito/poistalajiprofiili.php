<?php

require_once 'tarkastus.php';
varmista_kirjautuminen();
?>

<?php

$lajinimi = $_POST['lajiprofiili'];
$laji = $kyselyita->lajiIndeksi($lajinimi);

if($laji){
   echo "<script language='JavaScript'>window.alert('Poisto onnistui!'); 
        window.location.href = 'lajiprofiilinpoistaminen.php';</script> <br>";
} else {
    die('Ei onnistunut poisto.');
}

?>
