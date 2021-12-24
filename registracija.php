<?php include("konekcija.php");
ob_start();
?>
<!DOCTYPE html>
<html>
<title>Registracija</title>
<?php include("head.php"); ?>

<body>
    <div id="ceo">
        <div id="gore">
            <div id="logo">
                <h1>Prodaja meda</h1>
            </div>
            <div id="nav">
                <?php include("meni.php"); ?>
                <button id="btnMeni">Meni</button>
            </div>
        </div>
        <?php include("header.php"); ?>
        <h1 id="naslovprij">Registracija</h1>
        <div id="formar">

            <form name="forma" action="obrada.php" method="post">
                <input type="text" class="formareg" name="ime" placeholder="Ime i prezime" /><br />
                <input type="text" class="formareg" name="posta" placeholder="Email" /><br />
                <input type="password" class="formareg" name="lozinka" placeholder="Lozinka" /><br />
                <input type="password" class="formareg" name="lozinkap" placeholder="Ponovo lozinka" /><br />
                <div id="radiob">
                    <p>Pol:</p>
                    Muski<input type="radio" name="rad" id="rad2" class="radio" value="Muski" />&nbsp;
                    Zenski<input type="radio" name="rad" id="rad3" class="radio" value="Zenski" />
                </div>
                <input type="button" id="dugmeRegistracija" value="Pošaljite" name="dugme" />
                <div id="ispis">
                    <?php include("obrada.php");
                    ?>
                </div>
            </form>


        </div>
    </div>
    <div id="futer">
        <div id="ikonice">
            <?php include("ikonice.php"); ?>
        </div>
        <div id="dok">
            <a href="dokumentacija.pdf">
                <h2>Dokumentacija</h2>
            </a>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
    <script type="text/javascript" src="js/registracija.js"></script>
</body>

</html>