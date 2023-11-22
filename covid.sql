SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `infections`
--

CREATE TABLE `infections` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `infections`
--

INSERT INTO `infections` (`id`, `date`, `user_id`) VALUES
(1, '2021-03-10 10:15:00', 5),
(2, '2021-03-18 07:21:20', 4),
(3, '2021-03-18 07:21:20', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `surname`, `password`) VALUES
(3, 'nouman', 'nouman', '$2y$10$0dPCE5ecM/ac0djBzvc5Auz4SQYhEfYAeuxmmj3Mz/E4n4JMtxNCW'),
(4, 'yaseen', 'yaseen', '$2y$10$QFXzIJSlsnJdAwje2OFgXe1rQNk4C48mfo9n7QZlRpVCZOeQCWhYS'),
(5, 'kamran', 'kamran', '$2y$10$H3pHbYZE32tRAF9h4IAyCOajB1XuZ/fjxlxV4YNbKB.RtHqQVfJX2');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `duration` varchar(50) NOT NULL,
  `x_coordinate` int(11) NOT NULL,
  `y_coordinate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `user_id`, `date`, `duration`, `x_coordinate`, `y_coordinate`) VALUES
(1, 4, '2021-03-10 15:00:00', '5', 1346, 105),
(2, 4, '2021-03-03 14:30:00', '5', 1380, 104);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `infections`
--
ALTER TABLE `infections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infections`
--
ALTER TABLE `infections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


