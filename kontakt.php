<?php session_start();
include("konekcija.php");
?>
<!DOCTYPE html>
<html>
<title>Kontakt</title>
<?php include("head.php"); ?>

<body>
    <div id="ceo">
        <div id="gore">
            <div id="logo">
                <h1>Prodaja meda</h1>
            </div>
            <div id="nav">
                <?php include("meni.php") ?>
                <button id="btnMeni">Meni</button>
            </div>
        </div>
        <?php include("header.php"); ?>
        <div id="ksredina">
            <h1 id="knaslov">Kontakt</h1>
            <div id="kotntakti">
                <div id="formakontakt">
                    <form action="#" method="post">
                        <?php if (isset($_SESSION['korisnik'])) { ?>
                            <input type="text" id="emailkk" name="email" placeholder="Email" value="<?= $_SESSION['korisnik']->email; ?>" /><br /> <?php } else { ?><input type="text" id="emailkk" name="email" placeholder="Email" /><br />
                        <?php } ?>
                        <input type="text" id="naslov" name="naslov" placeholder="Naslov" /><br />
                        <textarea rows="10" cols="5" id="pitanja" name="pitanja" placeholder="Pitanje"></textarea><br />
                        <input type="button" id="sub" name="sub" value="Posaljite poruku" />
                    </form>

                    <?php include("kontaktobrada.php") ?>
                </div>
                <div id="greskee"></div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/kontaktvalidacija.js"></script>