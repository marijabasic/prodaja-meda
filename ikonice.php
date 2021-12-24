<?php include("konekcija.php"); ?>
<?php
$upit = $konekcija->prepare("SELECT * from fafa");
$rez = $upit->execute();
if ($rez) {
    $sve = $upit->fetchAll();
    $prom = "";
    foreach ($sve as $sv) {
        $prom .= "<a href='" . $sv->link . "'<i class='" . $sv->text . "'></i></a>";
    }
    echo $prom;
}
