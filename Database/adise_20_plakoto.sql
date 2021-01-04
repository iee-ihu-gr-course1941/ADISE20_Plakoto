-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 04 Ιαν 2021 στις 20:34:06
-- Έκδοση διακομιστή: 10.4.16-MariaDB
-- Έκδοση PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `adise20_plakoto`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `main_board`
--

CREATE TABLE `main_board` (
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `b_color` enum('B','W') COLLATE utf8_bin NOT NULL,
  `piece_color` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `wdice` int(11) DEFAULT NULL,
  `bdice` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `players`
--

CREATE TABLE `players` (
  `name` int(11) NOT NULL,
  `piece_color` int(11) NOT NULL,
  `email` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `uname` varchar(20) COLLATE utf8_bin NOT NULL,
  `pwd` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(20) COLLATE utf8_bin NOT NULL,
  `fname` varchar(20) COLLATE utf8_bin NOT NULL,
  `lname` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `main_board`
--
ALTER TABLE `main_board`
  ADD PRIMARY KEY (`b_color`),
  ADD KEY `board_p_color` (`piece_color`);

--
-- Ευρετήρια για πίνακα `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`name`),
  ADD KEY `players_p_color` (`piece_color`),
  ADD KEY `players_name` (`name`),
  ADD KEY `p_name` (`name`),
  ADD KEY `players_email` (`email`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uname`),
  ADD KEY `users_name` (`uname`),
  ADD KEY `users_email` (`email`);

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `main_board`
--
ALTER TABLE `main_board`
  ADD CONSTRAINT `board_p_color` FOREIGN KEY (`piece_color`) REFERENCES `players` (`piece_color`) ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `fk_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
