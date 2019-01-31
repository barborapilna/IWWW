-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 31. led 2019, 13:40
-- Verze serveru: 5.7.23
-- Verze PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `semestralka`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `clanek`
--

DROP TABLE IF EXISTS `clanek`;
CREATE TABLE IF NOT EXISTS `clanek` (
  `id_clanku` int(255) NOT NULL AUTO_INCREMENT,
  `nazev_clanku` varchar(300) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `text_clanku` varchar(20000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `datum_vlozeni` date NOT NULL,
  `fk_id_uctu` int(255) NOT NULL,
  `fk_id_kategorie` int(255) NOT NULL,
  `fk_id_obrazku` int(255) NOT NULL,
  PRIMARY KEY (`id_clanku`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `hodnoceni_clanku`
--

DROP TABLE IF EXISTS `hodnoceni_clanku`;
CREATE TABLE IF NOT EXISTS `hodnoceni_clanku` (
  `id_hodnoceni` int(255) NOT NULL AUTO_INCREMENT,
  `hodnoceni` int(16) NOT NULL,
  `fk_id_clanku` int(255) NOT NULL,
  PRIMARY KEY (`id_hodnoceni`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `kategorie`
--

DROP TABLE IF EXISTS `kategorie`;
CREATE TABLE IF NOT EXISTS `kategorie` (
  `id_kategorie` int(255) NOT NULL AUTO_INCREMENT,
  `nazev_kategorie` varchar(200) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_kategorie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `id_komentare` int(255) NOT NULL AUTO_INCREMENT,
  `text_komentare` varchar(5000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `fk_id_komentare` int(255) NOT NULL,
  `fk_id_clanku` int(255) NOT NULL,
  `fk_id_uctu` int(255) NOT NULL,
  PRIMARY KEY (`id_komentare`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `obrazek`
--

DROP TABLE IF EXISTS `obrazek`;
CREATE TABLE IF NOT EXISTS `obrazek` (
  `id_obrazku` int(255) NOT NULL AUTO_INCREMENT,
  `nazev_obrazku` varchar(50) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_obrazku`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `ucet_uzivatele`
--

DROP TABLE IF EXISTS `ucet_uzivatele`;
CREATE TABLE IF NOT EXISTS `ucet_uzivatele` (
  `id_uctu` int(255) NOT NULL AUTO_INCREMENT,
  `jmeno_uzivatele` varchar(50) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `prijmeni_uzivatele` varchar(50) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email_uzivatele` varchar(100) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `role_uzivatele` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id_uctu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
