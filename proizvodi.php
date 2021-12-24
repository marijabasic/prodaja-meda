<?php
include("konekcija.php");
?>
<?php
$upit = $konekcija->prepare("SELECT* from proizvodi p inner join vrsta v on
p.idVrsta=v.idVrsta inner join slike s on s.idSlika=p.idSlika ");
$rez = $upit->execute();
if ($rez) {
    $sve = $upit->fetchAll();
    echo json_encode($sve);
}
?>