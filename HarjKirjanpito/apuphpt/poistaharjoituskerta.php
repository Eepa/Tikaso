<!-- Koodi, joka suorittaa valitun harjoituksen poistamisen tietyltä käyttäjältä. 
Ennen varsinaista poistamista, käyttäjältä varmistetaan, että hän varmasti haluaa poistaa 
valitun harjoituskerran. Varmistus hoidetaan JavaScript-metodin avulla.
Poistamisen onnistumisesta ja epäonnistumisesta ilmoitetaan JavaScript-ilmoituksen avulla. -->

<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php if (isset($_POST['poista'])) { ?>

    <!--Tiedot poistettavasta harjoituskerrasta, mitkä lähetetään eteenpäin, jos käyttäjä hyväksyy poiston.-->

    <form action="poistaharjoituskerta.php" id="harjoituskerta" name="harjoituskerta" method="POST">
        <input type="hidden" name="harjpvm" id="harjpvm" value="<?php echo $_POST['harjpvm'] ?>">
        <input type="hidden" name="hetu" id="hetu" value="<?php echo $_POST['hetu'] ?>">

        <input type="hidden" name="lajitunnus" id="lajitunnus" 
               value="<?php echo $_POST['lajitunnus'] ?>">
        <input type="hidden" name="harjoituskerta" id="harjoituskerta"
               value="<?php echo $_POST['harjoituskerta'] ?>">
    </form>
    
    <!--Poiston vahvistuskysely, joka suoritetaan heti sivulle tultaessa.-->

    <script language="JavaScript">
                                                             
        function vahvistus(){
            var r = confirm("Poistaminen poistaa myös harjoituskertaan liittyvät arviot. Haluatko jatkaa?");
            if(r){
                document.forms['harjoituskerta'].submit();
            } else if(!r){
                                                          
                window.location.href = '../harjoituskerranpoistaminen.php';
                                             
            }
        }
        vahvistus();                 
    </script>

<?php }
?>

    <!--Varsinainen harjoituskerran poistava koodi.-->

<?php
if (!isset($_POST['poista'])) {

    $kyselynsuoritus = $kyselyita->poistaHarjoituskerta(
            $_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjoituskerta']);

    if ($kyselynsuoritus) {

        echo "<script language='JavaScript'>window.alert('Harjoituskerran poistaminen onnistui!'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>";
    } else {
        die("<script language='JavaScript'>window.alert('Harjoituskerran poistaminen epäonnistui.'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>");
    }
}
?>
