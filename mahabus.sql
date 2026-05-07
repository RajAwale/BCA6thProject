-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 07:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahabus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `boid` int(11) NOT NULL,
  `bid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `bookingtime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`boid`, `bid`, `sid`, `uid`, `bookingtime`) VALUES
(40, 15, 257, 11, '2026-04-08 11:13:49'),
(41, 13, 231, 11, '2026-04-08 11:14:34'),
(42, 15, 258, 11, '2026-04-22 12:15:04'),
(43, 15, 255, 11, '2026-04-24 08:32:23'),
(44, 15, 253, 11, '2026-04-26 20:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bid` int(11) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `haswifi` tinyint(1) NOT NULL,
  `hasac` tinyint(1) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `pickuplocations` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bid`, `bname`, `price`, `haswifi`, `hasac`, `source`, `destination`, `pickuplocations`) VALUES
(13, 'Mahalaxmi Yatayat', 1350, 0, 1, 'Kathmandu', 'Janakpur', '27.674974764923384zzz85.29261320829393xxx27.660379608455816zzz85.33175200223924xxx27.668285560174937zzz85.40590971708299'),
(14, 'Helux Yatayat', 1700, 1, 1, 'Kathmandu', 'Surkhet', '27.70602336785347zzz85.28137207031251xxx27.669542192731722zzz85.30059814453126xxx27.732768480186238zzz85.3143310546875'),
(15, 'Night Yatayat', 1200, 1, 1, 'Kathmandu', 'Pokhara', '27.69280035030002zzz85.27999877929689xxx27.725019151095715zzz85.29888153076173'),
(16, 'Lalima Yatayat', 1500, 1, 1, 'Kathmandu', 'Jhapa', '27.665187863577245zzz85.42429357767107xxx27.691942983696zzz85.28147131204607xxx27.656977592689053zzz85.32404333353044'),
(17, 'Bhimsen Yatayat', 1500, 1, 1, 'Kathmandu', 'Dolakha', '27.74028639349318zzz85.33810950815679xxx27.70564045008344zzz85.35132743418218xxx27.668302188677387zzz85.42216122150423'),
(18, 'New Bus', 1800, 1, 1, 'Kathmandu', 'Ilam', '27.673990175794458zzz85.39322286844255xxx27.653008836469517zzz85.30361562967302xxx27.724754420104023zzz85.29091268777849'),
(19, 'Allrounder Yatayat', 1400, 1, 1, 'Kathmandu', 'Janakpur', '27.734439831874028zzz85.30574798583986xxx27.7359592202553zzz85.36445617675783xxx27.70252778337334zzz85.33321380615234'),
(20, 'Subh Yatayat', 1300, 0, 0, 'Kathmandu', 'Janakpur', '27.70678326270418zzz85.30300140380861xxx27.72441133727947zzz85.35140991210938xxx27.693104345706033zzz85.33973693847658'),
(21, 'Mangalam Yatayat', 1900, 0, 0, 'Kathmandu', 'Janakpur', '27.70898692784077zzz85.3223991394043xxx27.72175211198986zzz85.30506134033205xxx27.720840362673936zzz85.349178314209'),
(22, 'Mahanagar', 650, 0, 1, 'Kathmandu', 'Ilam', '27.679432027849778zzz85.34962724894287xxx27.69749110703112zzz85.29938310384752'),
(23, 'Yalayatayat', 1500, 0, 1, 'Kathmandu', 'Pokhara', '27.717807792886266zzz85.31203079066474xxx27.717123956878506zzz85.33048438868718xxx27.701014579789568zzz85.34078407130438xxx27.70261042611784zzz85.3022460921784xxx27.71750386630112zzz85.34687805018622xxx27.68344020162556zzz85.31869125392406');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `sid` int(11) NOT NULL,
  `bid` int(11) DEFAULT NULL,
  `seatno` varchar(10) DEFAULT NULL,
  `isbooked` tinyint(1) DEFAULT 0,
  `bookedbyuid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`sid`, `bid`, `seatno`, `isbooked`, `bookedbyuid`) VALUES
