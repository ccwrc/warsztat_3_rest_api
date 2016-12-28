-- phpMyAdmin SQL Dump
-- version 4.6.5.2deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2016 at 10:56 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `book_author` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `book_description` text COLLATE utf8_polish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `book_author`, `book_description`) VALUES
(3, 'Pierwsza książka - tytuł.1', 'Pierwsza książka - autor.1', 'Prawie zwykły opis: Firefox nie może odnaleźć serwera www.codecademy.com.Sprawdź, czy adres nie zawiera liter&oacute;wek jak np. ww.example.com zamiast www.example.com    Jeśli nie można otworzyć żadnej strony, sprawdź swoje połączenie sieciowe.    Jeśli ten komputer jest chroniony przez zaporę sieciową lub serwer proxy, sprawdź, czy program Firefox jest uprawniony do łączenia się z Internetem.'),
(4, 'były zwykły tytuł czwartej książki po edycji', 'były zwykły autor czwartej książki po edycji', 'były zwykły tytuł opis książki po edycji'),
(5, 'były tytuł piąty', 'były tytuł piąty', 'były tytuł piąty'),
(10, 'new endpoint test', 'new endpoint test', 'new endpoint test'),
(11, 'sahara', 'Clive Cussler', 'na morzu, w powietrzu i pod wodą'),
(12, 'grom', 'dean r koontz', 'przykladowy opis dla gromu'),
(13, 'lorem', 'ipsum', 'W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem. Ma ono korzenie w klasycznej łacińskiej literaturze z 45 roku przed Chrystusem, czyli ponad 2000 lat temu! Richard McClintock, wykładowca łaciny na uniwersytecie Hampden-Sydney w Virginii, przyjrzał się uważniej jednemu z najbardziej niejasnych słów w Lorem Ipsum – consectetur – i po wielu poszukiwaniach odnalazł niezaprzeczalne źródło: Lorem Ipsum pochodzi z fragmentów (1.10.32 i 1.10.33) „de Finibus Bonorum et Malorum”, czyli „O granicy dobra i zła”, napisanej właśnie w 45 p.n.e. przez Cycerona. Jest to bardzo popularna w czasach renesansu rozprawa na temat etyki. Pierwszy wiersz Lorem Ipsum, „Lorem ipsum dolor sit amet...” pochodzi właśnie z sekcji 1.10.32.  Standardowy blok Lorem Ipsum, używany od XV wieku, jest odtworzony niżej dla zainteresowanych. Fragmenty 1.10.32 i 1.10.33 z „de Finibus Bonorum et Malorum” Cycerona, są odtworzone w dokładnej, oryginalnej formie, wraz z angielskimi tłumaczeniami H. Rackhama z 1914 roku.'),
(14, 'arktyczna mgła', 'clive cussler', 'zwykly opis dla arktycznej mgly'),
(16, '&lt;script&gt;alert(&quot;ojojojojoj&quot;);&lt;/script&gt;', '&lt;script&gt;alert(&quot;ojojojojoj&quot;);&lt;/script&gt;', '&lt;script&gt;alert(&quot;ojojojojoj&quot;);&lt;/script&gt;'),
(17, 'Złe Miasto', 'wiesław Wernic', 'oraz krotki opis dla zlego miasta'),
(19, 'tytuł w cudzysłowiu', 'autor w cudzysłowiu', 'opis w cudzysłowiu'),
(20, 'Lawina', 'Desmond Bagley', 'snieg to nie wilk w owczej skorze, to tygrys w przebraniu jagniecia'),
(21, 'na oślep', 'bagley desmond', 'zatrzymanie akcji serca nastapilo na skutek dzialania obcego narzedzia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
