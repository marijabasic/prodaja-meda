<?php
session_start();
include("head.php"); ?><?php
                        if (!isset($_SESSION['korisnik'])) {
                            header("Location: index.php");
                        } else { ?>
<title>Korpa</title>

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
    </div>
    </div>
    <div id="sadrzajj">
        <h1 id="knaslov">Korpa</h1>
        <div id="sadrzajjj"></div><?php
                                    if (isset($_POST['id'])) {
                                        $proiz = $_POST['id'];
                                        $kol = $_POST['kolicina'];
                                        $kor = $_SESSION['korisnik']->idKorisnik;
                                        $upit = $konekcija->prepare("INSERT INTO korpa
VALUES('','$proiz','$kor','$kol')");
                                        $rez = $upit->execute();
                                    }
                                }
                                    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="js/korpa.js" type="text/javascript">
    </script>
</body>

</html>