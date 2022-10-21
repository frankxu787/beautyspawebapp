-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 01:37 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avocadotreespa`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `menu_id` int(5) NOT NULL,
  `client_id` int(5) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time_id` int(11) NOT NULL,
  `cancled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date_created`, `menu_id`, `client_id`, `employee_id`, `start_date`, `start_time_id`, `cancled`) VALUES
(1, '2022-10-12 19:11:53', 1, 2, 1, '2022-10-31', 7, 0),
(2, '2022-10-12 19:13:14', 3, 1, 3, '2022-10-27', 2, 0),
(3, '2022-10-12 19:14:55', 4, 4, 2, '2022-10-25', 5, 0),
(4, '2022-10-12 19:16:16', 6, 5, 3, '2022-10-29', 1, 1),
(5, '2022-10-18 20:11:15', 6, 7, 2, '2022-10-21', 9, 0),
(6, '2022-10-18 21:04:56', 6, 5, 2, '2022-10-22', 3, 0),
(7, '2022-10-18 21:43:30', 5, 3, 2, '2022-10-21', 14, 0),
(8, '2022-10-20 00:19:10', 4, 6, 1, '2022-10-23', 6, 0),
(9, '2022-10-20 01:04:08', 2, 4, 2, '2022-10-26', 1, 0),
(10, '2022-10-20 01:04:10', 2, 4, 2, '2022-10-26', 1, 0),
(11, '2022-10-20 01:06:49', 7, 4, 3, '2022-10-24', 7, 0),
(12, '2022-10-20 01:10:02', 2, 6, 1, '2022-10-24', 9, 0),
(13, '2022-10-20 04:22:17', 6, 4, 3, '2022-10-22', 3, 0),
(14, '2022-10-20 05:58:18', 6, 4, 1, '2022-10-24', 13, 0),
(15, '2022-10-21 01:27:56', 2, 3, 2, '2022-10-26', 6, 0),
(16, '2022-10-21 18:45:40', 2, 4, 2, '2022-10-27', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(5) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `fname`, `lname`, `phone`, `email`) VALUES
(1, 'Susan', 'Huang', '8584469557', 'shuang@gmail.com'),
(2, 'Lily', 'Lee', '6265884558', 'llee@gmail.com'),
(3, 'Linsey', 'Hanttom', '3236996552', 'lhanttom@gmail.com'),
(4, 'Sofia', 'McGee', '9096681218', 'smcgee@gmail.com'),
(5, 'Torries', 'Ellison', '7604888624', 'tellison@gmail.com'),
(6, 'Taylor', 'Borge', '3236689441', 'tborge@gmail.com'),
(7, 'Stephany', 'Heitinburg', '3235588777', 'sheitinburg@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fname`, `lname`, `phone`, `email`) VALUES
(1, 'Jennifer', 'Myer', '3238855462', 'jmyer@gmail.com'),
(2, 'Emily', 'Song', '6265885452', 'esong@gmail.com'),
(3, 'Abby', 'Shizumi', '5627785211', 'ashizumi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee_schedule`
--

CREATE TABLE `employee_schedule` (
  `id` int(5) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `day_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_schedule`
--

INSERT INTO `employee_schedule` (`id`, `employee_id`, `day_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 1, 5),
(6, 1, 6),
(7, 1, 0),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(15, 3, 1),
(16, 3, 3),
(17, 3, 4),
(18, 3, 6),
(19, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_id` int(11) NOT NULL,
  `image_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `price`, `duration`, `duration_id`, `image_address`) VALUES
(1, 'Aromatherapy Facial', 'This healing facial is the best for maintenance and healing. This balanced treatment cleanses, exfoliates, and moisturizes the skin- allowing for renewal and regeneration. Great for people who want to maintain skin quality and first-time facial experiences.', 70, 60, 2, 'image/menu/aromatherapy_facial.jpg'),
(2, 'Oxygen Treatment', 'This revolutionary oxygenating treatment is designed to clear skin congestion, control acne, and revitalize fatigued, stressed, and dull skin. This unique treatment normalizes, purifies, and hydrates in depth to give the skin its natural radiance and flow back. The skin becomes luminous, moisture- balanced and younger looking. \r\n', 125, 90, 3, 'image/menu/oxygen_facial.jpg'),
(3, 'Chemical Peel', 'A skin-renewing treatment and surface moisturizer with a high-performance patented Amphoteric Hydroxy Complex offering the full benefits of AHA without the sting.\r\nImproves the youthful appearance of the skin, and brightens and evens out skin tone. The skin is left revitalized, hydrated, and soft.', 60, 30, 1, 'image/menu/chemical_peel.jpg'),
(4, 'Acne Treatment', 'This treatment targets acne by cleansing the pores and activates healthy skin regrowth. Also great for acne-prone skin by specifically resolving the factors that cause acne. Couple with products for the best results', 80, 60, 2, 'image/menu/acne_treatment.jpg'),
(5, 'Back Facial', 'Complete care to cleanse, exfoliate, tone, and treat your back to prevent spots, acne, and aging. Utilizing the best of scrubs and exfoliation, this facial softens and smooths the texture of your back leaving it new and supple.', 75, 60, 2, 'image/menu/back_facial.jpg'),
(6, 'Collagen Treatment', 'This exclusive, highly renowned, intensely rejuvenating treatment dramatically minimizes deeper lines and wrinkles and rejuvenates and tightens the skin resulting in the resurgence of a more youthful appearance. It quenches the skin, leaving it optimally hydrated and radiant for immediate and long-lasting results.', 140, 90, 3, 'image/menu/collagen_treatment.jpg'),
(7, 'Microdermabrasion', 'Utilizing small powdered crystals, this treatment provides a deep exfoliation treatment that works best on improving a variety of skin ailments such as sun damage, fine lines, age spots, enlarged pores, acne, and light scars. This non-invasive and painless procedure is best combined with the Aromatherapy Facial, Anti Aging Collagen Treatment, or Sea C. Spa Facial for best results.', 70, 30, 1, 'image/menu/microdermabrasion.jpg'),
(8, 'HydroLifting Treatment', 'This unique clinical treatment is specifically formulated to act on the face and neck. It provides intensive immediate hydration, and lifts and firms the face and neck for more radiant skin. This anti-aging clinical treatment offers an effective solution to revitalize and restructure the skin while improving the skin\'s elasticity and the appearance of fine lines and wrinkles.', 140, 60, 2, 'image/menu/hydroLifting_treatment.jpg'),
(9, 'LED Light Therapy Facial', 'This treatment is a non-invasive treatment that harnesses the power of LED light frequency to trigger your body’s natural cell processes to accelerate rejuvenation and repair the skin. This LED light can cause various reactions in your skin, such as fighting acne-causing bacteria, collagen promotion, and wrinkle reduction.', 70, 60, 2, 'image/menu/led_light_therapy_facial.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `time_id_list`
--

CREATE TABLE `time_id_list` (
  `time_id` int(2) NOT NULL,
  `time_str` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_id_list`
--

INSERT INTO `time_id_list` (`time_id`, `time_str`) VALUES
(1, '10:00AM'),
(2, '10:30AM'),
(3, '11:00AM'),
(4, '11:30AM'),
(5, '12:00PM'),
(6, '12:30PM'),
(7, '1:00PM'),
(8, '1:30PM'),
(9, '2:00PM'),
(10, '2:30PM'),
(11, '3:00PM'),
(12, '3:30PM'),
(13, '4:00PM'),
(14, '4:30PM'),
(15, '5:00PM'),
(16, '5:30PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `cancled` (`cancled`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `employee_schedule`
--
ALTER TABLE `employee_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_id_list`
--
ALTER TABLE `time_id_list`
  ADD PRIMARY KEY (`time_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_schedule`
--
ALTER TABLE `employee_schedule`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `employee_schedule`
--
ALTER TABLE `employee_schedule`
  ADD CONSTRAINT `employee_schedule_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
