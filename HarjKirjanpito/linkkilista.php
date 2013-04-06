<?php require_once 'tarkastus.php'; ?>
<!DOCTYPE html>
<html>
    <style> 
/*        #navbar {
            position: absolute;
            top: 0;
            left: 0;
            margin: 0;
            padding:0;}*/
        #navbar li 
        {
            list-style: none;
            float: left; 
            position:relative;
            /*background-color:#999;*/
        }
        #navbar li a {
            display: block;
            padding: 3px 8px;
            text-transform: uppercase;
            text-decoration: none; 
            color: #000;
            font-weight: bold; }
        #navbar li a:hover {
            /*color: #999;*/
             background-color:#98bf21;
        }
        #navbar li ul {
            display: none;
            list-style-type:none;
        }
        #navbar li:hover ul, #navbar li.hover ul {
            position: absolute;
            display:list-item;
            left: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>


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
        <div><ul id="navbar">
                <li><a href="kirjaudu.php?ulos">Uloskirjautuminen</a></li>
                <li><a href="etusivu.php">Etusivu</a></li>
                <li><a href="#">Lajiprofiili</a>
                    <ul>
                        <li><a href="lajiprofiilinlisaaminen.php">Lisääminen</a></li>
                        <li><a href="lajiprofiilinpoistaminen.php">Poistaminen</a></li>
                        <li><a href="lajiprofiilinmuokkaaminen.php">Muokkaaminen</a></li>
                    </ul>
                </li>
                <li><a href="#">Harjoituskerta</a>
                    <ul>
                        <li><a href="harjoituskerranlisaaminen.php">Lisääminen</a></li>
                        <li><a href="harjoituskerranpoistaminen.php">Poistaminen</a></li>
                        <li><a href="harjoituskerranmuokkaaminen.php">Muokkaaminen</a></li>
                    </ul>
                </li>
                <li><a href="#">Arvio</a>
                    <ul>
                        <li><a href="arvionlisaaminen.php">Lisääminen</a></li>
                        <li><a href="arvionpoistaminen.php">Poistaminen</a></li>
                        <li><a href="arvionmuokkaus.php">Muokkaaminen</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <br>

                    <!--            <p>
                                    <a href="kirjaudu.php?ulos">Uloskirjautuminen</a>
                                    <a href="etusivu.php">Etusivu</a>
                                    <a href="lajiprofiilinlisaaminen.php">Lajiprofiilin lisääminen</a>
                                    <a href="lajiprofiilinpoistaminen.php">Lajiprofiilin poistaminen</a>
                                    <a href="lajiprofiilinmuokkaaminen.php">Lajiprofiilin muokkaaminen</a>
                                    <a href="harjoituskerranlisaaminen.php">Harjoituskerran lisääminen</a>
                                    <a href="harjoituskerranpoistaminen.php">Harjoituskerran poistaminen</a>
                                    <a href="harjoituskerranmuokkaaminen.php">Harjoituskerran muokkaaminen</a>
                                    <a href="arvionlisaaminen.php">Arvion lisääminen</a>
                                    <a href="arvionpoistaminen.php">Arvion poistaminen</a>
                                    <a href="arvionmuokkaus.php">Arvion muokkaaminen</a>
                                </p>-->
        <?php } ?>


    </body>
</html>