(211, 13, 'A1', 0, NULL),
(212, 13, 'A2', 0, NULL),
(213, 13, 'A3', 0, NULL),
(214, 13, 'A4', 0, NULL),
(215, 13, 'A5', 0, NULL),
(216, 13, 'A6', 0, NULL),
(217, 13, 'A7', 0, NULL),
(218, 13, 'A8', 0, NULL),
(219, 13, 'A9', 0, NULL),
(220, 13, 'A10', 1, 6),
(221, 13, 'A11', 1, 6),
(222, 13, 'B1', 0, NULL),
(223, 13, 'B2', 0, NULL),
(224, 13, 'B3', 0, NULL),
(225, 13, 'B4', 0, NULL),
(226, 13, 'B5', 0, NULL),
(227, 13, 'B6', 0, NULL),
(228, 13, 'B7', 1, 6),
(229, 13, 'B8', 0, NULL),
(230, 13, 'B9', 0, NULL),
(231, 13, 'B10', 1, 11),
(232, 14, 'A1', 0, NULL),
(233, 14, 'A2', 0, NULL),
(234, 14, 'A3', 0, NULL),
(235, 14, 'A4', 0, NULL),
(236, 14, 'A5', 0, NULL),
(237, 14, 'A6', 0, NULL),
(238, 14, 'A7', 0, NULL),
(239, 14, 'A8', 0, NULL),
(240, 14, 'A9', 0, NULL),
(241, 14, 'A10', 0, NULL),
(242, 14, 'A11', 0, NULL),
(243, 14, 'B1', 0, NULL),
(244, 14, 'B2', 0, NULL),
(245, 14, 'B3', 0, NULL),
(246, 14, 'B4', 0, NULL),
(247, 14, 'B5', 0, NULL),
(248, 14, 'B6', 0, NULL),
(249, 14, 'B7', 0, NULL),
(250, 14, 'B8', 0, NULL),
(251, 14, 'B9', 0, NULL),
(252, 14, 'B10', 0, NULL),
(253, 15, 'A1', 1, 11),
(254, 15, 'A2', 0, NULL),
(255, 15, 'A3', 1, 11),
(256, 15, 'A4', 0, NULL),
(257, 15, 'A5', 1, 11),
(258, 15, 'A6', 1, 11),
(259, 15, 'A7', 0, NULL),
(260, 15, 'A8', 0, NULL),
(261, 15, 'A9', 1, 6),
(262, 15, 'A10', 1, 6),
(263, 15, 'A11', 1, 9),
(264, 15, 'B1', 0, NULL),
(265, 15, 'B2', 0, NULL),
(266, 15, 'B3', 0, NULL),
(267, 15, 'B4', 0, NULL),
(268, 15, 'B5', 1, 6),
(269, 15, 'B6', 0, NULL),
(270, 15, 'B7', 0, NULL),
(271, 15, 'B8', 1, 6),
(272, 15, 'B9', 1, 11),
(273, 15, 'B10', 1, 10),
(274, 16, 'A1', 0, NULL),
(275, 16, 'A2', 0, NULL),
(276, 16, 'A3', 0, NULL),
(277, 16, 'A4', 0, NULL),
(278, 16, 'A5', 0, NULL),
(279, 16, 'A6', 0, NULL),
(280, 16, 'A7', 0, NULL),
(281, 16, 'A8', 0, NULL),
(282, 16, 'A9', 0, NULL),
(283, 16, 'A10', 0, NULL),
(284, 16, 'A11', 0, NULL),
(285, 16, 'B1', 0, NULL),
(286, 16, 'B2', 0, NULL),
(287, 16, 'B3', 0, NULL),
(288, 16, 'B4', 0, NULL),
(289, 16, 'B5', 0, NULL),
(290, 16, 'B6', 0, NULL),
(291, 16, 'B7', 0, NULL),
(292, 16, 'B8', 0, NULL),
(293, 16, 'B9', 0, NULL),
(294, 16, 'B10', 0, NULL),
(295, 17, 'A1', 0, NULL),
(296, 17, 'A2', 0, NULL),
(297, 17, 'A3', 0, NULL),
(298, 17, 'A4', 0, NULL),
(299, 17, 'A5', 0, NULL),
(300, 17, 'A6', 0, NULL),
(301, 17, 'A7', 0, NULL),
(302, 17, 'A8', 0, NULL),
(303, 17, 'A9', 0, NULL),
(304, 17, 'A10', 0, NULL),
(305, 17, 'A11', 0, NULL),
(306, 17, 'B1', 0, NULL),
(307, 17, 'B2', 0, NULL),
(308, 17, 'B3', 0, NULL),
(309, 17, 'B4', 0, NULL),
(310, 17, 'B5', 0, NULL),
(311, 17, 'B6', 0, NULL),
(312, 17, 'B7', 0, NULL),
(313, 17, 'B8', 0, NULL),
(314, 17, 'B9', 0, NULL),
(315, 17, 'B10', 0, NULL),
(316, 18, 'A1', 0, NULL),
(317, 18, 'A2', 0, NULL),
(318, 18, 'A3', 0, NULL),
(319, 18, 'A4', 0, NULL),
(320, 18, 'A5', 0, NULL),
(321, 18, 'A6', 0, NULL),
(322, 18, 'A7', 0, NULL),
(323, 18, 'A8', 0, NULL),
(324, 18, 'A9', 0, NULL),
(325, 18, 'A10', 0, NULL),
(326, 18, 'A11', 0, NULL),
(327, 18, 'B1', 0, NULL),
(328, 18, 'B2', 0, NULL),
(329, 18, 'B3', 0, NULL),
(330, 18, 'B4', 0, NULL),
(331, 18, 'B5', 0, NULL),
(332, 18, 'B6', 0, NULL),
(333, 18, 'B7', 1, 6),
(334, 18, 'B8', 0, NULL),
(335, 18, 'B9', 0, NULL),
(336, 18, 'B10', 0, NULL),
(337, 19, 'A1', 0, NULL),
(338, 19, 'A2', 0, NULL),
(339, 19, 'A3', 0, NULL),
(340, 19, 'A4', 0, NULL),
(341, 19, 'A5', 0, NULL),
(342, 19, 'A6', 0, NULL),
(343, 19, 'A7', 0, NULL),
(344, 19, 'A8', 0, NULL),
(345, 19, 'A9', 0, NULL),
(346, 19, 'A10', 0, NULL),
(347, 19, 'A11', 0, NULL),
(348, 19, 'B1', 0, NULL),
(349, 19, 'B2', 0, NULL),
(350, 19, 'B3', 0, NULL),
(351, 19, 'B4', 0, NULL),
(352, 19, 'B5', 0, NULL),
(353, 19, 'B6', 0, NULL),
(354, 19, 'B7', 0, NULL),
(355, 19, 'B8', 0, NULL),
(356, 19, 'B9', 0, NULL),
(357, 19, 'B10', 0, NULL),
(358, 20, 'A1', 0, NULL),
(359, 20, 'A2', 0, NULL),
(360, 20, 'A3', 0, NULL),
(361, 20, 'A4', 0, NULL),
(362, 20, 'A5', 0, NULL),
(363, 20, 'A6', 0, NULL),
(364, 20, 'A7', 0, NULL),
(365, 20, 'A8', 0, NULL),
(366, 20, 'A9', 0, NULL),
(367, 20, 'A10', 0, NULL),
(368, 20, 'A11', 0, NULL),
(369, 20, 'B1', 0, NULL),
(370, 20, 'B2', 0, NULL),
(371, 20, 'B3', 0, NULL),
(372, 20, 'B4', 0, NULL),
(373, 20, 'B5', 0, NULL),
(374, 20, 'B6', 0, NULL),
(375, 20, 'B7', 0, NULL),
(376, 20, 'B8', 0, NULL),
(377, 20, 'B9', 0, NULL),
(378, 20, 'B10', 0, NULL),
(379, 21, 'A1', 0, NULL),
(380, 21, 'A2', 0, NULL),
(381, 21, 'A3', 0, NULL),
(382, 21, 'A4', 0, NULL),
(383, 21, 'A5', 0, NULL),
(384, 21, 'A6', 0, NULL),
(385, 21, 'A7', 0, NULL),
(386, 21, 'A8', 0, NULL),
(387, 21, 'A9', 0, NULL),
(388, 21, 'A10', 0, NULL),
(389, 21, 'A11', 0, NULL),
(390, 21, 'B1', 0, NULL),
(391, 21, 'B2', 0, NULL),
(392, 21, 'B3', 0, NULL),
(393, 21, 'B4', 0, NULL),
(394, 21, 'B5', 0, NULL),
(395, 21, 'B6', 0, NULL),
(396, 21, 'B7', 0, NULL),
(397, 21, 'B8', 0, NULL),
(398, 21, 'B9', 0, NULL),
(399, 21, 'B10', 0, NULL),
(400, 22, 'A1', 0, NULL),
(401, 22, 'A2', 0, NULL),
(402, 22, 'A3', 0, NULL),
(403, 22, 'A4', 0, NULL),
(404, 22, 'A5', 0, NULL),
(405, 22, 'A6', 0, NULL),
(406, 22, 'A7', 0, NULL),
(407, 22, 'A8', 0, NULL),
(408, 22, 'A9', 0, NULL),
(409, 22, 'A10', 0, NULL),
(410, 22, 'A11', 0, NULL),
(411, 22, 'B1', 0, NULL),
(412, 22, 'B2', 0, NULL),
(413, 22, 'B3', 0, NULL),
(414, 22, 'B4', 0, NULL),
(415, 22, 'B5', 0, NULL),
(416, 22, 'B6', 0, NULL),
(417, 22, 'B7', 0, NULL),
(418, 22, 'B8', 0, NULL),
(419, 22, 'B9', 0, NULL),
(420, 22, 'B10', 0, NULL),
(421, 23, 'A1', 0, NULL),
(422, 23, 'A2', 0, NULL),
(423, 23, 'A3', 0, NULL),
(424, 23, 'A4', 0, NULL),
(425, 23, 'A5', 0, NULL),
(426, 23, 'A6', 0, NULL),
(427, 23, 'A7', 0, NULL),
(428, 23, 'A8', 0, NULL),
(429, 23, 'A9', 0, NULL),
(430, 23, 'A10', 0, NULL),
(431, 23, 'A11', 0, NULL),
(432, 23, 'B1', 0, NULL),
(433, 23, 'B2', 0, NULL),
(434, 23, 'B3', 0, NULL),
(435, 23, 'B4', 0, NULL),
(436, 23, 'B5', 0, NULL),
(437, 23, 'B6', 0, NULL),
(438, 23, 'B7', 0, NULL),
(439, 23, 'B8', 0, NULL),
(440, 23, 'B9', 0, NULL),
(441, 23, 'B10', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `ulocation` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `email`, `phone`, `pw`, `ulocation`) VALUES
(7, 'admin', 'admin@mahabus.com', '9745796123', '21232f297a57a5a743894a0e4a801fc3', NULL),
(11, 'Raj', 'raj@gmail.com', '9875641230', 'f1614e532ca522391d1de570af561c56', '27.67313040499778zzz85.31066875244173');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`boid`),
  ADD KEY `bid` (`bid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `boid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `buses` (`bid`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `seats` (`sid`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `buses` (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
