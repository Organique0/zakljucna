-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: localhost
-- Čas nastanka: 14. maj 2023 ob 17.32
-- Različica strežnika: 5.6.34
-- Različica PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `aplikacija`
--

-- --------------------------------------------------------

--
-- Struktura tabele `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `idUporabnika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `admin`
--

INSERT INTO `admin` (`idAdmin`, `idUporabnika`) VALUES
(11, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `naloga`
--

CREATE TABLE `naloga` (
  `idNaloge` int(11) NOT NULL,
  `labirint` varchar(150) DEFAULT NULL,
  `zacetnaOrientacija` int(11) DEFAULT NULL,
  `stopnja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `naloga`
--

INSERT INTO `naloga` (`idNaloge`, `labirint`, `zacetnaOrientacija`, `stopnja`) VALUES
(78, '0311111112000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000', 0, 1),
(79, '0000000000000000000000000000000000000000003111100000000010000000001000000000200000000000000000000000', 0, 2),
(80, '0000020000000001000000000100000011110000001000000000100000000010000000003000000000000000000000000000', 3, 3),
(81, '0000000000000311100000000010000000001000000000100000000020000000000000000000000000000000000000000000', 0, 4),
(82, '0000000000000000000000000000000000000000000021111300000000000000000000000000000000000000000000000000', 2, 5),
(83, '0000000000000020000000001000000000100000000011130000000000000000000000000000000000000000000000000000', 2, 6),
(97, '0000000000000000000000003000000000100000000010000000001000000000100000000010000000002000000000000000', 1, 7),
(98, '2111000000000100000000010000000001111000000000100000000010000000001111000000000100000000010000000003', 3, 8),
(100, '0000000000000001111000000100100000010010000003002000000000000000000000000000000000000000000000000000', 3, 9),
(101, '0000000000031110002000001000100000101110000011100000000000000000000000000000000000000000000000000000', 0, 10),
(102, '0000000000002111130000000000000000000000000000000000000000000000000000000000000000000000000000000000', 2, 11);

-- --------------------------------------------------------

--
-- Struktura tabele `sestavljalec`
--

CREATE TABLE `sestavljalec` (
  `idSestavljalec` int(11) NOT NULL,
  `idUporabnika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `sestavljalec`
--

INSERT INTO `sestavljalec` (`idSestavljalec`, `idUporabnika`) VALUES
(18, 1),
(19, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `uporabniki`
--

CREATE TABLE `uporabniki` (
  `uporabnisko_ime` varchar(45) DEFAULT NULL,
  `geslo` varchar(60) DEFAULT NULL,
  `idUporabnika` int(20) NOT NULL,
  `Eposta` varchar(59) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `uporabniki`
--

INSERT INTO `uporabniki` (`uporabnisko_ime`, `geslo`, `idUporabnika`, `Eposta`) VALUES
('luka', 'b9f4f93079f468458d50e0caa75d37f0bfec30dc9cb9b3525ef6c73e5aab', 1, 'luka@gmail.com'),
('ana', '3a3bff28238f46ac341725eb23f0e5fcac2ec9a3c7d22d925550bec26f4d', 2, 'ana@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik_resi_naloga`
--

CREATE TABLE `uporabnik_resi_naloga` (
  `uporabnik_resi_nalogaID` int(11) NOT NULL,
  `uporabnik_idUporabnika` int(11) DEFAULT NULL,
  `naloga_idNaloge` int(11) DEFAULT NULL,
  `datumResevanja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `uporabnik_resi_naloga`
--

INSERT INTO `uporabnik_resi_naloga` (`uporabnik_resi_nalogaID`, `uporabnik_idUporabnika`, `naloga_idNaloge`, `datumResevanja`) VALUES
(50, 1, 78, '2022-01-08'),
(51, 1, 98, '2022-01-16'),
(52, 1, 80, '2022-01-16'),
(53, 1, 78, '2022-05-09'),
(54, 1, 100, '2022-05-10'),
(55, 1, 79, '2022-05-10'),
(56, 1, 79, '2022-05-10'),
(57, 1, 79, '2022-05-10'),
(58, 1, 79, '2022-05-10'),
(59, 1, 79, '2022-05-10'),
(60, 1, 79, '2022-05-10'),
(61, 1, 100, '2022-05-10'),
(62, 1, 97, '2022-05-10'),
(63, 1, 100, '2022-05-10'),
(64, 1, 80, '2022-08-29'),
(65, 1, 80, '2022-08-29'),
(66, 1, 80, '2022-08-29'),
(67, 1, 80, '2022-08-29');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD KEY `idUporabnika` (`idUporabnika`);

--
-- Indeksi tabele `naloga`
--
ALTER TABLE `naloga`
  ADD PRIMARY KEY (`idNaloge`),
  ADD UNIQUE KEY `stopnja` (`stopnja`);

--
-- Indeksi tabele `sestavljalec`
--
ALTER TABLE `sestavljalec`
  ADD PRIMARY KEY (`idSestavljalec`),
  ADD KEY `idUporabnika` (`idUporabnika`);

--
-- Indeksi tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`idUporabnika`),
  ADD UNIQUE KEY `idUporabnika` (`idUporabnika`);

--
-- Indeksi tabele `uporabnik_resi_naloga`
--
ALTER TABLE `uporabnik_resi_naloga`
  ADD PRIMARY KEY (`uporabnik_resi_nalogaID`),
  ADD KEY `uporabnik_idUporabnika` (`uporabnik_idUporabnika`),
  ADD KEY `naloga_idNaloge` (`naloga_idNaloge`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT tabele `naloga`
--
ALTER TABLE `naloga`
  MODIFY `idNaloge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT tabele `sestavljalec`
--
ALTER TABLE `sestavljalec`
  MODIFY `idSestavljalec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT tabele `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `idUporabnika` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabele `uporabnik_resi_naloga`
--
ALTER TABLE `uporabnik_resi_naloga`
  MODIFY `uporabnik_resi_nalogaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idUporabnika`) REFERENCES `uporabniki` (`idUporabnika`);

--
-- Omejitve za tabelo `sestavljalec`
--
ALTER TABLE `sestavljalec`
  ADD CONSTRAINT `sestavljalec_ibfk_1` FOREIGN KEY (`idUporabnika`) REFERENCES `uporabniki` (`idUporabnika`);

--
-- Omejitve za tabelo `uporabnik_resi_naloga`
--
ALTER TABLE `uporabnik_resi_naloga`
  ADD CONSTRAINT `uporabnik_resi_naloga_ibfk_1` FOREIGN KEY (`uporabnik_idUporabnika`) REFERENCES `uporabniki` (`idUporabnika`),
  ADD CONSTRAINT `uporabnik_resi_naloga_ibfk_2` FOREIGN KEY (`naloga_idNaloge`) REFERENCES `naloga` (`idNaloge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
