-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 10:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `med`
--

-- --------------------------------------------------------

--
-- Table structure for table `fafa`
--

CREATE TABLE `fafa` (
  `id_fafa` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fafa`
--

INSERT INTO `fafa` (`id_fafa`, `link`, `text`) VALUES
(1, 'https://twitter.com', 'fab fa-twitter-f'),
(2, 'https://facebook.com', 'fab fa-facebook-f');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(10) NOT NULL,
  `ime_i_prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka_ponovo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pol` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idUloga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `ime_i_prezime`, `email`, `lozinka`, `lozinka_ponovo`, `pol`, `idUloga`) VALUES
(2, 'Marija Basic', 'marija@gmail.com', 'marija123', 'marija123', 'zenski', 3),
(4, 'Dejan Petrovit', 'dejan@gmail.com', 'dejan123', 'dejan123', 'Muski', 4),
(8, 'Petar Petrovic', 'peki@gmail.com', 'peki123', 'peki123', 'Muski', 4);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `idKorpa` int(200) NOT NULL,
  `idProizvod` int(50) NOT NULL,
  `idKorisnik` int(10) NOT NULL,
  `kolicina` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(25) NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `link`, `text`, `status`) VALUES
(1, 'index.php', 'Pocetna', 0),
(2, 'kontakt.php', 'Kontakt', 0),
(3, 'autor.php', 'Autor', 0),
(4, 'login.php', 'Logovanje', 2),
(5, 'registracija.php', 'Registracija', 2),
(6, 'admin.php', 'Admin', 3),
(7, 'odjava.php', 'Odjava', 3),
(8, 'korpaprikaz.php', 'Korpa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idProizvod` int(50) NOT NULL,
  `proizvodjac` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `idVrsta` int(50) NOT NULL,
  `idSlika` int(10) NOT NULL,
  `datumPostavljanja` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvod`, `proizvodjac`, `opis`, `cena`, `idVrsta`, `idSlika`, `datumPostavljanja`) VALUES
(2, 'Lipov', 'Lipov med, Lipa, Zajecar, 900g', '600', 8, 2, '2020-04-01 14:34:19'),
(4, 'Mesani', 'Mesani med, Lipa i bagrem, Zajecar, 1200g', '590', 8, 4, '2020-04-01 14:35:03'),
(5, 'Bagremov', 'Bagremov med, Bagrem, Zajecar, 850g', '1030', 8, 5, '2020-04-01 14:35:27'),
(6, 'Livadski', 'Livadski med, Cvetovi sa livade, Zajecar, 950g', '880', 11, 6, '2020-04-01 14:35:57'),
(7, 'Mesani', 'Mesani med, Razno cvece, Zajecar, 1000g', '840', 9, 7, '2020-04-01 14:36:22'),
(8, 'Suncokretov', 'Suncokretov med, Suncokret, Zajecar, 1000g', '850', 8, 8, '2020-04-01 11:29:07'),
(9, 'Sumski', 'Sumski med, Bor, Zajecar, 950g', '892', 9, 9, '2020-04-01 14:36:51'),
(10, 'Planinski', 'Planinski med, Planinsko bilje, Zajecar, 800g', '750', 8, 10, '2020-04-01 14:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE `slike` (
  `idSlika` int(10) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlika`, `name`, `path`) VALUES
(2, 'lipov', 'slike/lipov5.jpg'),
(3, 'mesani6.jpg', 'slike/mesani6.jpg'),
(4, 'C:xampp	mpphp2026.tmp', 'slike/mesani6.jpg'),
(5, 'bagremov1.jpg', 'slike/bagremov1.jpg'),
(6, 'livadski5.jpg', 'slike/livadski5.jpg'),
(7, 'mesani5.jpg', 'slike/mesani5.jpg'),
(8, 'suncokretov.jpg', 'slike/suncokretov.jpg'),
(9, 'sumski.jpg', 'slike/sumski.jpg'),
(10, 'planinski.jpg', 'slike/planinski.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `idUloga` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`idUloga`, `naziv`) VALUES
(3, 'admin'),
(4, 'korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `vrsta`
--

CREATE TABLE `vrsta` (
  `idVrsta` int(50) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vrsta`
--

INSERT INTO `vrsta` (`idVrsta`, `naziv`) VALUES
(8, 'bagremov'),
(9, 'mesani'),
(10, 'lipov'),
(11, 'livadski');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fafa`
--
ALTER TABLE `fafa`
  ADD PRIMARY KEY (`id_fafa`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD KEY `idUloga` (`idUloga`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`idKorpa`),
  ADD KEY `idProizvod` (`idProizvod`),
  ADD KEY `idKorisnik` (`idKorisnik`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idVrsta` (`idVrsta`),
  ADD KEY `idSlika` (`idSlika`);

--
-- Indexes for table `slike`
--
ALTER TABLE `slike`
  ADD PRIMARY KEY (`idSlika`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`idUloga`);

--
-- Indexes for table `vrsta`
--
ALTER TABLE `vrsta`
  ADD PRIMARY KEY (`idVrsta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fafa`
--
ALTER TABLE `fafa`
  MODIFY `id_fafa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `idKorpa` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idProizvod` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slike`
--
ALTER TABLE `slike`
  MODIFY `idSlika` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `idUloga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vrsta`
--
ALTER TABLE `vrsta`
  MODIFY `idVrsta` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_2` FOREIGN KEY (`idUloga`) REFERENCES `uloga` (`idUloga`);

--
-- Constraints for table `korpa`
--
ALTER TABLE `korpa`
  ADD CONSTRAINT `korpa_ibfk_1` FOREIGN KEY (`idProizvod`) REFERENCES `proizvodi` (`idProizvod`),
  ADD CONSTRAINT `korpa_ibfk_2` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idKorisnik`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_2` FOREIGN KEY (`idVrsta`) REFERENCES `vrsta` (`idVrsta`),
  ADD CONSTRAINT `proizvodi_ibfk_3` FOREIGN KEY (`idSlika`) REFERENCES `slike` (`idSlika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
