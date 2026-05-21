-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for scholarship_db
CREATE DATABASE IF NOT EXISTS `scholarship_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `scholarship_db`;

-- Dumping structure for table scholarship_db.admin_tbl
CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.admin_tbl: ~1 rows (approximately)
INSERT INTO `admin_tbl` (`id`, `username`, `password`, `fullname`, `address`, `phone`, `email`) VALUES
	(1, 'admin', 'errpanagsagan', 'Eunice Panagsagan', 'Kalibo,Aklan', '09176247084', 'eunice.panagsagan@ro6.dost.gov.ph');

-- Dumping structure for table scholarship_db.monitor_scholars
CREATE TABLE IF NOT EXISTS `monitor_scholars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scholar_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.monitor_scholars: ~6 rows (approximately)
INSERT INTO `monitor_scholars` (`id`, `scholar_id`, `date`, `details`, `status`) VALUES
	(1, 2, '2026-04-20', 'Inquire RO status of scholars: \r\nNC, Forwarded to SEI', 'active'),
	(2, 4, '2026-04-21', 'Inquire RO status of scholar:\r\nNC, forwarded to SEI', 'active'),
	(3, 13, '2026-04-21', 'Inquiry RO for status of scholars:\r\nNC', 'active'),
	(4, 31, '2026-04-21', 'Inquire Ro for status of scholar:\r\nFor evaluation, 2FGs (for termination)', 'active'),
	(5, 74, '2026-04-21', 'Inquire RO for status of scholars:\r\nNC, forwarded to SEI', 'active'),
	(6, 5, '2026-04-21', 'Inquire RO to status scholar:\r\npending, with NGS', 'active');

-- Dumping structure for table scholarship_db.scholars
CREATE TABLE IF NOT EXISTS `scholars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(255) NOT NULL,
  `year_graduated` year(4) DEFAULT NULL,
  `periodic_requirements` text NOT NULL,
  `periodic_requirements_filename` text DEFAULT NULL,
  `periodic_requirements_upload_date` datetime DEFAULT NULL,
  `updated_cog_filename` varchar(255) DEFAULT NULL,
  `updated_cog_upload_date` datetime DEFAULT NULL,
  `record_status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.scholars: ~88 rows (approximately)
