<?php
require_once '../tarkastus.php';
varmista_kirjautuminen();
?>

<?php if (isset($_POST['poista'])) { ?>
    <script>
        var r = confirm("Poistaminen poistaa myös harjoituskertaan liittyvät arviot. Haluatko jatkaa?");
        if(r){
            document.forms["harjoituskerta"].submit();
        } else {
            window.location.href = '../harjoituskerranpoistaminen.php'
        }
    </script>
<?php }
?>

<form action="poistaharjoituskerta.php" id="harjoituskerta" name="harjoituskerta" method="POST">
    <input type="hidden" name="harjpvm" id="harjpvm" value="<?php echo $_POST['harjpvm'] ?>">
    <input type="hidden" name="hetu" id="hetu" value="<?php echo $_POST['hetu'] ?>">

    <input type="hidden" name="lajitunnus" id="lajitunnus" 
           value="<?php echo $_POST['lajitunnus'] ?>">
</form>


<?php




echo $_POST['hetu'] . " " . $_POST['lajitunnus'] . " " . $_POST['harjpvm'] . " " . $_POST['harjoituskerta'];
?>
