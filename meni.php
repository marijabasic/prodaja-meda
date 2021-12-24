<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include("konekcija.php");
if (isset($_SESSION['korisnik'])) {
    if ($_SESSION['korisnik']->idUloga == 1) {
        $status = 0;
        $statuss = 3;
        $upit = $konekcija->prepare("SELECT* FROM meni where status=:statuss or
status=:statusss");
        $sve = $upit->bindParam(":statuss", $status);
        $sve = $upit->bindParam(":statusss", $statuss);
        $rezultat = $upit->execute();
        if ($rezultat) {
            $sve = $upit->fetchAll();
            $ispis = "<ul>";
            foreach ($sve as $ss) {
                $ispis .= "<li><a href=" . $ss->link . ">$ss->text</a></li>";
            }
            $ispis .= "</ul>";
            echo $ispis;
        }
    }
}
if (isset($_SESSION['korisnik'])) {
    if ($_SESSION['korisnik']->idUloga == 2) {
        $status1 = 0;
        $status2 = 1;
        $status3 = 3;
        $upit = $konekcija->prepare("SELECT* FROM meni where status=:status0 or
    status=:status1 or status=:status2");
        $sve = $upit->bindParam(":status0", $status1);
        $sve = $upit->bindParam(":status1", $status2);
        $sve = $upit->bindParam(":status2", $status3);
        $rezultat = $upit->execute();
        if ($rezultat) {
            $sve = $upit->fetchAll();
            $ispis = "<ul>";
            foreach ($sve as $ss) {
                $ispis .= "<li><a href=" . $ss->link . ">$ss->text</a></li>";
            }
            $ispis .= "</ul>";
            echo $ispis;
        }
    }
} else {
    $status = 0;
    $stat = 2;
    $upit = $konekcija->prepare("SELECT* FROM meni where status=:statuss or
    status=:broj");
    $sve = $upit->bindParam(":statuss", $status);
    $sve = $upit->bindParam(":broj", $stat);
    $rezultat = $upit->execute();
    if ($rezultat) {
        $sve = $upit->fetchAll();
        $ispis = "<ul>";
        foreach ($sve as $ss) {
            $ispis .= "<li><a href=" . $ss->link . ">$ss->text</a></li>";
        }
        $ispis .= "</ul>";
        echo $ispis;
    }
}
