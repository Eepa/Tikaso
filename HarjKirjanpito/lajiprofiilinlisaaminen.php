<?php require_once 'tarkastus.php';
varmista_kirjautuminen();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lajiprofiilin lisääminen</title>
    </head>
    <body>
        
        <h1>Lajiprofiilin lisääminen</h1>
        
        <?php require 'linkkilista.php';?>
        <?php echo 'MOI <br>';
         ?>
        <?php 
        
        $kaikkilajit = $kyselyita->haeKaikkiLajit();
        
        $arrlength = count($kaikkilajit);

        for ($x = 0; $x < $arrlength; $x++) {
            echo $kaikkilajit[$x];
            echo "<br>";
        }
        $kaikkilajit[4] = 'LP';
        
        echo 'Välikirjoitus <br>';
        
        $kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
        $kayttajanlajit[1] = 'SW';
        $pituus = count($kayttajanlajit);
        for ($x = 0; $x < $pituus; $x++) {
            echo $kayttajanlajit[$x];
            echo "<br>";
        }
        
        
        
        $uudetlajit = array();
        $indeksi = 0;
        
        $uudetlajit = array_diff($kaikkilajit, $kayttajanlajit);
            
            
//            if(array_key_exists('SW', $kayttajanlajit) != TRUE){
//               $uudetlajit[$indeksi] = $yksilaji;
//                $indeksi++;
//                echo 'lisatty ' . $yksilaji . '<br>';
//            }
            
//            for($y = 0; $y < count($kayttajanlajit); $y++){
//                
//                if($kayttajanlajit[$y] === $yksilaji){
//                    break;
//                }
//                
//                
//                $uudetlajit[$indeksi] = $yksilaji;
//                $indeksi++;
//            }
           
        
        
        echo 'toinen väli <br>';
        
        for ($x = 0; $x < count($uudetlajit); $x++) {
            echo $uudetlajit[$x];
            echo "<br>";
        }
        
        echo 'LOPPU';
        ?>
        
        
        
        
    </body>
</html>
