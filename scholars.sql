SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `scholars` (
  `id` int(11) NOT NULL,
  `year_of_award` year(4) DEFAULT NULL,
  `scholarship_program` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `periodic_requirements_1st_sem` text DEFAULT NULL,
  `periodic_requirements_2nd_sem` text DEFAULT NULL,
  `summer` text DEFAULT NULL,
  `updated_cog` text DEFAULT NULL,
  `delayed_requirements` text DEFAULT NULL,
  `lacking_requirements` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `scholars` (`id`, `year_of_award`, `scholarship_program`, `name`, `school`, `course`, `contact_no`, `municipality`, `district`, `periodic_requirements_1st_sem`, `periodic_requirements_2nd_sem`, `summer`, `updated_cog`, `delayed_requirements`, `lacking_requirements`, `remarks`, `status`) VALUES
(1, '2019', 'RA 7687', 'Caberte, Artemio Jr. C.', 'ASU-Banga', 'Vet. Med.', '0907-978-5820', 'Bacolod City', '-', '11/07/2024-ERRP', '', '', '', '09/10/2024-ERRP;10/01/24-MDV', '2nd Sem SY 2023-2024', 'ok submitted - 11/07/2024-ERRP', ' ');


ALTER TABLE `scholars`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `scholars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
