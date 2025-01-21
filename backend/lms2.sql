-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 11:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `books` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `books`) VALUES
(1, 'Harper Lee', '1'),
(2, 'Albert Camus', '2,9'),
(3, 'Niccolò Machiavelli', '3'),
(4, 'George Orwell', '4,10'),
(5, 'Fyodor Dostoevsky', '5,6'),
(6, 'Franz Kafka', '7,8'),
(7, 'Aldous Huxley', '11'),
(8, 'F. Scott Fitzgerald', '12'),
(9, 'Herman Melville', '13'),
(10, 'Leo Tolstoy', '14,38'),
(11, 'Jane Austen', '15,16'),
(12, 'Victor Hugo', '17'),
(13, 'Homer', '18,19'),
(14, 'Miguel de Cervantes', '20'),
(15, 'James Joyce', '21'),
(16, 'Gabriel García Márquez', '22'),
(17, 'Gustave Flaubert', '23'),
(18, 'J.D. Salinger', '24'),
(19, 'Bram Stoker', '25'),
(20, 'Mary Shelley', '26'),
(21, 'Alexandre Dumas', '27'),
(22, 'Oscar Wilde', '28'),
(23, 'John Steinbeck', '29,30'),
(24, 'Emily Brontë', '31'),
(25, 'Charlotte Brontë', '32'),
(26, 'J.R.R. Tolkien', '33,34'),
(27, 'Charles Dickens', '35,36,37'),
(28, 'Vladimir Nabokov', '39'),
(29, 'Joseph Heller', '40'),
(30, 'Toni Morrison', '41'),
(31, 'William Faulkner', '42'),
(32, 'Kurt Vonnegut', '43'),
(33, 'Cormac McCarthy', '44'),
(34, 'Khaled Hosseini', '45'),
(35, 'Yann Martel', '46'),
(36, 'Anthony Burgess', '47'),
(37, 'Stephen King', '48'),
(38, 'Paulo Coelho', '49'),
(39, 'Sylvia Plath', '50');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `author` varchar(512) DEFAULT NULL,
  `publishedYear` int(11) DEFAULT NULL,
  `genre` varchar(512) DEFAULT NULL,
  `totalCopies` int(11) DEFAULT NULL,
  `availableCopies` int(11) DEFAULT NULL,
  `coverUrl` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publishedYear`, `genre`, `totalCopies`, `availableCopies`, `coverUrl`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1553383690i/2657.jpg'),
(2, 'The Stranger', 'Albert Camus', 1942, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1590930002i/49552.jpg'),
(3, 'The Prince', 'Niccolò Machiavelli', 1532, 'Political Philosophy', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1390055828i/28862.jpg'),
(4, 'Animal Farm', 'George Orwell', 1945, 'Satire', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1325861570i/170448.jpg'),
(5, 'Crime and Punishment', 'Fyodor Dostoevsky', 1866, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1382846449i/7144.jpg'),
(6, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 1880, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1427728126i/4934.jpg'),
(7, 'The Trial', 'Franz Kafka', 1925, 'Absurdist Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1320399438i/17690.jpg'),
(8, 'The Metamorphosis', 'Franz Kafka', 1915, 'Absurdist Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1646444605i/485894.jpg'),
(9, 'The Plague', 'Albert Camus', 1947, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1503362434i/11989.jpg'),
(10, '1984', 'George Orwell', 1949, 'Dystopian Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1657781256i/61439040.jpg'),
(11, 'Brave New World', 'Aldous Huxley', 1932, 'Dystopian Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1575509280i/5129.jpg'),
(12, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1650033243i/41733839.jpg'),
(13, 'Moby Dick', 'Herman Melville', 1851, 'Adventure Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1327940656i/153747.jpg'),
(14, 'War and Peace', 'Leo Tolstoy', 1869, 'Historical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1413215930i/656.jpg'),
(15, 'Pride and Prejudice', 'Jane Austen', 1813, 'Romantic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1320399351i/1885.jpg'),
(16, 'Sense and Sensibility', 'Jane Austen', 1811, 'Romantic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1397245675i/14935.jpg'),
(17, 'Les Misérables', 'Victor Hugo', 1862, 'Historical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1411852091i/24280.jpg'),
(18, 'The Odyssey', 'Homer', 1900, 'Epic Poetry', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1711957706i/1381.jpg'),
(19, 'The Iliad', 'Homer', -850, 'Epic Poetry', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1681797700i/77265004.jpg'),
(20, 'Don Quixote', 'Miguel de Cervantes', 1605, 'Adventure Fiction', 10, 10, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1551734146i/44244703.jpg'),
(21, 'Ulysses', 'James Joyce', 1922, 'Modernist Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1428891345i/338798.jpg'),
(22, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 1967, 'Magical Realism', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1327881361i/320.jpg'),
(23, 'Madame Bovary', 'Gustave Flaubert', 1857, 'Realist Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1606770119i/2175.jpg'),
(24, 'The Catcher in the Rye', 'J.D. Salinger', 1951, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1398034300i/5107.jpg'),
(25, 'Dracula', 'Bram Stoker', 1897, 'Gothic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1387151694i/17245.jpg'),
(26, 'Frankenstein', 'Mary Shelley', 1818, 'Gothic Fiction', 10, 10, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1347619131i/884723.jpg'),
(27, 'The Count of Monte Cristo', 'Alexandre Dumas', 1844, 'Adventure Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1724863997i/7126.jpg'),
(28, 'The Picture of Dorian Gray', 'Oscar Wilde', 1890, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1454087681i/489732.jpg'),
(29, 'The Grapes of Wrath', 'John Steinbeck', 1939, 'Historical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1375670575i/18114322.jpg'),
(30, 'Of Mice and Men', 'John Steinbeck', 1937, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1511302904i/890.jpg'),
(31, 'Wuthering Heights', 'Emily Brontë', 1847, 'Gothic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1388212715i/6185.jpg'),
(32, 'Jane Eyre', 'Charlotte Brontë', 1847, 'Romantic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1557343311i/10210.jpg'),
(33, 'The Hobbit', 'J.R.R. Tolkien', 1937, 'Fantasy', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1546071216i/5907.jpg'),
(34, 'The Lord of the Rings', 'J.R.R. Tolkien', 1954, 'Fantasy', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1546071216i/5907.jpg'),
(35, 'A Tale of Two Cities', 'Charles Dickens', 1859, 'Historical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1344922523i/1953.jpg'),
(36, 'Great Expectations', 'Charles Dickens', 1861, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1631687432i/2623.jpg'),
(37, 'David Copperfield', 'Charles Dickens', 1850, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1461452762i/58696.jpg'),
(38, 'Anna Karenina', 'Leo Tolstoy', 1877, 'Romantic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1546091617i/15823480.jpg'),
(39, 'Lolita', 'Vladimir Nabokov', 1955, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1590093359i/9216051.jpg'),
(40, 'Catch-22', 'Joseph Heller', 1961, 'Satire', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1463157317i/168668.jpg'),
(41, 'Beloved', 'Toni Morrison', 1987, 'Historical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1722944318i/6149.jpg'),
(42, 'The Sound and the Fury', 'William Faulkner', 1929, 'Modernist Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1433089995i/10975.jpg'),
(43, 'Slaughterhouse-Five', 'Kurt Vonnegut', 1969, 'Science Fiction', 10, 10, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1440319389i/4981.jpg'),
(44, 'The Road', 'Cormac McCarthy', 2006, 'Post-Apocalyptic Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1600241424i/6288.jpg'),
(45, 'The Kite Runner', 'Khaled Hosseini', 2003, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1579036753i/77203.jpg'),
(46, 'Life of Pi', 'Yann Martel', 2001, 'Adventure Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1631251689i/4214.jpg'),
(47, 'A Clockwork Orange', 'Anthony Burgess', 1962, 'Dystopian Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1549260060i/41817486.jpg'),
(48, 'The Shining', 'Stephen King', 1977, 'Horror Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1353277730i/11588.jpg'),
(49, 'The Alchemist', 'Paulo Coelho', 1988, 'Philosophical Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1654371463i/18144590.jpg'),
(50, 'The Bell Jar', 'Sylvia Plath', 1963, 'Fiction', 10, 10, 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1554582218i/6514.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `books` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `books`) VALUES
(1, 'Fiction', '1,12,24,30,36,37,39,45,50'),
(2, 'Philosophical Fiction', '2,5,6,9,28,49'),
(3, 'Political Philosophy', '3'),
(4, 'Satire', '4,40'),
(5, 'Dystopian Fiction', '10,11,47'),
(6, 'Adventure Fiction', '13,20,27,33,46'),
(7, 'Historical Fiction', '14,17,35,41,29'),
(8, 'Romantic Fiction', '15,16,38,32'),
(9, 'Absurdist Fiction', '7,8'),
(10, 'Epic Poetry', '18,19'),
(11, 'Modernist Fiction', '21,42'),
(12, 'Magical Realism', '22'),
(13, 'Realist Fiction', '23'),
(14, 'Gothic Fiction', '25,26,31'),
(15, 'Fantasy', '33,34'),
(16, 'Post-Apocalyptic Fiction', '44'),
(17, 'Science Fiction', '43'),
(18, 'Horror Fiction', '48');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowed_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'auth_token', '0d53740fae078f4a64cc4044c0008d766ee95ede3738f4fafb219e488d2207de', '[\"*\"]', '2025-01-19 17:54:53', NULL, '2025-01-18 20:11:26', '2025-01-19 17:54:53'),
(8, 'App\\Models\\User', 2, 'auth_token', 'd8e21b60662baeb76561ddba1ed0939ec36a4f0f6079f27a04990825b6c1c4b6', '[\"*\"]', '2025-01-19 14:48:57', NULL, '2025-01-19 14:47:40', '2025-01-19 14:48:57'),
(19, 'App\\Models\\User', 2, 'auth_token', '5e68b943022cc5fd525d72b1caa50cee2edea1df3c5738959a7d389f8d7f8d91', '[\"*\"]', '2025-01-19 21:38:44', NULL, '2025-01-19 20:09:38', '2025-01-19 21:38:44'),
(20, 'App\\Models\\User', 1, 'auth_token', '5a37b34384a5e40b15712d4f95cee7cf21df2fd43a2fe843c7006795828bab04', '[\"*\"]', '2025-01-20 21:09:33', NULL, '2025-01-19 20:43:56', '2025-01-20 21:09:33'),
(21, 'App\\Models\\User', 2, 'auth_token', 'bc00d82c176e40e17039f8561f3b64705a61c28756a03ec53fb54388cbd94879', '[\"*\"]', '2025-01-20 21:07:09', NULL, '2025-01-20 20:20:21', '2025-01-20 21:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bo4gknpT5ubE94VTZIa8lbLV8xLb7mRCIZaumGLZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjZUeHdBQjYzbFBlUExpMDFXSUFxMmlZbUdabUtTWjhCUVBia2M0TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZXN0LWxvZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737304672),
('Lv8UuKzqsVHJcPVNo5lKEUgprCRnqC58QlgpGoZe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmQ2OG5WaDdSeXFaWUpvZjZVdmdSeWhUT0psVE92czRhSDhySUViZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737236490);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Admin','Borrower') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`) VALUES
(1, 'Admin User', 'admin@example.com', 'Admin', NULL, '$2y$12$C9u4ZvWGtY8UBQW4NoXXf.Jj3okgaB6KrgdDAG1qEFhk.5WZoCbtC', NULL),
(2, 'Member User', 'member@example.com', 'Borrower', NULL, '$2y$12$F3ASILqakLGOoo49OUxQVOy1SSbn6E96yfWOkaU7AVSKc0T5cxfEW', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
