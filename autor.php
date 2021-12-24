<?php
session_start();
include("konekcija.php"); ?>
<!DOCTYPE html>
<html>
<title>Autor</title>
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
        <div id="ausredina">
            <div id="naslov2">
                <h1>Autor</h1>
            </div>
            <div id="autor">
                <div id="autslika"><img src="slike/moja.jpg" alt="autor" />
                    <p>Zovem se Marija Basić. Student sam Visoke škole za informacione i komunikacione tehnologije u Beogradu. Završila sam gimnaziju u Zaječaru i ovo je moj prvi sajt u kome koristim PHP. Broj indexa 127/17.</p>
                </div>
                <div class="cleaner"></div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/main1.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>

</html>