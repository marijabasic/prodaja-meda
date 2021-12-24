<?php
session_start();
include("konekcija.php");
if (isset($_SESSION['korisnik'])) {
    if ($_SESSION['korisnik']->idUloga != 1) {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>
<html>
<title>Admin</title>
<?php include("head.php"); ?>

<body>
    <div id="ss">
        <div id="gore">
            <div id="logo">
                <h1>Prodaja meda</h1>
            </div>
            <div id="nav">
                <?php include("meni.php"); ?>
                <button id="btnMeni">Meni</button>
            </div>
            <div></div>
        </div>
        <div id="celi">
            <div id="zakorisnika">
                <input type="button" id="kprikaz" value="Upravljanje nalozima" />
                <div id="ispiss">
                    <form name="lista" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <input type="submit" value="Prikazi" name="prikazi" id="posalji" />
                        <input type="submit" value="Dodaj korisnika" name="ubacik" id="ubacik" />
                    </form>
                </div>
                <?php //prikaz korisnika
                $upit = $konekcija->prepare("SELECT * FROM korisnik k inner join uloga u on k.idUloga=u.idUloga");
                $rez = $upit->execute();
                if ($rez) {
                    $da = $upit->fetchAll();
                    if (isset($_POST['prikazi'])) {
                ?>
                        <table border='1' id="korisnici">
                            <tr>
                                <th>Redni broj</th>
                                <th>ID Korisnika</th>
                                <th>Ime i prezime</th>
                                <th>Email</th>
                                <th>Lozinka</th>
                                <th>Pol</th>
                                <th>Uloga</th>
                                <th>Izbrisi</th>
                                <th>Azuriraj</th>
                            </tr>
                            <?php
                            $rednibroj = 1;
                            foreach ($da as $prom) { ?>
                                <tr>
                                    <td><?= $rednibroj ?></td>
                                    <td><?= $prom->idKorisnik ?></td>
                                    <td><?= $prom->ime_i_prezime ?></td>
                                    <td><?= $prom->email ?></td>
                                    <td><?= $prom->lozinka ?></td>
                                    <td><?= $prom->pol ?></td>
                                    <td><?= $prom->naziv ?></td>
                                    <td><a href="<?php echo $_SERVER["PHP_SELF"]; ?>" class="izbrisi" data-id="<?= $prom->idKorisnik ?>">Izbrisi</a></td>
                                    <td><a href="admin.php?idupdate=<?php echo
                                                                    $prom->idKorisnik ?>" class="azuriraj" data-id="<?= $prom->idKorisnik ?>">Azuriraj</a></td>
                                </tr><?php
                                        $rednibroj++;
                                    } ?>
                        </table>
                    <?php
                    }
                    //delete korisnika
                }
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $query = $konekcija->prepare("DELETE FROM korisnik WHERE idKorisnik=:id");
                    $query->bindParam(':id', $id);
                    try {
                        $query->execute();
                        header("Location:admin.php");
                    } catch (PDOException $e) {
                        $statusCode = 500;
                    }
                }
                //
                // insert korisnika
                if (isset($_POST['ubacik'])) {
                    ?>
                    <form name="lista" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="ubacivanje">
                        <input type="text" class="finsert" name="imei" placeholder="Ime i prezime" /><br />
                        <input type="text" class="finsert" name="postai" placeholder="Email" /><br />
                        <input type="text" class="finsert" name="lozinkai" placeholder="Lozinka" /><br />
                        <input type="text" class="finsert" name="lozinkapi" placeholder="Lozinka Ponovo" /><br />
                        <?php
                        $upit = "SELECT* from uloga";
                        $sve = $konekcija->query($upit);
                        if ($sve) {
                            $ul = $sve->fetchAll();
                            $ispisi = "<select name='uloge' id='lista'>";
                            $ispisi .= "<option value='0'>Izaberite</option>";
                            foreach ($ul as $is) {
                                $ispisi .= "<option value='$is->idUloga'>$is->naziv</option>";
                            }
                            $ispisi .= "<select>";
                            echo $ispisi;
                        } ?>
                        <div id="radiobi">
                            <p>Pol:</p>
                            Muski<input type="radio" name="radi" id="rad2" class="radioi" value="Muski" />&nbsp;
                            Zenski<input type="radio" name="radi" id="rad3" class="radioi" value="Zenski" />
                            <input type="button" value="Dodaj" name="insert" id="insert" />
                    </form>
                <?php } ?>
                <?php
                if (isset($_POST['imei'])) {
                    $ime = $_POST["imei"];
                    $email = $_POST['postai'];
                    $lozinka = $_POST['lozinkai'];
                    $lozinkaponovo = $_POST['lozinkapi'];
                    $pol = $_POST['radi'];
                    $uloga = $_POST['uloge'];
                    $reemail = "/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
                    $greske = [];
                    if ($email == "") {
                        $greske[] = "E-mail je obavezan!";
                    } else if (!preg_match($reemail, $email)) {
                        $greske[] = "Greska - E-mail!";
                    }
                    if ($lozinkaponovo != $lozinka) {
                        $greske[] = "Greska-Lozinke se ne poklapaju!";
                    }
                    if (empty($pol)) {
                        $greske[] = "Niste izabrali pol!";
                    }
                    if ($uloga == "0") {
                        $greske[] = "Izaberite ulogu!";
                    }
                    if (count($greske) != 0) {
                        $promgr = "<ul>";
                        foreach ($greske as $promg) {
                            $promgr .= "<li>" . $promg . "</li>";
                        }
                        $promgr .= "</ul>";
                        echo $promgr;
                    } else {
                        $upit = "INSERT INTO korisnik
(ime_i_prezime,email,lozinka,lozinka_ponovo,pol,idUloga)
VALUES(:ime,:email,:lozinka,:lozinkaponovo,:pol,:uloga)";
                        $sve = $konekcija->prepare($upit);
                        $sve->bindParam(":ime", $ime);
                        $sve->bindParam(":email", $email);
                        $sve->bindParam(":lozinka", $lozinka);
                        $sve->bindParam(":lozinkaponovo", $lozinkaponovo);
                        $sve->bindParam(":pol", $pol);
                        $sve->bindParam(":uloga", $uloga);
                        try {
                            $sve->execute();
                        } catch (PDOException $e) {
                            echo "Greske" . $e->getmessage();
                        }
                    }
                }
                //azuriranje korisnika
                if (isset($_GET['idupdate'])) {
                    $id = $_GET['idupdate'];
                    $rezultat = $konekcija->prepare("SELECT* from korisnik where idKorisnik=:id");
                    $rezultat->bindParam(":id", $id);
                    $sve = $rezultat->execute();
                    if ($sve) {
                        foreach ($rezultat as $rez) {
                ?>
                            <form name="listaupdate" action="<?php echo
                                                                $_SERVER["PHP_SELF"]; ?>" method="POST" id="updateli">
                                <input type="hidden" name="sakriveno" value="<?php echo $rez->idKorisnik; ?>" /><br />
                                <input type="text" class=" finsert" name="imei" value="<?php echo
                                                                                        $rez->ime_i_prezime; ?>" /><br />
                                <input type="text" class="finsert" name="postai" value="<?php echo
                                                                                        $rez->email; ?>" /><br />
                                <input type="text" class="finsert" name="lozinkai" value="<?php echo
                                                                                            $rez->lozinka; ?>" /><br />
                                <input type="text" class="finsert" name="lozinkapi" value="<?php echo
                                                                                            $rez->lozinka_ponovo; ?>" /><br />
                                <?php
                                $upit = "SELECT* from uloga";
                                $sve = $konekcija->query($upit);
                                if ($sve) {
                                    $ul = $sve->fetchAll();
                                    $ispisi = "<select name='uloge' id='lista'>";
                                    foreach ($ul as $is) {
                                        $ispisi .= "<option value='$is->idUloga'>$is->naziv</option>";
                                    }
                                    $ispisi .= "<select>";
                                    echo $ispisi;
                                } ?>
                                <div id="radiobi">
                                    <p>Pol:</p>
                                    <?php
                                    if ($rez->pol == "Muski") { ?>
                                        Muski<input type="radio" name="radi" id="rad2" class="radioi" value="Muski" checked />&nbsp;
                                        Zenski<input type="radio" name="radi" id="rad3" class="radioi" value="Zenski" />
                                        <input type="submit" value="Promeni" name="izmena" />
                                    <?php } else {
                                    ?>
                                        Muski<input type="radio" name="radi" id="rad2" class="radioi" value="Muski" />&nbsp;
                                        Zenski<input type="radio" name="radi" id="rad3" class="radioi" value="Zenski" checked />
                                        <input type="submit" value="Promeni" name="izmena" />
                                        <?php ?>
                            </form>
            <?php
                                    }
                                }
                            }
                        }
            ?>
            <?php
            if (isset($_POST['izmena'])) {
                $id = $_POST['sakriveno'];
                $ime = $_POST['imei'];
                $email = $_POST['postai'];
                $loz = $_POST['lozinkai'];
                $lozponovo = $_POST['lozinkapi'];
                $uloga = $_POST['uloge'];
                $pol = isset($_POST['radi']) ? $_POST['radi'] : null;
                $greske = [];
                $upitizmena = $konekcija->prepare("UPDATE korisnik SET
ime_i_prezime=:ime,email=:email,lozinka=:loz,lozinka_ponovo=:lozponovo,pol=:pol
,iduloga=:uloga WHERE idKorisnik=:id");
                $upitizmena->bindParam(":id", $id);
                $upitizmena->bindParam(":ime", $ime);
                $upitizmena->bindParam(":email", $email);
                $upitizmena->bindParam(":loz", $loz);
                $upitizmena->bindParam(":lozponovo", $lozponovo);
                $upitizmena->bindParam(":pol", $pol);
                $upitizmena->bindParam(":uloga", $uloga);
                $rezultat = $upitizmena->execute();
                if ($rezultat) {
                    echo header('Location:admin.php');
                }
            }
            ?>
            </div>
            <form name="prikaz" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="prikaz proizvoda">
                <input type="submit" value="Upravljanje proizvodima" id="dugproizvodi" />
                <input type="submit" id="prikazipr" name="prikazipr" value="Prikazi" />
                <input type="submit" id="dodajpr" name="dodajpr" value="Dodaj" />
            </form>
            <?php ?>
            <?php if (isset($_POST['prikazipr'])) {
                $upit = $konekcija->prepare("SELECT* from proizvodi p inner join vrsta v on
p.idVrsta=v.idVrsta inner join slike s on s.idSlika=p.idSlika");
                $sve = $upit->execute();
                //var_dump($sve);


                if ($sve) {
                    $rez = $upit->fetchAll();
                    //var_dump($rez);
            ?><table border="1px" id="prikazproizvoda">
                        <tr>
                            <th>Naziv</th>
                            <th>Opis</th>
                            <th>Slika</th>
                            <th>Cena</th>
                            <th>Izbrisi proizvod</th>
                            <th>Azuriraj proizvod</th>
                        </tr>
                        <?php foreach ($rez as $rezul) { ?>
                            <td><?= $rezul->proizvodjac ?></td>
                            <td><?= $rezul->opis ?></td>
                            <td><img class="pozslika" src="<?= $rezul->path ?>" alt="<?= $rezul->name ?>" /></td>
                            <td><?= $rezul->cena ?></td>
                            <td><a href="admin.php?deleteproizvoda=<?php echo $rezul->idProizvod ?>" class="izbrisipr" data-idpro="<?= $rezul->idProizvod ?>">Izbrisi
                                    proizvod</a></td>
                            <td><a href="admin.php?azuriranjeproizvoda=<?php echo $rezul->idProizvod ?>" class="azuriraj" data-idpro="<?= $rezul->idProizvod ?>">Azuriraj
                                    proizvod</a></td>
                            <td>
                                </tr>
                    <?php
                        }
                    }
                }
                    ?>
                    <!-- delete -->
                    <?php
                    if (isset($_GET['deleteproizvoda'])) {
                        $id = $_GET['deleteproizvoda'];
                        $rezultat = $konekcija->prepare("DELETE from proizvodi where
idProizvod=:id");
                        $rezultat->bindParam(":id", $id);
                        $sve = $rezultat->execute();
                        echo "<script>alert('Izbrisali ste proizvod')</script>";
                    }
                    ?><?php
                        if (isset($_POST['dodajpr'])) { ?>
                    <form name="prikaz" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="popuniga" enctype="multipart/form-data"><br />
                        <?php $upit = $konekcija->prepare("SELECT* FROM vrsta");
                            $se = $upit->execute();
                            if ($se) {
                                $rezz = $upit->fetchAll(); ?>
                            <select name="vrsta"><br />
                                <?php foreach ($rezz as $da) { ?>
                                    <option value="<?= $da->idVrsta ?>"><?= $da->naziv ?> </option>
                            <?php }
                            } ?>
                            </select><br />
                            <input type="text" placeholder="proizvodjac" name="proizvodjac" /><br />
                            <textarea name="area" placeholder="Opis"></textarea><br />
                            <input name="userfile" type="file" /><br />
                            <input type="text" placeholder="Cena" name="cenaa" /><br />
                            <input type="submit" name="ubacip" value="Ubaci" /><br />
                    </form>
                    <?php
                            define("FILE_SIZE", 2000000);
                            $dozvoljeni = ['image/jpeg', 'image/png', 'image/gif'];
                        }
                        if (isset($_POST["ubacip"])) {
                            $fileName = $_FILES['userfile']['name'];
                            $tmpName = $_FILES['userfile']['tmp_name'];
                            $fileSize = $_FILES['userfile']['size'];
                            $fileType = $_FILES['userfile']['type'];
                            $fileError = $_FILES['userfile']['error'];
                            $uploadDir = 'slike/';
                            $filePath = $uploadDir . $fileName;
                            $tmpName = $_FILES['userfile']['tmp_name'];
                            $result = move_uploaded_file($tmpName, $filePath);
                            if (!$result) {
                                echo "Niste izabrali sliku!";
                                exit;
                            } else {
                                $query = "INSERT INTO slike (name, path )
VALUES ('$fileName', '$filePath')";
                                try {
                                    $sve = $konekcija->query($query);
                                    if ($sve) {
                                        $proizvodjac = $_POST['proizvodjac'];
                                        $opis = $_POST['area'];
                                        $cena = $_POST['cenaa'];
                                        $vrsta = $_POST['vrsta'];
                                        $slika = $konekcija->lastInsertId();
                                        $query2 = "INSERT INTO proizvodi (proizvodjac, opis, cena, idVrsta,idSlika )
VALUES('$proizvodjac','$opis','$cena','$vrsta','$slika')";
                                        try {
                                            $konekcija->query($query2);
                                            echo "<script>alert('Ubacili ste proizvod')</script>";
                                        } catch (PDOException $ex) {
                                            "Greska" . $ex->getMessage();
                                        }
                                    }
                                } catch (PDOException $ex) {
                                    "Greska" . $ex->getMessage();
                                }
                            }
                        }
                        // azuriranje proizvoda
                        if (isset($_GET['azuriranjeproizvoda'])) {
                            $id = $_GET['azuriranjeproizvoda'];
                            $rezultat = $konekcija->prepare("SELECT* from proizvodi p inner join slike s
on p.idSlika=s.idSlika where idProizvod=:id");
                            $rezultat->bindParam(":id", $id);
                            $sve = $rezultat->execute();
                            if ($sve) {
                                foreach ($rezultat as $rez) {
                    ?>
                            <form name="azurirnjep" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" id="azuriaj" enctype="multipart/form-data">
                                <input type="hidden" name="skriveno" value="<?php echo $rez->idProizvod; ?>" /><br />
                                <input type="text" class=" finsert" name="vrsta" value="<?php echo $rez->proizvodjac ?>" /><br />
                                <textarea name="area" value="<?php echo $rez->opis; ?>"><?php echo $rez->opis; ?></textarea><br />
                                <input name="userfile" type="file" value="<?php echo $rez->idSlika; ?>" /><img src="<?php echo $rez->path; ?>" class="slazuriranje" />
                                <br />
                                <input type="text" class="finsert" name="cenaa" value="<?php echo $rez->cena; ?>" /><br />
                                <?php
                                    $upit = "SELECT* from vrsta";
                                    $sve = $konekcija->query($upit);
                                    if ($sve) {
                                        $ul = $sve->fetchAll();
                                        $iss = "<select name='vrsta' id='vrsta'>";
                                        foreach ($ul as $is) {
                                            $iss .= "<option value='$is->idVrsta'>$is->naziv</option>";
                                        }
                                        $iss .= "<select>";
                                        echo $iss;
                                    }
                                ?>
                                <input name="azurirajpr" type="submit" value="Azuriraj" /><br />
                    <?php }
                            }
                        }
                        if (isset($_POST['azurirajpr'])) {
                            $id = $_POST['skriveno'];
                            $vrsta = $_POST['vrsta'];
                            $opis = $_POST['area'];
                            $slika = $_FILES['userfile'];
                            $cena = $_POST['cenaa'];
                            $greske = [];
                            if ($_FILES['userfile']['name'] == "") {
                                $upitazuriranje = $konekcija->prepare("UPDATE proizvodi SET
proizvodjac=:proizvodjac,opis=:opis,cena=:cena,idVrsta=:vrsta WHERE idProizvod=:id");
                                $upitazuriranje->bindParam(":id", $id);
                                $upitazuriranje->bindParam(":proizvodjac", $vrsta);
                                $upitazuriranje->bindParam(":opis", $opis);
                                $upitazuriranje->bindParam(":cena", $cena);
                                $rezultat = $upitazuriranje->execute();
                                if ($rezultat) {
                                    echo "<script>alert('Proizvod je izmenjen')</script>";
                                } else {
                                    echo "<script>alert('Greska')</script>";
                                }
                            } else {
                                $fileName = $_FILES['userfile']['name'];
                                $tmpName = $_FILES['userfile']['tmp_name'];
                                $fileSize = $_FILES['userfile']['size'];
                                $fileType = $_FILES['userfile']['type'];
                                $fileError = $_FILES['userfile']['error'];
                                $uploadDir = 'slike/';
                                $filePath = $uploadDir . $fileName;
                                $id = $_POST['skriveno'];
                                $query1 = "SELECT * FROM slike WHERE idSlika=(SELECT idSlika FROM
proizvodi WHERE idProizvod=$id)";
                                $stmt1 = $konekcija->prepare($query1);
                                $stmt1->execute();
                                $pictureObj = $stmt1->fetch();
                                $idPicture = $pictureObj->idSlika;
                                $oldPicPath = $pictureObj->name;
                                $oldThumbPath = $pictureObj->path;
                                unlink($oldThumbPath);
                                $tmpName = $_FILES['userfile']['tmp_name'];
                                $result = move_uploaded_file($tmpName, $filePath);
                                if (!$result) {
                                    echo "Niste izabrali sliku!";
                                    exit;
                                } else {
                                    $picQuery = "UPDATE slike SET name='$tmpName',
path='$filePath' WHERE idSlika= $idPicture";
                                    $picStmt = $konekcija->prepare($picQuery);
                                    $sve = $konekcija->query($picQuery);
                                    $rezultat = $picStmt->execute();
                                    if ($rezultat) {
                                        echo "<script>alert('Proizvod je izmenjen')</script>";
                                    } else {
                                        echo "<script>alert('Greska')</script>";
                                    }
                                }
                            }
                        }
                    ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/deletekorisnika.js"></script>
    <script type="text/javascript" src="js/insert.js"></script>
</body>

</html>
<?php
?>