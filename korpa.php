<?php include("konekcija.php");
if (isset($_SESSION['korisnik'])) {
    if ($_SESSION['korisnik']->idUloga != 2) {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
$upit = $konekcija->prepare("SELECT* from proizvodi p inner join vrsta v on
p.idVrsta=v.idVrsta inner join slike s on s.idSlika=p.idSlika");
$rez = $upit->execute();
if ($rez) {
    $sve = $upit->fetchAll();
    echo json_encode($sve);
}
