<?php
session_start();
include("konekcija.php"); ?>
<?php
if (isset($_POST['dugmeprijava'])) {
    $greske = [];
    $email = $_POST['email'];
    $sifra = $_POST['lozinka'];
    $resifra = "/[A-z]+[0-9]+/";
    $reemail = "/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
    if (!preg_match($reemail, $email)) {
        $greske[] = "Email nije u dorom formatu!";
    }
    if (!preg_match($resifra, $sifra)) {
        $greske[] = "Lozinka nije u dobrom formatu";
    }
    if (count($greske) != 0) {
        foreach ($greske as $gr) {
            echo "<p>" . $gr . "</p>";
        }
    } else {
        $upit = "SELECT * FROM korisnik WHERE email = :email AND lozinka =:sifra";
        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':sifra', $sifra);
        $rezultat = $priprema->execute();
        if ($rezultat) {
            if ($priprema->rowCount() == 1) {
                $korisnik = $priprema->fetch();
                $_SESSION['korisnik'] = $korisnik;
                header("Location: index.php");
            }
        }
        if ($priprema->rowCount() == 0) {
            echo "<script>alert('Prvo se morate registrovati')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<title>Prijava</title>
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
        <div id="formacela">
            <h1 id="naslovprij">Prijava</h1>
            <form action="login.php" method="post" onSubmit="return provera()">
                <input type="text" class="prvit pa" id="pprvi" placeholder="E-mail" name="email" />
                <p id="prijavap"></p>
                <input type="password" class="prvit pd" id="ddrugi" placeholder="Lozinka" name="lozinka" />
                <p id="prijavad"></p>
                <input type="submit" value="Prijava" id="dugprijava2" name="dugmeprijava" />
            </form>
        </div>
        <div id="futer">
            <div id="ikonice">
                <?php include("ikonice.php");
                ?>
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
            <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js" >
    </script>
    <script type="text/javascript" src="js/prijava.js"></script>
</body>

</html>