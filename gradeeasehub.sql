-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 19, 2024 at 10:47 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradeeasehub`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade_value` decimal(5,2) NOT NULL,
  `date_of_issuance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `student_id`, `subject_id`, `grade_value`, `date_of_issuance`) VALUES
(5, 1, 1, 3.00, '2024-06-18'),
(6, 1, 2, 2.00, '2024-06-18'),
(7, 1, 1, 4.00, '2024-06-18'),
(9, 1, 2, 4.00, '2024-06-18'),
(10, 4, 1, 2.00, '2024-06-18'),
(11, 4, 1, 1.00, '2024-06-18'),
(12, 4, 1, 4.00, '2024-06-18'),
(13, 4, 1, 5.00, '2024-06-18'),
(14, 4, 2, 4.00, '2024-06-18'),
(15, 4, 2, 2.00, '2024-06-18'),
(16, 4, 3, 5.00, '2024-06-18'),
(17, 4, 4, 6.00, '2024-06-18'),
(18, 4, 4, 6.00, '2024-06-18'),
(19, 4, 5, 5.00, '2024-06-18'),
(20, 4, 3, 3.00, '2024-06-18'),
(21, 4, 6, 6.00, '2024-06-18'),
(22, 4, 8, 4.00, '2024-06-18'),
(23, 4, 7, 3.00, '2024-06-18'),
(24, 4, 8, 4.00, '2024-06-18'),
(25, 4, 5, 5.00, '2024-06-18'),
(27, 1, 5, 3.00, '2024-06-18'),
(28, 26, 1, 3.00, '2024-06-18'),
(29, 26, 1, 4.00, '2024-06-18'),
(30, 26, 1, 5.00, '2024-06-18'),
(31, 26, 2, 3.00, '2024-06-18'),
(32, 26, 3, 6.00, '2024-06-18'),
(33, 26, 4, 3.00, '2024-06-18'),
(34, 26, 5, 2.00, '2024-06-18'),
(35, 26, 4, 3.00, '2024-06-18'),
(36, 26, 7, 4.00, '2024-06-18'),
(37, 1, 3, 3.00, '2024-06-18'),
(38, 1, 3, 6.00, '2024-06-18'),
(39, 1, 3, 6.00, '2024-06-18'),
(40, 1, 4, 4.00, '2024-06-18'),
(41, 1, 4, 5.00, '2024-06-18'),
(42, 1, 5, 6.00, '2024-06-18'),
(43, 1, 1, 5.00, '2024-06-18'),
(44, 1, 1, 3.00, '2024-06-18'),
(45, 1, 6, 6.00, '2024-06-18'),
(46, 1, 7, 2.00, '2024-06-18'),
(47, 1, 8, 5.00, '2024-06-18'),
(48, 1, 9, 3.00, '2024-06-18'),
(49, 1, 6, 3.00, '2024-06-18'),
(50, 1, 6, 5.00, '2024-06-18'),
(51, 1, 7, 3.00, '2024-06-18'),
(52, 1, 9, 4.00, '2024-06-18'),
(53, 27, 1, 1.00, '2024-06-18'),
(54, 27, 1, 2.00, '2024-06-18'),
(55, 27, 1, 3.00, '2024-06-18'),
(56, 27, 1, 4.00, '2024-06-18'),
(57, 27, 1, 5.00, '2024-06-18'),
(58, 27, 2, 6.00, '2024-06-18'),
(59, 27, 2, 5.00, '2024-06-18'),
(60, 27, 2, 4.00, '2024-06-18'),
(61, 27, 2, 3.00, '2024-06-18'),
(62, 27, 2, 2.00, '2024-06-18'),
(63, 27, 2, 1.00, '2024-06-18'),
(64, 27, 3, 5.00, '2024-06-18'),
(65, 27, 3, 4.00, '2024-06-18'),
(66, 27, 4, 3.00, '2024-06-18'),
(67, 27, 4, 6.00, '2024-06-18'),
(69, 27, 5, 5.00, '2024-06-18'),
(70, 27, 6, 4.00, '2024-06-18'),
(71, 27, 5, 1.00, '2024-06-18'),
(72, 27, 5, 3.00, '2024-06-18'),
(73, 27, 6, 3.00, '2024-06-18'),
(74, 27, 8, 4.00, '2024-06-18'),
(75, 27, 7, 4.00, '2024-06-18'),
(76, 27, 7, 6.00, '2024-06-18'),
(77, 27, 7, 6.00, '2024-06-18'),
(78, 27, 8, 4.00, '2024-06-18'),
(79, 27, 9, 5.00, '2024-06-18'),
(80, 27, 1, 6.00, '2024-06-19');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `class`) VALUES
(1, 4, '3'),
(4, 8, '6'),
(5, 33, '6'),
(6, 34, '2'),
(7, 35, '3'),
(10, 38, '4'),
(13, 41, '2'),
(15, 43, '2'),
(17, 45, '8'),
(18, 46, '8'),
(19, 47, '4'),
(21, 49, '3'),
(22, 50, '5'),
(23, 51, '2'),
(24, 52, '4'),
(26, 53, '5'),
(27, 54, '7'),
(28, 55, '5');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Mathematics'),
(2, 'Science'),
(3, 'English Language'),
(4, 'History'),
(5, 'Geography'),
(6, 'Art'),
(7, 'Physical Education'),
(8, 'Music'),
(9, 'Computer Science');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `role_as`, `date_of_birth`, `created_at`) VALUES
(4, 'beres', 'Kacper2002', 'Bartosz ', 'Bereszyński', 0, NULL, '2024-06-17 11:02:06'),
(8, 'st5', '12345', 'Kuba', 'Zguba', 0, NULL, '2024-06-18 09:57:18'),
(9, 'st6', '$2y$10$5827vU1ZhoLMhbn0a3KyCeE5dwWr6kjnTtNl1W7hdj6MkFNMKNVSK', 'max', 'wolk', 1, NULL, '2024-06-18 13:21:59'),
(33, 'student3', '12345', 'Michael', 'Johnson', 0, NULL, '2024-06-17 07:57:27'),
(34, 'student20', '12345', 'Chloe', 'Torres', 0, NULL, '2024-06-17 07:57:27'),
(35, 'student14', '12345', 'Ava', 'Lopez', 0, NULL, '2024-06-17 07:57:27'),
(38, 'student4', '12345', 'Emily', 'Brown', 0, NULL, '2024-06-17 07:57:27'),
(41, 'student8', '12345', 'Emma', 'Davis', 0, NULL, '2024-06-17 07:57:27'),
(43, 'student6', '12345', 'Olivia', 'Williams', 0, NULL, '2024-06-17 07:57:27'),
(45, 'student1', '12345', 'John', 'Doe', 0, NULL, '2024-06-17 07:57:27'),
(46, 'student18', '12345', 'Madison', 'Sanchez', 0, NULL, '2024-06-17 07:57:27'),
(47, 'student13', '12345', 'Matthew', 'Garcia', 0, NULL, '2024-06-17 07:57:27'),
(49, 'student17', '12345', 'David', 'Perez', 0, NULL, '2024-06-17 07:57:27'),
(50, 'student12', '12345', 'Isabella', 'Martinez', 0, NULL, '2024-06-17 07:57:27'),
(51, 'student15', '12345', 'Ethan', 'Hernandez', 0, NULL, '2024-06-17 07:57:27'),
(52, 'majkel', '12345', 'Majk', 'Majkut', 0, NULL, '2024-06-18 14:13:29'),
(53, 'st55', '$2y$10$mJwI5jYftQsBr7/b4YY2zeMnIBfIjS33iq8YId/WcsnyXkQmf7g0K', 'Bartosz', 'Zmarzlik', 1, NULL, '2024-06-18 21:25:33'),
(54, 'lewy', '$2y$10$su7ZmkaYCIhRhx7vlW/w0O3eI4goMOsgImwdMhIWp2vVYDDVtCscy', 'Robert', 'Lewandowski', 0, NULL, '2024-06-18 21:48:25'),
(55, 'st66', '$2y$10$/8aRv.6n1SGDD6cZ74C/2Olo0pJC..KsJHv2RKwWJA/kLKx/Xjpmm', 'Adam', 'Malysz', 0, NULL, '2024-06-19 08:45:17');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indeksy dla tabeli `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
