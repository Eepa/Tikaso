<?php
require_once 'kirjautuminen/tarkastus.php';
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

        <?php require 'linkkilista.php'; ?>
        <?php echo 'Kaikki lajit: <br>';
        ?>
        <?php
//        require 'muokkaalistoja.php';
        
        $yhdistetytnumeroin = require 'apuphpt/muokkaalistoja.php';
        
        echo 'Lajit joita ei vielä käyttäjällä <br>';
        
        for($x = 0; $x < count($yhdistetytnumeroin); $x++){
            echo $yhdistetytnumeroin[$x] . '<br>';
        }
        

//        $kaikkilajit = $kyselyita->haeKaikkiLajitNumeroindekseillä();
//        $kaikkilajitkirjaimin = $kyselyita->haeKaikkiLajit();
////                        
//        echo $kaikkilajit[0] . " " . $kaikkilajit[1] . " " . $kaikkilajit[2] . ' ' . $kaikkilajit[3] . '<br>';
//        
//        
//        
//    
//
//                
//        echo 'Käyttäjän lajit <br>';
//        
//        $kayttajanlajit = $kyselyita->haeKayttajanLajit($sessio->hetu);
//        
//        
//        $yhdistetyt = array_diff($kaikkilajitkirjaimin, $kayttajanlajit);
//        $yhdistetytnumeroin = array();
//        $indeksi = 0;
//        
//        for($int = 0; $int < count($kaikkilajit); $int++){
//            if(array_key_exists($kaikkilajit[$int], $yhdistetyt)){
//                echo $yhdistetyt[$kaikkilajit[$int]] . '<br>';
//                $yhdistetytnumeroin[$indeksi] = $yhdistetyt[$kaikkilajit[$int]];
//                $indeksi++;
//            }
//        }
//        
//        echo 'juttuja <br>';
//        
//        for($x = 0; $x < count($yhdistetytnumeroin); $x++){
//            echo $yhdistetytnumeroin[$x] . '<br>';
//        }
//        
//        
//        
//        
//        echo 'LOPPU';
//        
        ?>




    </body>
</html>
