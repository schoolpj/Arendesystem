-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 maj 2025 kl 11:38
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `arendesystem`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `namn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `meddelande` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `priority` varchar(20) DEFAULT 'Mellan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `messages`
--

INSERT INTO `messages` (`id`, `namn`, `email`, `meddelande`, `datum`, `user_id`, `priority`) VALUES
(1, 'farhan', 'sdfghyui@gmail.com', 'datorn har fått ett hål', '2025-04-28 09:33:58', 0, 'Mellan'),
(2, 'Farhan ', 'knas@gmail.com', 'Min dator börjar prata ', '2025-04-28 09:37:51', 0, 'Mellan'),
(3, 'Farhan', 'srdtfyghujk@gmail.com', 'Min dator börjar prata', '2025-04-28 09:59:30', 0, 'Mellan'),
(4, 'farre', 'lol@gmail.com', 'jag vet inte vart min dator ligger', '2025-04-28 10:55:26', 0, 'Mellan'),
(5, 'wedfg', 'sdf@gmail.com', 'wedfgb', '2025-04-28 11:59:03', 0, 'Mellan'),
(6, 'farhan', 'fararara@gmail.com', 'hello', '2025-04-28 12:26:45', 0, 'Mellan'),
(10, '', '', 'hej', '2025-05-08 09:29:42', 5, 'Hög'),
(12, '', '', 'fhgjk', '2025-05-08 09:35:20', 5, 'Mellan');

-- --------------------------------------------------------

--
-- Tabellstruktur `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beskrivning` text NOT NULL,
  `status` enum('öppen','pågående','stängd') DEFAULT 'öppen',
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `prioritet` enum('låg','medel','hög') NOT NULL,
  `rapportor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tickets`
--

INSERT INTO `tickets` (`id`, `titel`, `beskrivning`, `status`, `datum`, `prioritet`, `rapportor`) VALUES
(1, 'Min dator är sjuk', 'den har problem', 'öppen', '2025-04-28 09:23:47', 'medel', 'wsdc'),
(2, 'Min dator är sjuk', 'den suger', 'öppen', '2025-04-28 09:28:26', 'hög', 'edfv'),
(3, 'Meddelande från kund', 'datorn har fått ett hål', 'öppen', '2025-04-28 09:36:45', 'medel', 'farhan'),
(6, 'dfgbnm,', 'dfgbnm,', 'öppen', '2025-04-28 10:00:34', 'medel', 'sdfghjm,.'),
(7, 'Meddelande från kund', 'hello', 'öppen', '2025-04-28 12:28:38', 'medel', 'farhan'),
(8, 'Meddelande från kund', 'wedfgb', 'öppen', '2025-04-28 12:28:39', 'medel', 'wedfg'),
(9, 'Meddelande från kund', 'jag vet inte vart min dator ligger', 'öppen', '2025-04-28 12:28:42', 'medel', 'farre');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `namn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `losenord` varchar(255) NOT NULL,
  `roll` enum('kund','admin') DEFAULT 'kund'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `namn`, `email`, `losenord`, `roll`) VALUES
(1, 'farre', 'lol@gmail.com', '$2y$10$aV9zlChbtTuI5grr9nlBpuzeUIldA5TmP9U77.T0I29Qd5EIS2Wku', 'kund'),
(3, 'Admin', 'admin@gmail.com', '$2y$10$xEc01RRNF0TvYhoUchTkFOEhe6mk.ZFIP0O6r/0VBofkrqLT8BHk2', 'admin'),
(4, 'Farhan', 'farhan@gmail.com', '$2y$10$V6EtVpa0S0iHpyDXb9XrwelIRGOS39UdBvwqyyu/7UsGQClWH3tt2', 'kund'),
(5, 'User1', 'user1@gmail.com', '$2y$10$QyF6N2LN.bFXHIiTOD5HR.toNu2bzgMhPX7yEd3jrgTlc33MMU6Z6', 'kund'),
(6, 'user2', 'user2@gmail.com', '$2y$10$vDumlYWPag.TEABDZbfj8e.KQLSJbintNakfaMSQexGaM53y8LlZy', 'kund'),
(7, 'user3', 'user3@gmail.com', '$2y$10$/7lhb0dy70iAY9RVHVjqHOzLX2k4qrOcAIxxquss2kIOQPk0RZsFi', 'kund');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
