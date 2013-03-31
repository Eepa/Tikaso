<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php if (isset($_POST['poista'])) { ?>
    <form action="poistaharjoituskerta.php" id="harjoituskerta" name="harjoituskerta" method="POST">
        <input type="hidden" name="harjpvm" id="harjpvm" value="<?php echo $_POST['harjpvm'] ?>">
        <input type="hidden" name="hetu" id="hetu" value="<?php echo $_POST['hetu'] ?>">

        <input type="hidden" name="lajitunnus" id="lajitunnus" 
               value="<?php echo $_POST['lajitunnus'] ?>">
        <input type="hidden" name="harjoituskerta" id="harjoituskerta"
               value="<?php echo $_POST['harjoituskerta']?>">
    </form>

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


<?php
if (!isset($_POST['poista'])) {
    echo $_POST['hetu'] . " " . $_POST['lajitunnus'] . " " . $_POST['harjpvm'] . " " . $_POST['harjoituskerta'];

    $kyselynsuoritus = $kyselyita->poistaHarjoituskerta(
            $_POST['hetu'], $_POST['lajitunnus'], $_POST['harjpvm'], $_POST['harjoituskerta']);

    if ($kyselynsuoritus) {

        echo "<script language='JavaScript'>window.alert('Poistaminen onnistui!'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>";
    } else {
        die("<script language='JavaScript'>window.alert('Poistaminen epäonnistui'); 
        window.location.href = '../harjoituskerranpoistaminen.php';</script> <br>");
    }
}
?>