INSERT INTO `scholars` (`id`, `year_of_award`, `scholarship_program`, `name`, `school`, `course`, `contact_no`, `municipality`, `district`, `periodic_requirements_1st_sem`, `periodic_requirements_2nd_sem`, `summer`, `updated_cog`, `delayed_requirements`, `lacking_requirements`, `remarks`, `status`, `year_graduated`, `periodic_requirements`, `periodic_requirements_filename`, `periodic_requirements_upload_date`, `updated_cog_filename`, `updated_cog_upload_date`, `record_status`) VALUES
	(2, '2019', 'RA 7687', 'Nicodemus, Jacinth Andrea Y.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0946-216-9619', 'Numancia', '2nd', '-', '-', '-', '-', '-', '', 'For evaluation', 'Problematic', NULL, 'Nicodemus JAY.pdf|2025-05-23 08:23:56,Nicodemus JAY.pdf|2025-09-02 05:10:29', NULL, NULL, '', '2025-04-29 11:17:28', 'active'),
	(4, '2019', 'RA 7687', 'Panaligan, Ma. Jocelyn D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0905-602-1270', 'Bacolod City', '-', '', '-', '-', '-', '-', '', 'For evaluation', 'Problematic', NULL, 'Panaligan MJD.pdf|2025-05-23 08:24:57,Panaligan MJD_letter of appeal.pdf|2025-05-23 08:24:57,Panaligan MJD.pdf|2025-09-02 05:10:51', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(5, '2020', 'RA 7687', 'Magsisi, Cassandra Jade', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0976-287-0771', 'Kalibo', '1st', '-', '-', '-', '-', '', '', 'With NGS', 'Problematic', NULL, 'Magsisi CJ.pdf|2025-05-23 08:30:22,Magsisi CJ.pdf|2025-09-02 05:11:11,Magsisi CJ.pdf|2026-04-21 03:43:28', NULL, NULL, 'Magsisi CJ_updated COG.pdf|2025-07-31 08:43:06', '2025-07-31 08:43:06', 'active'),
	(6, '2021', 'RA 7687', 'Apolonio, Glea May M.', 'ASU-Kalibo', 'BS Civil Engineering', '0969-034-1883', 'Lezo', '2nd ', '08/05/2024-VMMP', '02/03/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Apolonio GMM.pdf|2025-05-23 08:37:37', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(7, '2021', 'MERIT', 'Ibit, Marafe Genaen B.', 'ASU-Banga', 'BS Biology', '0918-567-3248', 'New Washington', '1st', '7/29/2024-JVG', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Ibit MGB.pdf|2025-05-23 08:38:03,Ibit MGB.pdf|2025-09-02 05:11:52,Ibit MGB_summer.pdf|2025-09-02 05:11:52', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(8, '2021', 'RA 7687', 'Vicente, Cheska Mae A.', 'ASU-Banga', 'BS Biology', '0951-275-7152', 'Iloilo', '-', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Vicente CMA.pdf|2025-05-23 08:47:08,Vicente CMA.pdf|2025-09-02 05:12:19,Vicente CMA_summer.pdf|2025-09-02 05:12:19', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(9, '2022', 'RA 7687', 'Castor, Steffilane R.', 'ASU-Banga', 'BS Biology', '0912-941-3170', 'Banga', '1st', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Castor SR.pdf|2025-05-23 08:47:52,Castor SR.pdf|2025-09-02 05:12:42,Castor SR_summer.pdf|2025-09-02 05:12:42,Castor SR.pdf|2026-04-08 11:19:32', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(10, '2022', 'RA 7687', 'De Joseph, Mayvilyn C.', 'ASU-Banga', 'BS Biology', '0908-127-9001', 'Makato', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'De Joseph MC.pdf|2025-05-23 09:03:53,De Joseph MC.pdf|2025-09-02 05:13:28,De Joseph MC_summer.pdf|2025-09-02 05:13:28,De Joseph MC.pdf|2026-04-08 11:31:25', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(11, '2022', 'RA 7687', 'Igtanloc, Christy Michelle H.', 'ASU-Kalibo', 'BS Information Technology', '0912-752-8406', 'Numancia', '2nd', '08/29/2024-IAS', '01/28/2025-VMMP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Igtanloc CMH.pdf|2025-05-23 09:04:15,Igtanloc CMH.pdf|2025-09-02 05:13:09', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(12, '2022', 'RA 7687', 'Kaindoy, Lian Patrice D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0938-821-0782', 'Kalibo', '1st', '09/16/2024-AUD', '-', '-', '-', '', '-', 'Did not submit requirements last semester 2024-2025', 'Updated', NULL, 'Kaindoy LPD.pdf|2025-09-02 05:13:54', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(13, '2022', 'RA 7687', 'Quime, Harvey B.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-262-0315', 'Banga', '1st', '08/15/2024-AUD', '01/24/2025-ARS', '-', '-', '', '', 'Non-Compliance, waiting for Memo from SEI', 'Problematic', NULL, 'Quime HB.pdf|2025-05-23 09:14:12,Quime HB_proof.pdf|2025-05-23 09:14:12,Quime HB.pdf|2025-09-02 05:14:24,Quime HB_summer.pdf|2025-09-03 02:58:34', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(14, '2022', 'RA 7687', 'Recelestino, Nikki S.', 'ASU-Banga', 'BSED Mathematics', '0961-945-0599', 'Malinao', '2nd', '09/06/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Recelestino NS.pdf|2025-05-23 09:14:37,Recelestino NS.pdf|2025-09-02 05:14:43', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(15, '2022', 'RA 7687', 'Rivero, Aicalyn Kyle Z.', 'ASU-Banga', 'BS Biology', '0956-263-0466', 'Malay', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Rivero AKZ.pdf|2025-05-23 09:14:57,Rivero AKZ.pdf|2025-09-02 05:15:08,Rivero AKZ_summer.pdf|2025-09-02 05:15:08', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(17, '2023', 'RA 7687', 'Araza, Paul Angelo B.', 'ASU-Kalibo', 'BS Civil Engineering', '0999-864-2835', 'Altavas', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', 'With 2 failing grades, for evaluation', 'Problematic', NULL, '2025-03-04-Araza-Paul-Angelo.pdf|2025-05-23 09:15:14,Araza PAB.pdf|2025-09-02 05:15:23,Araza PAB.pdf|2026-04-08 11:04:36', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(18, '2023', 'RA 7687', 'Arboleda, Steven John C.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-755-6554', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', 'Did not submit requirements for semester 2024-2025', 'Updated', NULL, 'Arboleda SJC.pdf|2025-09-02 05:15:37,Arboleda SJC.pdf|2026-04-08 10:44:38', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(19, '2023', 'RA 7687', 'Borreros, Jeriah M.', 'ASU-Kalibo', 'BS Civil Engineering', '0905-662-8176', 'Kalibo', '1st', '08/30/2024-JVG', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Borreros JM.pdf|2025-05-23 09:21:07', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(20, '2023', 'RA 7687', 'Chu, John Lloyd R.', 'ASU-Kalibo', 'BS Civil Engineering', '0981-494-3113', 'Banga', '1st', '09/09/2024-JVG', '02/07/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Chu JLR.pdf|2025-05-23 09:21:23,Chu JLR.pdf|2025-09-02 05:32:34,Chu JLR.pdf|2026-04-08 11:21:27', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(21, '2023', 'RA 7687', 'Crisostomo, Lance Kirby C.', 'ASU-Kalibo', 'BS Civil Engineering', '0970-095-4650', 'Kalibo', '1st', '08/29/2024-IAS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Crisostomo LKC.pdf|2025-05-23 09:21:39,Crisostomo LKC.pdf|2025-09-02 05:32:49,Crisistomo LKC.pdf|2026-04-08 11:30:13', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(22, '2023', 'RA 7687', 'Gajisan, Ryan F.', 'ASU-Kalibo', 'BS Information Technology', '0916-322-0466', 'Malay', '2nd', '09/05/2024-JVG', '02/10/2025-VMMP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Gajisanm RF.pdf|2025-05-23 09:22:12,Gajisan RF.pdf|2025-09-02 05:33:24', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(23, '2023', 'MERIT', 'Idolog, Jeana R.', 'ASU-Kalibo', 'BS Civil Engineering', '0939-110-5724', 'Kalibo', '1st', '09/10/2024-VMMP', '01/28/2025-VMMP', '', '', '', '', '', 'Updated', NULL, 'Idolog MJR.pdf|2025-05-23 09:22:41,Idolog MJR.pdf|2025-09-02 05:33:52', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(24, '2023', 'RA 7687', 'Jimenez, Christian Glenn O.', 'ASU-Kalibo', 'BS Information Technology', '0915-0861-546', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Jimenez CGO.pdf|2025-05-23 09:27:28,JImenez CGO.pdf|2025-09-02 05:34:16', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(25, '2023', 'RA 7687', 'Mallorca, Jasmine Lee B.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0950-996-0486', 'Iloilo', '-', '08/16/2024-PPD', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Mallorca JLB.pdf|2025-05-23 09:27:46,Mallorca JLB.pdf|2025-09-02 05:34:30', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(26, '2023', 'RA 7687', 'Punzal, Jenina Mickaela A.', 'ASU-Banga', 'BSED Mathematics', '0921-988-2101', 'Kalibo', '1st', '08/20/2024-ERRP', '02/06/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Punzal JMA.pdf|2025-05-23 09:28:17,Punzal JMA.pdf|2025-09-02 05:34:47', NULL, NULL, 'Punzal JMA_updated cog.pdf|2025-05-23 09:28:17', '2025-05-23 09:28:17', 'active'),
	(27, '2023', 'RA 7687', 'Rario, James Lyster D.', 'ASU-Kalibo', 'BS Civil Engineering', '0961-807-0072', 'New Washington', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, '2025-03-04-Rario-James-Lyster.pdf|2025-05-23 09:28:42,Rario JLD.pdf|2025-09-02 05:35:03', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(28, '2023', 'RA 7687', 'Reforma, Vince Jesther L.', 'ASU-Kalibo', 'BS Civil Engineering', '0951-215-2035', 'Banga', '1st', '9/17/2024-ARS', '-', '-', '-', '-', '-', 'Did not submit requirements last semester 2024-2025', 'Updated', NULL, 'Reforma VJL.pdf|2025-09-02 05:35:21', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(29, '2023', 'RA 7687', 'Remon, Norielyn T.', 'ASU-Banga', 'BS Biology', '0908-786-7149', 'Tangalan', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Remon NJ.pdf|2025-05-23 09:46:53,Remon NT.pdf|2025-09-02 05:35:44', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(30, '2023', 'RA 7687', 'Salido, AJ J.', 'ASU-Banga', 'BS Biology', '0970-513-5475', 'Ibajay', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Salido AJ.pdf|2025-05-23 09:50:47,Salido AJ.pdf|2025-09-02 05:35:59', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(31, '2023', 'RA 7687', 'Vedeo, Aljon Charles R.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-801-9520', 'New Washington', '1st', '09/09/2024-IAS', '-', '-', '-', '-', '-', '-', 'Problematic', NULL, '2025-02-25-Vedeo-Aljon Charles.pdf|2025-05-23 09:51:21,Vedeo ACR.pdf|2025-09-02 05:36:15', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(32, '2023', 'RA 7687', 'Villarias, John  Germel Paul M.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0976-139-1767', 'Makato', '2nd', '07/26/2024-ERRP', '02/07/2025-ERRP', '-', '08/09/2024-VMMP', '-', '-', '-', 'Updated', NULL, 'Villarias JGPM.pdf|2025-05-23 09:51:38,Villarias JGPM.pdf|2025-09-02 05:36:50', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(33, '2023', 'RA 7687-JLSS', 'Espiritu, Rico Jay G.', 'ASU-Banga', 'BS Biology', '0998-156-2774', 'Tangalan', '2nd', '11/18/24-VMMP', '1/23/2025-ERRP', '', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Espiritu RJG.pdf|2025-05-23 09:52:00', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(34, '2023', 'RA 7687-JLSS', 'Tampos, Genevieve Marie B.', 'ASU-Banga', 'BSED Mathematics', '0966-162-7922', 'Tangalan', '2nd', '08/14/2024-JVG', '-', '-', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Tampos GMB.pdf|2025-05-23 09:59:41', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(35, '2023', 'RA 7687-JLSS', 'Melgar, Danielle R.', 'ASU-Banga', 'BS Biology', '0915-022-3888', 'Kalibo', '1st', '08/15/2024-ERRP', '02/06/2025-ERRP', '', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Melgar DR.pdf|2025-05-23 10:00:03,2025-03-03-Melgar-Danielle.pdf|2025-05-23 10:01:15', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(36, '2023', 'MERIT-JLSS', 'Roldan, Avelina Jhones L.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0908-1279-512', 'Buruanga', '2nd', '08/02/2024-PPD', '-', '-', '11/15/2024 - JVG', '-', '-', '-', 'Updated', NULL, 'Roldan AJJ_letter of appeal.pdf|2025-05-23 10:00:24,Roldan AJL.pdf|2025-05-23 10:00:24,Roldan AJL.pdf|2025-09-02 06:40:56', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(37, '2023', 'MERIT-JLSS', 'Briones, Errold Francis R.', 'ASU-Banga', 'BS Biology', '0950-271-6218', 'Makato', '2nd', '08/19/2024-IAS', '01/23/2025-MDV', '', '-', '-', '-', 'Graduated', 'Updated', '2025', '2025-03-03-Briones-Errold-Francis.pdf|2025-05-23 10:00:55,Briones EFR.pdf|2025-05-23 10:00:55,Briones EFR_3.pdf|2025-05-23 10:00:55', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(38, '2023', 'RA 10612-JLSS', 'Baladjay, Jerlie Mae C.', 'ASU-Banga', 'BSED Mathematics', '0916-226-3655', 'Nabas', '2nd', '8/14/2024-JVG', '-', '-', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Baladjay JMC.pdf|2025-05-23 10:05:34', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(39, '2023', 'RA 10612-JLSS', 'Luces, Elmo C.', 'ASU-Banga', 'BSED Mathematics', '0947-531-3497', 'Malay', '2nd', '08/14/2024-JVG', '-', '-', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Luces EC.pdf|2025-05-23 10:20:03', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(40, '2023', 'RA 10612-JLSS', 'Narciso, Mark Neil R.', 'ASU-Banga', 'BSED Mathematics', '0960-676-3591', 'Malinao', '2nd', '08/13/2024-ARS', '-', '-', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Narciso MNR.pdf|2025-05-23 10:20:39', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(41, '2023', 'RA 10612-JLSS', 'Zacarias, Prince Nicole N.', 'ASU-Banga', 'BSED Science', '0938-845-0154', 'Kalibo', '1st', '08/06/2024-ERRP', '-', '-', '-', '-', '-', 'Graduated', 'Updated', '2025', 'Zacarias PNN.pdf|2025-05-23 10:21:05', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(42, '2022', 'RA 7687', 'Zorca, Bhea Mae N.', 'ASU-Banga', 'BSED Mathematics', '0966-276-6077', 'Kalibo', '1st', '08/14/2024-JVG', '-', '-', '-', '-', '-', '', 'Updated', NULL, 'Zorca Bhea Mae.pdf|2025-05-23 10:21:23,Zorca BMN.pdf|2025-09-02 06:43:01', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(43, '2023', 'RA 7687', 'Esto Naeden Lyn L.', 'ASU-Kalibo', 'BS Information Technology', '0966-184-3782', 'New Washington', '1st', '08/19/2024-IAS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Esto NLL.pdf|2025-05-23 10:22:47,Esto NL.pdf|2025-09-02 06:43:19', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(44, '2024', 'RA 7687', 'Barte, Zara J.', 'ASU-Kalibo', 'BS Information Technology', '0927-877-9625', 'Balete', '1st', '-', '01/24/2025-ARS', '-', '-', '-', '-', '-', 'Updated', NULL, 'Barte ZJ.pdf|2025-05-23 10:26:58,Barte ZJ.pdf|2025-09-02 06:43:37,Barte ZJ.pdf|2026-04-08 11:08:34', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(45, '2024', 'MERIT', 'Bautista, Mark Andrew M.', 'ASU-Kalibo', 'BS Civil Engineering', '0906-455-8806', 'Antique', '-', '-', '01/27/2025-AUD', '-', '-', '-', '-', '-', 'Updated', NULL, 'Bautista MAM.pdf|2025-05-23 10:27:36,Bautista MAM.pdf|2025-09-02 06:43:53,Bautista MAM.pdf|2026-04-08 11:09:32', NULL, NULL, 'Bautisata MAM_Updated COG.pdf|2025-05-23 10:27:36', '2025-05-23 10:27:36', 'active'),
	(46, '2024', 'RA 7687', 'Bautista, Ramon Chito M.', 'ASU-Banga', 'BS Biology', '0966-985-1287', 'Ibajay', '2nd', '-', '1/28/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Bautista RCM.pdf|2025-05-23 10:27:55,Bautista RCM.pdf|2025-09-02 06:44:09,Bautista RCM.pdf|2026-04-08 11:09:52', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(47, '2024', 'MERIT', 'Casimero, Mehlcon D.', 'ASU-Kalibo', 'BS Information Technology', '0945-490-8465', 'Kalibo', '1st', '-', '1/24/2025-ARS', '-', '-', '-', '-', '-', 'Updated', NULL, 'Casimero MP_proof LBP.pdf|2025-05-23 10:28:24,Casimero. MP.pdf|2025-05-23 10:28:24,Casimero MD.pdf|2025-09-02 06:44:30,Casimero MD.pdf|2026-04-08 11:18:36', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(48, '2024', 'MERIT', 'Cichon, Chad Cromwell E.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-149-1371', 'Kalibo', '1st', '-', '1/27/2025-AUD', '-', '-', '-', '-', '-', 'Updated', NULL, 'Cichon CCE.pdf|2025-05-23 10:28:56,Cichon CCE.pdf|2025-09-02 06:44:47,Cichon CCE.pdf|2026-04-08 11:21:58', NULL, NULL, 'Cichon CCE_updated COG.pdf|2025-05-23 10:28:56', '2025-05-23 10:28:56', 'active'),
	(49, '2024', 'RA 7687', 'Dionzon, Christine A.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0977-451-8211', 'Banga', '1st', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Dionzon CA.pdf|2025-05-23 10:32:39,Dionzon CA.pdf|2025-09-02 06:45:11,Dionzon CA.pdf|2026-04-08 11:38:30', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(50, '2024', 'RA 7687', 'Molo, Aron Job T.', 'ASU-Kalibo', 'BS Civil Engineering', '0970-643-9118', 'Tangalan', '2nd', '-', '01/17/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Molo AJT.pdf|2025-05-23 10:33:03,Molo. AJT.pdf|2025-09-02 06:45:28', NULL, NULL, 'Molo AJT_updated cog.pdf|2025-05-23 10:33:03', '2025-05-23 10:33:03', 'active'),
	(51, '2024', 'RA 7687', 'Ocampo, Miguel Pauley O.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-801-6626', 'Kalibo', '1st', '-', '01/14/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Ocampo MPO.pdf|2025-05-23 10:33:23,Ocampo MPO.pdf|2025-09-02 06:45:45', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(52, '2024', 'RA 7687', 'Pelayo, Jeric Q.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-428-8596', 'Kalibo', '1st', '-', '01/14/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Pelayo JQ.pdf|2025-05-23 10:35:28,Pelayo JQ.pdf|2025-09-02 06:46:09', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(53, '2024', 'RA 7687', 'Placio, Sean Ronels R.', 'ASU-Banga', 'BS Applied Mathematics', '0963-988-4337', 'Ibajay', '2nd', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Placio SRP.pdf|2025-05-23 10:35:52,Placio SRR.pdf|2025-09-02 06:46:37,Placio SRR.pdf|2026-04-08 10:42:41', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(54, '2024', 'RA 7687', 'Tandog, Andrea A.', 'ASU-Kalibo', 'BS Civil Engineering', '0915-500-8911', 'Romblon', '-', '-', '01/15/2025-ERRP', '', '-', '-', '-', '-', 'Updated', NULL, 'Tandog AA.pdf|2025-05-23 10:42:02,Tandog AT.pdf|2025-09-02 06:55:36', NULL, NULL, 'Tandog AA_updated COG.pdf|2025-05-23 10:42:49', '2025-05-23 10:42:49', 'active'),
	(55, '2024', 'RA 7687', 'Tandog, Ken Vincent T.', 'ASU-Kalibo', 'BS Civil Engineering', '0985-081-0032', 'Tangalan', '2nd', '-', '02/04/2025-IAS', '-', '-', '-', '-', '-', 'Updated', NULL, 'Tandog KVT.pdf|2025-05-23 10:42:27,Tandog KVT.pdf|2025-09-02 06:56:19', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(56, '2024', 'RA 7687', 'Verangel, Lareign V.', 'ASU-Banga', 'BS Food Technology', '0916-626-0285', 'Kalibo', '1st', '-', '01/31/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Verangel LV.pdf|2025-05-23 10:43:33,Verangel LV.pdf|2025-09-02 06:56:58', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(57, '2024', 'RA 7687', 'Vergara, Eurecka Yzabel M.', 'ASU-Kalibo', 'BS Civil Engineering', '0956-470-9675', 'Ibajay', '2nd', '-', '01/15/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Vergara EYM.pdf|2025-05-23 10:43:54,Vergara EYM.pdf|2025-09-02 06:57:22', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(58, '2024', 'RA 7687', 'Villanueva, Juris Marie M.', 'ASU-Banga', 'BS Biology', '0938-884-9736', 'Kalibo', '1st', '-', '01/30/2025-IAS', '-', '-', '-', '-', '-', 'Updated', NULL, 'Villanueva JMM.pdf|2025-05-23 10:44:16,Villanueva JMM.pdf|2025-09-02 06:59:41', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(59, '2024', 'MERIT', 'Yuson, Jaimz Neathann B.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-095-7736', 'Numancia', '2nd', '-', '01/15/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Yuson JNB.pdf|2025-05-23 10:47:55,Yuson JNB.pdf|2025-09-02 07:11:33', NULL, NULL, 'Yuson JNB_updated COG.pdf|2025-05-23 10:47:55', '2025-05-23 10:47:55', 'active'),
	(60, '2024', 'MERIT', 'Italia, Beanne Rexannie I.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0977-3137-905', 'Iloilo', '-', '-', '01/23/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Italia BRB.pdf|2025-05-23 10:48:17,Italia BRB.pdf|2025-09-02 07:11:50', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(61, '2024', 'RA 10612-JLSS', 'Ambay, Edilmarc M.', 'ASU-Banga', 'BS Biology', '0963-0400-760', 'Ibajay', '2nd', '-', '01/23/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Ambay EM.pdf|2025-05-23 10:48:37,Ambay EM.pdf|2025-09-02 07:12:08,Ambay EM_summer.pdf|2025-09-02 07:12:08,Ambay EM.pdf|2026-04-08 11:04:05', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(62, '2024', 'RA 7687-JLSS', 'Arcenio, Kate  Jasmine S.', 'ASU-Banga', 'BS Biology', '0966-8400-619', 'Numancia', '2nd', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Arcenio KJS.pdf|2025-05-23 10:48:55,Arcenio KJS.pdf|2025-09-02 07:12:27,Arcenio KJS_summer.pdf|2025-09-02 07:12:27,Arcenio KJS.pdf|2026-04-08 11:05:13', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(63, '2024', 'MERIT-JLSS', 'Castillo, Jujen O.', 'ASU-Banga', 'BSED Mathematics', '0920-2808-173', 'Kalibo', '1st', '', '02/06/2025- ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Castillo JO.pdf|2025-05-23 10:49:29,Castillo JO.pdf|2025-09-02 07:12:47,Castillo JO.pdf|2026-04-08 11:19:03', NULL, NULL, 'Castillo Jujen.pdf|2025-05-23 10:49:29', '2025-05-23 10:49:29', 'active'),
	(64, '2024', 'RA 10612-JLSS', 'Guevarra, Shainah Joyce N.', 'ASU-Kalibo', 'BS Civil Engineering', '0916-5353-757', 'Kalibo', '1st', '-', '02/06/2025-ERRP', '-', '-', '-', '-', 'Did not submit requirements last semester 2024-2025', 'Updated', NULL, 'Guevarra SJN.pdf|2025-09-02 07:13:12,Guevarra SJN_summer.pdf|2025-09-02 07:13:12', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(65, '2024', 'MERIT-JLSS', 'Sanglitan, Evar, Jr. I.', 'ASU-Ibajay', 'BS Computer Science', '0908-2825-497', 'Tangalan', '2nd', '-', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Sanglitan EI Jr..pdf|2025-05-23 10:56:20,Sanglitan EIJr.pdf|2025-09-02 07:14:13', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(66, '2024', 'RA 7687-JLSS', 'Valle, Jay Mark O.', 'ASU-Banga', 'BS Biology', '0930-848-7542', 'Kalibo', '1st', '-', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Valle JMO.pdf|2025-05-23 10:56:41,Valle JMO_summer.pdf|2025-09-02 07:14:58,ValleJMO.pdf|2025-09-02 07:14:58', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(67, '2024', 'RA 10612-JLSS', 'Verangel, Niño Janre V.', 'ASU-Kalibo', 'BS Information Technology', '0970-230-1501', 'Kalibo', '1st', '-', '01/30/2025-IAS', '-', '-', '-', '-', '-', 'Updated', NULL, 'Verangel NJV.pdf|2025-05-23 10:57:04,Verangel NJV.pdf|2025-09-02 07:15:28', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(68, '2024', 'RA 7687-JLSS', 'Viray, Daniella P.', 'ASU-Banga', 'BSED Science', '0912-5179-633', 'Lezo', '2nd', '-', '02/03/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Viray DP.pdf|2025-05-23 10:57:36,Viray DP.pdf|2025-09-02 07:15:54', NULL, NULL, 'Viray Daniella P..pdf|2025-05-23 10:57:36', '2025-05-23 10:57:36', 'active'),
	(74, '2019', 'RA 7687', 'Artemio Caberte, Jr. ', 'ASU-Banga', 'Vet Med', '0907-978-5820', 'Bacolod City', 'Others', NULL, NULL, '', NULL, '', '', 'Non-Compliance, waiting for Memo from SEI, Graduated', 'Problematic', '2025', '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(76, '2025', 'RA 7687', 'Cervantos, Lloela Marie ', 'ASU-Kalibo', 'BS Information Technology', '0999-609-9737', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Cervantos LM.pdf|2026-04-08 10:58:17', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(77, '2025', 'MERIT', 'Contado, Rod Michael I.', 'ASU-Kalibo', 'BS Information Technology', '0985-347-5350', 'Malinao', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Contado RMI.pdf|2026-04-08 11:29:04', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(78, '2025', 'RA 7687', 'Dulhao, Ashley Nicole', 'ASU-Banga', 'BS Biology', '0956-685-1942', 'Malay', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Dulhao ANB.pdf|2026-04-08 11:39:05', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(79, '2025', 'RA 7687', 'Leyson, Xaider Hans ', 'ASU-Banga', 'BSED Mathematics', '0946-294-9362', 'Banga', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(80, '2025', 'RA 7687', 'Olino, Marlouie Jake', 'ASU-Banga', 'BS Agriculture', '0939-808-2857', 'Batan', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(81, '2025', 'MERIT', 'Rey, Aveija Shanell ', 'ASU-Banga', 'BS Biology', '0951-151-4732', 'Numancia', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(82, '2025', 'MERIT', 'Talde, Poly Andrew ', 'ASU-Banga', 'BSED Mathematics', '0991-965-4676', 'Capiz', '-', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(83, '2025', 'RA 7687', 'Veran, Dioscoro Salvador ', 'ASU-Banga', 'BS Biology', '0993-079-7326', 'Numancia', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(84, '2025', 'RA 7687', 'Tumaca, Kenneth', 'ASU-Kalibo', 'BS Civil Engineering', '0935-905-5585', 'Antique', '-', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(85, '2025', 'MERIT', 'Zomil, Yuan Emanuel ', 'ASU-Kalibo', 'BS Civil Engineering', '0981-767-8627', 'Libacao', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(86, '2025', 'RA 7687', 'Dailisan, Monica Faith ', 'ASU-Banga', 'BS Biology', '0946-672-4649', 'Ibajay', '2nd ', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Dailisan MFB.pdf|2026-04-08 11:30:50', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(87, '2025', 'MERIT', 'Borreros, Jacob M', 'ASU-Kalibo', 'BS Architecture', '0905-662-8176', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Borreros JM(1).pdf|2026-04-08 11:18:11,Borreros JM.pdf|2026-04-08 11:18:11', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(88, '2025', 'RA 7687', 'Legaspi, Jaeron D. ', 'ASU-Kalibo', 'BS Architecture', '0938-012-9910', 'Makato', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(89, '2025', 'RA 7687', 'Relator, Rian Mayumi D. ', 'ASU-Banga', 'BS Biology', '0969-034-8184', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(90, '2025', 'RA 7687', 'Billones, Lester Emman R. ', 'ASU-Kalibo', 'BS Information Technology', '0963-664-5447', 'Balete', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Billones LER.pdf|2026-04-08 11:17:15', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(91, '2025', 'MERIT', 'Magwale, Jan Miles A. ', 'ASU-Kalibo', 'BS Information System', '0967-309-7532', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(92, '2025', 'Merit', 'Alcantara, Leslie Ann B. ', 'ASU-Banga', 'BSEd Mathematics', '0948-169-1508', 'Altavas', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Alcantara LAB.pdf|2026-04-08 10:54:44', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(93, '2025', 'RA 7687', 'Alcaraz, Christine Mabel C. ', 'ASU-Banga', 'BSEd Science', '0930-133-0199', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Alcaraz CIC.pdf|2026-04-08 11:02:01', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(94, '2025', 'RA 10612-JLSS', 'Belga, Zyryl Jeff C.', 'ASU-Kalibo', 'BS Civil Engineering', '0906-046-3322', 'Malay', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Belga ZJC.pdf|2026-04-08 11:16:45', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(95, '2025', 'RA 7687', 'Degracia, Mark Yuri A.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0995-367-9567', 'Roxas City', '-', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Degracia MYA.pdf|2026-04-08 11:33:55', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(96, '2025', 'RA 7687-JLSS', 'Dela Vega, Cherie Ann I.', 'ASU-Kalibo', 'BS Civil Engineering', '0946-317-6649', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Dela Vega CAI.pdf|2026-04-08 11:38:07', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
	(97, '2025', 'RA 7687-JLSS', 'raiza', 'ASU-Kalibo', 'BS Civil Engineering', '0946-317-6649', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, '', NULL, NULL, '', '0000-00-00 00:00:00', 'active');

-- Dumping structure for table scholarship_db.tbl_municipalities
CREATE TABLE IF NOT EXISTS `tbl_municipalities` (
  `fld_ID` int(6) NOT NULL AUTO_INCREMENT,
  `fld_municipality` varchar(200) NOT NULL,
  `fld_district` varchar(20) NOT NULL,
  `fld_status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fld_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.tbl_municipalities: ~17 rows (approximately)
INSERT INTO `tbl_municipalities` (`fld_ID`, `fld_municipality`, `fld_district`, `fld_status`) VALUES
	(1, 'Altavas', '1st', 'active'),
	(2, 'Balete', '1st', 'active'),
	(3, 'Banga', '1st', 'active'),
	(4, 'Batan', '1st', 'active'),
	(5, 'Buruanga', '2nd', 'active'),
	(6, 'Ibajay', '2nd', 'active'),
	(7, 'Kalibo', '1st', 'active'),
	(8, 'Lezo', '2nd', 'active'),
	(9, 'Libacao', '1st', 'active'),
	(10, 'Madalag', '1st', 'active'),
	(11, 'Makato', '2nd', 'active'),
	(12, 'Malay', '2nd', 'active'),
	(13, 'Malinao', '2nd', 'active'),
	(14, 'Nabas', '2nd', 'active'),
	(15, 'New Washington', '1st', 'active'),
	(16, 'Numancia', '2nd', 'active'),
	(17, 'Tangalan', '2nd', 'active');

-- Dumping structure for table scholarship_db.tbl_scholar_status
CREATE TABLE IF NOT EXISTS `tbl_scholar_status` (
  `fld_ID` int(6) NOT NULL AUTO_INCREMENT,
  `fld_scholarshipStatus` varchar(50) NOT NULL,
  `fld_type` varchar(50) DEFAULT NULL,
  `fld_status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fld_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.tbl_scholar_status: ~5 rows (approximately)
INSERT INTO `tbl_scholar_status` (`fld_ID`, `fld_scholarshipStatus`, `fld_type`, `fld_status`) VALUES
	(1, 'Updated', 'ongoing', 'active'),
	(2, 'Graduated', 'graduated', 'inactive'),
	(3, 'Problematic', 'ongoing', 'active'),
	(4, 'Ongoing', 'ongoing', 'inactive'),
	(5, 'Undergraduate', 'ongoing', 'inactive');

-- Dumping structure for table scholarship_db.tbl_scholarship_programs
CREATE TABLE IF NOT EXISTS `tbl_scholarship_programs` (
  `fld_ID` int(10) NOT NULL AUTO_INCREMENT,
  `fld_scholarshipCode` varchar(200) NOT NULL,
  `fld_scholarshipName` varchar(200) NOT NULL,
  `fld_notes` varchar(200) DEFAULT NULL,
  `fld_status` varchar(20) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fld_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.tbl_scholarship_programs: ~7 rows (approximately)
INSERT INTO `tbl_scholarship_programs` (`fld_ID`, `fld_scholarshipCode`, `fld_scholarshipName`, `fld_notes`, `fld_status`) VALUES
	(1, 'MERIT', 'MERIT', 'Eligible only for 1st years', 'active'),
	(2, 'MERIT', 'MERIT-JLSS', 'Eligible only for 3rd years', 'active'),
	(3, 'RA 10612', 'RA 10612', 'Eligible only for 1st years', 'active'),
	(4, 'RA 10612', 'RA 10612-JLSS', 'Eligible only for 3d Years', 'active'),
	(5, 'RA 7687', 'RA 7687', 'Eligible only for 1st Years', 'active'),
	(6, 'RA 7687', 'RA 7687-JLSS', 'Eligible only for 3rd Years', 'active'),
	(7, 'Mistake', 'My Fault', 'I made a mistake and duplicated a record. Feel free to reuse this if you want to.', 'inactive');

-- Dumping structure for table scholarship_db.tbl_schools
CREATE TABLE IF NOT EXISTS `tbl_schools` (
  `fld_ID` int(6) NOT NULL AUTO_INCREMENT,
  `fld_schoolName` varchar(200) NOT NULL,
  `fld_address` varchar(200) DEFAULT NULL,
  `fld_status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fld_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.tbl_schools: ~7 rows (approximately)
INSERT INTO `tbl_schools` (`fld_ID`, `fld_schoolName`, `fld_address`, `fld_status`) VALUES
	(1, 'ASU-Banga', 'Banga, Aklanon', 'active'),
	(2, 'ASU-Kalibo', 'Kalibo, Aklan', 'active'),
	(3, 'ASU-Ibajay', 'Ibajay, Aklan', 'active'),
	(4, 'ASU-Madalag', 'Madalag, Aklan', 'active'),
	(5, 'ASU-New Washington', 'New Washington, Aklan', 'active'),
	(6, 'Garcia College Of Technology', 'Kalibo, Aklan', 'active'),
	(7, 'STI College', 'Kalibo, Aklan', 'active');

-- Dumping structure for table scholarship_db.uploaded_files
CREATE TABLE IF NOT EXISTS `uploaded_files` (
  `fld_id` int(10) NOT NULL AUTO_INCREMENT,
  `fld_scholar_ID` int(10) NOT NULL,
  `fld_upload_type` varchar(100) NOT NULL,
  `fld_filename` varchar(250) NOT NULL,
  `fld_uploaded_at` datetime NOT NULL,
  `fld_record_status` varchar(100) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fld_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table scholarship_db.uploaded_files: ~171 rows (approximately)
INSERT INTO `uploaded_files` (`fld_id`, `fld_scholar_ID`, `fld_upload_type`, `fld_filename`, `fld_uploaded_at`, `fld_record_status`) VALUES
	(1, 2, 'periodic_requirements', 'Nicodemus JAY.pdf', '2025-05-23 08:23:56', 'active'),
	(2, 2, 'periodic_requirements', 'Nicodemus JAY.pdf', '2025-09-02 05:10:29', 'inactive'),
	(3, 4, 'periodic_requirements', 'Panaligan MJD.pdf', '2025-05-23 08:24:57', 'active'),
	(4, 4, 'periodic_requirements', 'Panaligan MJD_letter of appeal.pdf', '2025-05-23 08:24:57', 'active'),
	(5, 4, 'periodic_requirements', 'Panaligan MJD.pdf', '2025-09-02 05:10:51', 'inactive'),
	(6, 5, 'periodic_requirements', 'Magsisi CJ.pdf', '2025-05-23 08:30:22', 'active'),
	(7, 5, 'periodic_requirements', 'Magsisi CJ.pdf', '2025-09-02 05:11:11', 'inactive'),
	(8, 5, 'periodic_requirements', 'Magsisi CJ.pdf', '2026-04-21 03:43:28', 'inactive'),
	(9, 5, 'updated_cog_filename', 'Magsisi CJ_updated COG.pdf', '2025-07-31 08:43:06', 'active'),
	(10, 6, 'periodic_requirements', 'Apolonio GMM.pdf', '2025-05-23 08:37:37', 'active'),
	(11, 7, 'periodic_requirements', 'Ibit MGB.pdf', '2025-05-23 08:38:03', 'active'),
	(12, 7, 'periodic_requirements', 'Ibit MGB.pdf', '2025-09-02 05:11:52', 'inactive'),
	(13, 7, 'periodic_requirements', 'Ibit MGB_summer.pdf', '2025-09-02 05:11:52', 'active'),
	(14, 8, 'periodic_requirements', 'Vicente CMA.pdf', '2025-05-23 08:47:08', 'active'),
	(15, 8, 'periodic_requirements', 'Vicente CMA.pdf', '2025-09-02 05:12:19', 'inactive'),
	(16, 8, 'periodic_requirements', 'Vicente CMA_summer.pdf', '2025-09-02 05:12:19', 'active'),
	(17, 9, 'periodic_requirements', 'Castor SR.pdf', '2025-05-23 08:47:52', 'active'),
	(18, 9, 'periodic_requirements', 'Castor SR.pdf', '2025-09-02 05:12:42', 'inactive'),
	(19, 9, 'periodic_requirements', 'Castor SR_summer.pdf', '2025-09-02 05:12:42', 'active'),
	(20, 9, 'periodic_requirements', 'Castor SR.pdf', '2026-04-08 11:19:32', 'inactive'),
	(21, 10, 'periodic_requirements', 'De Joseph MC.pdf', '2025-05-23 09:03:53', 'active'),
	(22, 10, 'periodic_requirements', 'De Joseph MC.pdf', '2025-09-02 05:13:28', 'inactive'),
	(23, 10, 'periodic_requirements', 'De Joseph MC_summer.pdf', '2025-09-02 05:13:28', 'active'),
	(24, 10, 'periodic_requirements', 'De Joseph MC.pdf', '2026-04-08 11:31:25', 'inactive'),
	(25, 11, 'periodic_requirements', 'Igtanloc CMH.pdf', '2025-05-23 09:04:15', 'active'),
	(26, 11, 'periodic_requirements', 'Igtanloc CMH.pdf', '2025-09-02 05:13:09', 'inactive'),
	(27, 12, 'periodic_requirements', 'Kaindoy LPD.pdf', '2025-09-02 05:13:54', 'active'),
	(28, 13, 'periodic_requirements', 'Quime HB.pdf', '2025-05-23 09:14:12', 'active'),
	(29, 13, 'periodic_requirements', 'Quime HB_proof.pdf', '2025-05-23 09:14:12', 'active'),
	(30, 13, 'periodic_requirements', 'Quime HB.pdf', '2025-09-02 05:14:24', 'inactive'),
	(31, 13, 'periodic_requirements', 'Quime HB_summer.pdf', '2025-09-03 02:58:34', 'active'),
	(32, 14, 'periodic_requirements', 'Recelestino NS.pdf', '2025-05-23 09:14:37', 'active'),
	(33, 14, 'periodic_requirements', 'Recelestino NS.pdf', '2025-09-02 05:14:43', 'inactive'),
	(34, 15, 'periodic_requirements', 'Rivero AKZ.pdf', '2025-05-23 09:14:57', 'active'),
	(35, 15, 'periodic_requirements', 'Rivero AKZ.pdf', '2025-09-02 05:15:08', 'inactive'),
	(36, 15, 'periodic_requirements', 'Rivero AKZ_summer.pdf', '2025-09-02 05:15:08', 'active'),
	(37, 17, 'periodic_requirements', '2025-03-04-Araza-Paul-Angelo.pdf', '2025-05-23 09:15:14', 'active'),
	(38, 17, 'periodic_requirements', 'Araza PAB.pdf', '2025-09-02 05:15:23', 'active'),
	(39, 17, 'periodic_requirements', 'Araza PAB.pdf', '2026-04-08 11:04:36', 'inactive'),
	(40, 18, 'periodic_requirements', 'Arboleda SJC.pdf', '2025-09-02 05:15:37', 'active'),
	(41, 18, 'periodic_requirements', 'Arboleda SJC.pdf', '2026-04-08 10:44:38', 'inactive'),
	(42, 19, 'periodic_requirements', 'Borreros JM.pdf', '2025-05-23 09:21:07', 'active'),
	(43, 20, 'periodic_requirements', 'Chu JLR.pdf', '2025-05-23 09:21:23', 'active'),
	(44, 20, 'periodic_requirements', 'Chu JLR.pdf', '2025-09-02 05:32:34', 'inactive'),
	(45, 20, 'periodic_requirements', 'Chu JLR.pdf', '2026-04-08 11:21:27', 'inactive'),
	(46, 21, 'periodic_requirements', 'Crisostomo LKC.pdf', '2025-05-23 09:21:39', 'active'),
	(47, 21, 'periodic_requirements', 'Crisostomo LKC.pdf', '2025-09-02 05:32:49', 'inactive'),
	(48, 21, 'periodic_requirements', 'Crisistomo LKC.pdf', '2026-04-08 11:30:13', 'active'),
	(49, 22, 'periodic_requirements', 'Gajisanm RF.pdf', '2025-05-23 09:22:12', 'active'),
	(50, 22, 'periodic_requirements', 'Gajisan RF.pdf', '2025-09-02 05:33:24', 'active'),
	(51, 23, 'periodic_requirements', 'Idolog MJR.pdf', '2025-05-23 09:22:41', 'active'),
	(52, 23, 'periodic_requirements', 'Idolog MJR.pdf', '2025-09-02 05:33:52', 'inactive'),
	(53, 24, 'periodic_requirements', 'Jimenez CGO.pdf', '2025-05-23 09:27:28', 'active'),
	(54, 24, 'periodic_requirements', 'JImenez CGO.pdf', '2025-09-02 05:34:16', 'active'),
	(55, 25, 'periodic_requirements', 'Mallorca JLB.pdf', '2025-05-23 09:27:46', 'active'),
	(56, 25, 'periodic_requirements', 'Mallorca JLB.pdf', '2025-09-02 05:34:30', 'inactive'),
	(57, 26, 'periodic_requirements', 'Punzal JMA.pdf', '2025-05-23 09:28:17', 'active'),
	(58, 26, 'periodic_requirements', 'Punzal JMA.pdf', '2025-09-02 05:34:47', 'inactive'),
	(59, 26, 'updated_cog_filename', 'Punzal JMA_updated cog.pdf', '2025-05-23 09:28:17', 'active'),
	(60, 27, 'periodic_requirements', '2025-03-04-Rario-James-Lyster.pdf', '2025-05-23 09:28:42', 'active'),
	(61, 27, 'periodic_requirements', 'Rario JLD.pdf', '2025-09-02 05:35:03', 'active'),
	(62, 28, 'periodic_requirements', 'Reforma VJL.pdf', '2025-09-02 05:35:21', 'active'),
	(63, 29, 'periodic_requirements', 'Remon NJ.pdf', '2025-05-23 09:46:53', 'active'),
	(64, 29, 'periodic_requirements', 'Remon NT.pdf', '2025-09-02 05:35:44', 'active'),
	(65, 30, 'periodic_requirements', 'Salido AJ.pdf', '2025-05-23 09:50:47', 'active'),
	(66, 30, 'periodic_requirements', 'Salido AJ.pdf', '2025-09-02 05:35:59', 'active'),
	(67, 31, 'periodic_requirements', '2025-02-25-Vedeo-Aljon Charles.pdf', '2025-05-23 09:51:21', 'active'),
	(68, 31, 'periodic_requirements', 'Vedeo ACR.pdf', '2025-09-02 05:36:15', 'active'),
	(69, 32, 'periodic_requirements', 'Villarias JGPM.pdf', '2025-05-23 09:51:38', 'active'),
	(70, 32, 'periodic_requirements', 'Villarias JGPM.pdf', '2025-09-02 05:36:50', 'inactive'),
	(71, 33, 'periodic_requirements', 'Espiritu RJG.pdf', '2025-05-23 09:52:00', 'active'),
	(72, 34, 'periodic_requirements', 'Tampos GMB.pdf', '2025-05-23 09:59:41', 'active'),
	(73, 35, 'periodic_requirements', 'Melgar DR.pdf', '2025-05-23 10:00:03', 'active'),
	(74, 35, 'periodic_requirements', '2025-03-03-Melgar-Danielle.pdf', '2025-05-23 10:01:15', 'active'),
	(75, 36, 'periodic_requirements', 'Roldan AJJ_letter of appeal.pdf', '2025-05-23 10:00:24', 'active'),
	(76, 36, 'periodic_requirements', 'Roldan AJL.pdf', '2025-05-23 10:00:24', 'active'),
	(77, 36, 'periodic_requirements', 'Roldan AJL.pdf', '2025-09-02 06:40:56', 'inactive'),
	(78, 37, 'periodic_requirements', '2025-03-03-Briones-Errold-Francis.pdf', '2025-05-23 10:00:55', 'active'),
	(79, 37, 'periodic_requirements', 'Briones EFR.pdf', '2025-05-23 10:00:55', 'active'),
	(80, 37, 'periodic_requirements', 'Briones EFR_3.pdf', '2025-05-23 10:00:55', 'active'),
	(81, 38, 'periodic_requirements', 'Baladjay JMC.pdf', '2025-05-23 10:05:34', 'active'),
	(82, 39, 'periodic_requirements', 'Luces EC.pdf', '2025-05-23 10:20:03', 'active'),
	(83, 40, 'periodic_requirements', 'Narciso MNR.pdf', '2025-05-23 10:20:39', 'active'),
	(84, 41, 'periodic_requirements', 'Zacarias PNN.pdf', '2025-05-23 10:21:05', 'active'),
	(85, 42, 'periodic_requirements', 'Zorca Bhea Mae.pdf', '2025-05-23 10:21:23', 'active'),
	(86, 42, 'periodic_requirements', 'Zorca BMN.pdf', '2025-09-02 06:43:01', 'active'),
	(87, 43, 'periodic_requirements', 'Esto NLL.pdf', '2025-05-23 10:22:47', 'active'),
	(88, 43, 'periodic_requirements', 'Esto NL.pdf', '2025-09-02 06:43:19', 'active'),
	(89, 44, 'periodic_requirements', 'Barte ZJ.pdf', '2025-05-23 10:26:58', 'active'),
	(90, 44, 'periodic_requirements', 'Barte ZJ.pdf', '2025-09-02 06:43:37', 'active'),
	(91, 44, 'periodic_requirements', 'Barte ZJ.pdf', '2026-04-08 11:08:34', 'active'),
	(92, 45, 'periodic_requirements', 'Bautista MAM.pdf', '2025-05-23 10:27:36', 'active'),
	(93, 45, 'periodic_requirements', 'Bautista MAM.pdf', '2025-09-02 06:43:53', 'inactive'),
	(94, 45, 'periodic_requirements', 'Bautista MAM.pdf', '2026-04-08 11:09:32', 'inactive'),
	(95, 45, 'updated_cog_filename', 'Bautisata MAM_Updated COG.pdf', '2025-05-23 10:27:36', 'active'),
	(96, 46, 'periodic_requirements', 'Bautista RCM.pdf', '2025-05-23 10:27:55', 'active'),
	(97, 46, 'periodic_requirements', 'Bautista RCM.pdf', '2025-09-02 06:44:09', 'inactive'),
	(98, 46, 'periodic_requirements', 'Bautista RCM.pdf', '2026-04-08 11:09:52', 'inactive'),
	(99, 47, 'periodic_requirements', 'Casimero MP_proof LBP.pdf', '2025-05-23 10:28:24', 'active'),
	(100, 47, 'periodic_requirements', 'Casimero. MP.pdf', '2025-05-23 10:28:24', 'active'),
	(101, 47, 'periodic_requirements', 'Casimero MD.pdf', '2025-09-02 06:44:30', 'active'),
	(102, 47, 'periodic_requirements', 'Casimero MD.pdf', '2026-04-08 11:18:36', 'inactive'),
	(103, 48, 'periodic_requirements', 'Cichon CCE.pdf', '2025-05-23 10:28:56', 'active'),
	(104, 48, 'periodic_requirements', 'Cichon CCE.pdf', '2025-09-02 06:44:47', 'inactive'),
	(105, 48, 'periodic_requirements', 'Cichon CCE.pdf', '2026-04-08 11:21:58', 'inactive'),
	(106, 48, 'updated_cog_filename', 'Cichon CCE_updated COG.pdf', '2025-05-23 10:28:56', 'active'),
	(107, 49, 'periodic_requirements', 'Dionzon CA.pdf', '2025-05-23 10:32:39', 'active'),
	(108, 49, 'periodic_requirements', 'Dionzon CA.pdf', '2025-09-02 06:45:11', 'inactive'),
	(109, 49, 'periodic_requirements', 'Dionzon CA.pdf', '2026-04-08 11:38:30', 'inactive'),
	(110, 50, 'periodic_requirements', 'Molo AJT.pdf', '2025-05-23 10:33:03', 'active'),
	(111, 50, 'periodic_requirements', 'Molo. AJT.pdf', '2025-09-02 06:45:28', 'active'),
	(112, 50, 'updated_cog_filename', 'Molo AJT_updated cog.pdf', '2025-05-23 10:33:03', 'active'),
	(113, 51, 'periodic_requirements', 'Ocampo MPO.pdf', '2025-05-23 10:33:23', 'active'),
	(114, 51, 'periodic_requirements', 'Ocampo MPO.pdf', '2025-09-02 06:45:45', 'inactive'),
	(115, 52, 'periodic_requirements', 'Pelayo JQ.pdf', '2025-05-23 10:35:28', 'active'),
	(116, 52, 'periodic_requirements', 'Pelayo JQ.pdf', '2025-09-02 06:46:09', 'inactive'),
	(117, 53, 'periodic_requirements', 'Placio SRP.pdf', '2025-05-23 10:35:52', 'active'),
	(118, 53, 'periodic_requirements', 'Placio SRR.pdf', '2025-09-02 06:46:37', 'inactive'),
	(119, 53, 'periodic_requirements', 'Placio SRR.pdf', '2026-04-08 10:42:41', 'inactive'),
	(120, 54, 'periodic_requirements', 'Tandog AA.pdf', '2025-05-23 10:42:02', 'active'),
	(121, 54, 'periodic_requirements', 'Tandog AT.pdf', '2025-09-02 06:55:36', 'active'),
	(122, 54, 'updated_cog_filename', 'Tandog AA_updated COG.pdf', '2025-05-23 10:42:49', 'active'),
	(123, 55, 'periodic_requirements', 'Tandog KVT.pdf', '2025-05-23 10:42:27', 'active'),
	(124, 55, 'periodic_requirements', 'Tandog KVT.pdf', '2025-09-02 06:56:19', 'inactive'),
	(125, 56, 'periodic_requirements', 'Verangel LV.pdf', '2025-05-23 10:43:33', 'active'),
	(126, 56, 'periodic_requirements', 'Verangel LV.pdf', '2025-09-02 06:56:58', 'inactive'),
	(127, 57, 'periodic_requirements', 'Vergara EYM.pdf', '2025-05-23 10:43:54', 'active'),
	(128, 57, 'periodic_requirements', 'Vergara EYM.pdf', '2025-09-02 06:57:22', 'inactive'),
	(129, 58, 'periodic_requirements', 'Villanueva JMM.pdf', '2025-05-23 10:44:16', 'active'),
	(130, 58, 'periodic_requirements', 'Villanueva JMM.pdf', '2025-09-02 06:59:41', 'inactive'),
	(131, 59, 'periodic_requirements', 'Yuson JNB.pdf', '2025-05-23 10:47:55', 'active'),
	(132, 59, 'periodic_requirements', 'Yuson JNB.pdf', '2025-09-02 07:11:33', 'inactive'),
	(133, 59, 'updated_cog_filename', 'Yuson JNB_updated COG.pdf', '2025-05-23 10:47:55', 'active'),
	(134, 60, 'periodic_requirements', 'Italia BRB.pdf', '2025-05-23 10:48:17', 'active'),
	(135, 60, 'periodic_requirements', 'Italia BRB.pdf', '2025-09-02 07:11:50', 'inactive'),
	(136, 61, 'periodic_requirements', 'Ambay EM.pdf', '2025-05-23 10:48:37', 'active'),
	(137, 61, 'periodic_requirements', 'Ambay EM.pdf', '2025-09-02 07:12:08', 'inactive'),
	(138, 61, 'periodic_requirements', 'Ambay EM_summer.pdf', '2025-09-02 07:12:08', 'active'),
	(139, 61, 'periodic_requirements', 'Ambay EM.pdf', '2026-04-08 11:04:05', 'inactive'),
	(140, 62, 'periodic_requirements', 'Arcenio KJS.pdf', '2025-05-23 10:48:55', 'active'),
	(141, 62, 'periodic_requirements', 'Arcenio KJS.pdf', '2025-09-02 07:12:27', 'inactive'),
	(142, 62, 'periodic_requirements', 'Arcenio KJS_summer.pdf', '2025-09-02 07:12:27', 'active'),
	(143, 62, 'periodic_requirements', 'Arcenio KJS.pdf', '2026-04-08 11:05:13', 'inactive'),
	(144, 63, 'periodic_requirements', 'Castillo JO.pdf', '2025-05-23 10:49:29', 'active'),
	(145, 63, 'periodic_requirements', 'Castillo JO.pdf', '2025-09-02 07:12:47', 'inactive'),
	(146, 63, 'periodic_requirements', 'Castillo JO.pdf', '2026-04-08 11:19:03', 'inactive'),
	(147, 63, 'updated_cog_filename', 'Castillo Jujen.pdf', '2025-05-23 10:49:29', 'active'),
	(148, 64, 'periodic_requirements', 'Guevarra SJN.pdf', '2025-09-02 07:13:12', 'active'),
	(149, 64, 'periodic_requirements', 'Guevarra SJN_summer.pdf', '2025-09-02 07:13:12', 'active'),
	(150, 65, 'periodic_requirements', 'Sanglitan EI Jr..pdf', '2025-05-23 10:56:20', 'active'),
	(151, 65, 'periodic_requirements', 'Sanglitan EIJr.pdf', '2025-09-02 07:14:13', 'active'),
	(152, 66, 'periodic_requirements', 'Valle JMO.pdf', '2025-05-23 10:56:41', 'active'),
	(153, 66, 'periodic_requirements', 'Valle JMO_summer.pdf', '2025-09-02 07:14:58', 'active'),
	(154, 66, 'periodic_requirements', 'ValleJMO.pdf', '2025-09-02 07:14:58', 'inactive'),
	(155, 67, 'periodic_requirements', 'Verangel NJV.pdf', '2025-05-23 10:57:04', 'active'),
	(156, 67, 'periodic_requirements', 'Verangel NJV.pdf', '2025-09-02 07:15:28', 'inactive'),
	(157, 68, 'periodic_requirements', 'Viray DP.pdf', '2025-05-23 10:57:36', 'active'),
	(158, 68, 'periodic_requirements', 'Viray DP.pdf', '2025-09-02 07:15:54', 'inactive'),
	(159, 68, 'updated_cog_filename', 'Viray Daniella P..pdf', '2025-05-23 10:57:36', 'active'),
	(160, 76, 'periodic_requirements', 'Cervantos LM.pdf', '2026-04-08 10:58:17', 'active'),
	(161, 77, 'periodic_requirements', 'Contado RMI.pdf', '2026-04-08 11:29:04', 'active'),
	(162, 78, 'periodic_requirements', 'Dulhao ANB.pdf', '2026-04-08 11:39:05', 'active'),
	(163, 86, 'periodic_requirements', 'Dailisan MFB.pdf', '2026-04-08 11:30:50', 'active'),
	(164, 87, 'periodic_requirements', 'Borreros JM(1).pdf', '2026-04-08 11:18:11', 'active'),
	(165, 87, 'periodic_requirements', 'Borreros JM.pdf', '2026-04-08 11:18:11', 'active'),
	(166, 90, 'periodic_requirements', 'Billones LER.pdf', '2026-04-08 11:17:15', 'active'),
	(167, 92, 'periodic_requirements', 'Alcantara LAB.pdf', '2026-04-08 10:54:44', 'active'),
	(168, 93, 'periodic_requirements', 'Alcaraz CIC.pdf', '2026-04-08 11:02:01', 'active'),
	(169, 94, 'periodic_requirements', 'Belga ZJC.pdf', '2026-04-08 11:16:45', 'active'),
	(170, 95, 'periodic_requirements', 'Degracia MYA.pdf', '2026-04-08 11:33:55', 'active'),
	(171, 96, 'periodic_requirements', 'Dela Vega CAI.pdf', '2026-04-08 11:38:07', 'active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
