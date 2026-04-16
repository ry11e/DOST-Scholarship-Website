-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2026 at 01:32 AM
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
-- Database: `scholarship_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `scholars`
--

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
  `status` varchar(255) NOT NULL,
  `year_graduated` year(4) DEFAULT NULL,
  `periodic_requirements` text NOT NULL,
  `periodic_requirements_filename` text DEFAULT NULL,
  `periodic_requirements_upload_date` datetime DEFAULT NULL,
  `updated_cog_filename` varchar(255) DEFAULT NULL,
  `updated_cog_upload_date` datetime DEFAULT NULL,
  `record_status` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholars`
--

INSERT INTO `scholars` (`id`, `year_of_award`, `scholarship_program`, `name`, `school`, `course`, `contact_no`, `municipality`, `district`, `periodic_requirements_1st_sem`, `periodic_requirements_2nd_sem`, `summer`, `updated_cog`, `delayed_requirements`, `lacking_requirements`, `remarks`, `status`, `year_graduated`, `periodic_requirements`, `periodic_requirements_filename`, `periodic_requirements_upload_date`, `updated_cog_filename`, `updated_cog_upload_date`, `record_status`) VALUES
(2, '2019', 'RA 7687', 'Nicodemus, Jacinth Andrea Y.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0946-216-9619', 'Numancia', '2nd', '-', '-', '-', '-', '-', '', 'For evaluation', 'Problematic', NULL, 'Nicodemus JAY.pdf|2025-05-23 08:23:56,Nicodemus JAY.pdf|2025-09-02 05:10:29', NULL, NULL, '', '2025-04-29 11:17:28', 'active'),
(4, '2019', 'RA 7687', 'Panaligan, Ma. Jocelyn D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0905-602-1270', 'Bacolod City', '-', '', '-', '-', '-', '-', '', 'For evaluation', 'Problematic', NULL, 'Panaligan MJD.pdf|2025-05-23 08:24:57,Panaligan MJD_letter of appeal.pdf|2025-05-23 08:24:57,Panaligan MJD.pdf|2025-09-02 05:10:51', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(5, '2020', 'RA 7687', 'Magsisi, Cassandra Jade', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0976-287-0771', 'Kalibo', '1st', '-', '-', '-', '-', '', '', '', 'Updated', NULL, 'Magsisi CJ.pdf|2025-05-23 08:30:22,Magsisi CJ.pdf|2025-09-02 05:11:11', NULL, NULL, 'Magsisi CJ_updated COG.pdf|2025-07-31 08:43:06', '2025-07-31 08:43:06', 'active'),
(6, '2021', 'RA 7687', 'Apolonio, Glea May M.', 'ASU-Kalibo', 'BS Civil Engineering', '0969-034-1883', 'Lezo', '2nd ', '08/05/2024-VMMP', '02/03/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Apolonio GMM.pdf|2025-05-23 08:37:37', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(7, '2021', 'MERIT', 'Ibit, Marafe Genaen B.', 'ASU-Banga', 'BS Biology', '0918-567-3248', 'New Washington', '1st', '7/29/2024-JVG', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Ibit MGB.pdf|2025-05-23 08:38:03,Ibit MGB.pdf|2025-09-02 05:11:52,Ibit MGB_summer.pdf|2025-09-02 05:11:52', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(8, '2021', 'RA 7687', 'Vicente, Cheska Mae A.', 'ASU-Banga', 'BS Biology', '0951-275-7152', 'Other Region', '-', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Vicente CMA.pdf|2025-05-23 08:47:08,Vicente CMA.pdf|2025-09-02 05:12:19,Vicente CMA_summer.pdf|2025-09-02 05:12:19', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(9, '2022', 'RA 7687', 'Castor, Steffilane R.', 'ASU-Banga', 'BS Biology', '0912-941-3170', 'Banga', '1st', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Castor SR.pdf|2025-05-23 08:47:52,Castor SR.pdf|2025-09-02 05:12:42,Castor SR_summer.pdf|2025-09-02 05:12:42,Castor SR.pdf|2026-04-08 11:19:32', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(10, '2022', 'RA 7687', 'De Joseph, Mayvilyn C.', 'ASU-Banga', 'BS Biology', '0908-127-9001', 'Makato', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'De Joseph MC.pdf|2025-05-23 09:03:53,De Joseph MC.pdf|2025-09-02 05:13:28,De Joseph MC_summer.pdf|2025-09-02 05:13:28,De Joseph MC.pdf|2026-04-08 11:31:25', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(11, '2022', 'RA 7687', 'Igtanloc, Christy Michelle H.', 'ASU-Kalibo', 'BS Information Technology', '0912-752-8406', 'Numancia', '2nd', '08/29/2024-IAS', '01/28/2025-VMMP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Igtanloc CMH.pdf|2025-05-23 09:04:15,Igtanloc CMH.pdf|2025-09-02 05:13:09', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(12, '2022', 'RA 7687', 'Kaindoy, Lian Patrice D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0938-821-0782', 'Kalibo', '1st', '09/16/2024-AUD', '-', '-', '-', '', '-', 'Did not submit requirements last semester 2024-2025', 'Problematic', NULL, 'Kaindoy LPD.pdf|2025-09-02 05:13:54', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(13, '2022', 'RA 7687', 'Quime, Harvey B.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-262-0315', 'Banga', '1st', '08/15/2024-AUD', '01/24/2025-ARS', '-', '-', '', '', 'Non-Compliance, waiting for Memo from SEI', 'Problematic', NULL, 'Quime HB.pdf|2025-05-23 09:14:12,Quime HB_proof.pdf|2025-05-23 09:14:12,Quime HB.pdf|2025-09-02 05:14:24,Quime HB_summer.pdf|2025-09-03 02:58:34', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(14, '2022', 'RA 7687', 'Recelestino, Nikki S.', 'ASU-Banga', 'BSED Mathematics', '0961-945-0599', 'Malinao', '2nd', '09/06/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Recelestino NS.pdf|2025-05-23 09:14:37,Recelestino NS.pdf|2025-09-02 05:14:43', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(15, '2022', 'RA 7687', 'Rivero, Aicalyn Kyle Z.', 'ASU-Banga', 'BS Biology', '0956-263-0466', 'Malay', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', 'Updated', NULL, 'Rivero AKZ.pdf|2025-05-23 09:14:57,Rivero AKZ.pdf|2025-09-02 05:15:08,Rivero AKZ_summer.pdf|2025-09-02 05:15:08', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(17, '2023', 'RA 7687', 'Araza, Paul Angelo B.', 'ASU-Kalibo', 'BS Civil Engineering', '0999-864-2835', 'Altavas', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, '2025-03-04-Araza-Paul-Angelo.pdf|2025-05-23 09:15:14,Araza PAB.pdf|2025-09-02 05:15:23,Araza PAB.pdf|2026-04-08 11:04:36', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(18, '2023', 'RA 7687', 'Arboleda, Steven John C.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-755-6554', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', 'Did not submit requirements for semester 2024-2025', 'Problematic', NULL, 'Arboleda SJC.pdf|2025-09-02 05:15:37,Arboleda SJC.pdf|2026-04-08 10:44:38', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(19, '2023', 'RA 7687', 'Borreros, Jeriah M.', 'ASU-Kalibo', 'BS Civil Engineering', '0905-662-8176', 'Kalibo', '1st', '08/30/2024-JVG', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Borreros JM.pdf|2025-05-23 09:21:07', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(20, '2023', 'RA 7687', 'Chu, John Lloyd R.', 'ASU-Kalibo', 'BS Civil Engineering', '0981-494-3113', 'Banga', '1st', '09/09/2024-JVG', '02/07/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Chu JLR.pdf|2025-05-23 09:21:23,Chu JLR.pdf|2025-09-02 05:32:34,Chu JLR.pdf|2026-04-08 11:21:27', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(21, '2023', 'RA 7687', 'Crisostomo, Lance Kirby C.', 'ASU-Kalibo', 'BS Civil Engineering', '0970-095-4650', 'Kalibo', '1st', '08/29/2024-IAS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Crisostomo LKC.pdf|2025-05-23 09:21:39,Crisostomo LKC.pdf|2025-09-02 05:32:49,Crisistomo LKC.pdf|2026-04-08 11:30:13', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(22, '2023', 'RA 7687', 'Gajisan, Ryan F.', 'ASU-Kalibo', 'BS Information Technology', '0916-322-0466', 'Malay', '2nd', '09/05/2024-JVG', '02/10/2025-VMMP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Gajisanm RF.pdf|2025-05-23 09:22:12,Gajisan RF.pdf|2025-09-02 05:33:24', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(23, '2023', 'MERIT', 'Idolog, Jeana R.', 'ASU-Kalibo', 'BS Civil Engineering', '0939-110-5724', 'Kalibo', '1st', '09/10/2024-VMMP', '01/28/2025-VMMP', '', '', '', '', '', 'Updated', NULL, 'Idolog MJR.pdf|2025-05-23 09:22:41,Idolog MJR.pdf|2025-09-02 05:33:52', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(24, '2023', 'RA 7687', 'Jimenez, Christian Glenn O.', 'ASU-Kalibo', 'BS Information Technology', '0915-0861-546', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Jimenez CGO.pdf|2025-05-23 09:27:28,JImenez CGO.pdf|2025-09-02 05:34:16', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(25, '2023', 'RA 7687', 'Mallorca, Jasmine Lee B.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0950-996-0486', 'Iloilo', '-', '08/16/2024-PPD', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Mallorca JLB.pdf|2025-05-23 09:27:46,Mallorca JLB.pdf|2025-09-02 05:34:30', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(26, '2023', 'RA 7687', 'Punzal, Jenina Mickaela A.', 'ASU-Banga', 'BSED Mathematics', '0921-988-2101', 'Kalibo', '1st', '08/20/2024-ERRP', '02/06/2025-ERRP', '-', '-', '-', '-', '-', 'Updated', NULL, 'Punzal JMA.pdf|2025-05-23 09:28:17,Punzal JMA.pdf|2025-09-02 05:34:47', NULL, NULL, 'Punzal JMA_updated cog.pdf|2025-05-23 09:28:17', '2025-05-23 09:28:17', 'active'),
(27, '2023', 'RA 7687', 'Rario, James Lyster D.', 'ASU-Kalibo', 'BS Civil Engineering', '0961-807-0072', 'New Washington', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, '2025-03-04-Rario-James-Lyster.pdf|2025-05-23 09:28:42,Rario JLD.pdf|2025-09-02 05:35:03', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(28, '2023', 'RA 7687', 'Reforma, Vince Jesther L.', 'ASU-Kalibo', 'BS Civil Engineering', '0951-215-2035', 'Banga', '1st', '9/17/2024-ARS', '-', '-', '-', '-', '-', 'Did not submit requirements last semester 2024-2025', 'Problematic', NULL, 'Reforma VJL.pdf|2025-09-02 05:35:21', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(29, '2023', 'RA 7687', 'Remon, Norielyn T.', 'ASU-Banga', 'BS Biology', '0908-786-7149', 'Tangalan', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Remon NJ.pdf|2025-05-23 09:46:53,Remon NT.pdf|2025-09-02 05:35:44', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(30, '2023', 'RA 7687', 'Salido, AJ J.', 'ASU-Banga', 'BS Biology', '0970-513-5475', 'Ibajay', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', 'Updated', NULL, 'Salido AJ.pdf|2025-05-23 09:50:47,Salido AJ.pdf|2025-09-02 05:35:59', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(31, '2023', 'RA 7687', 'Vedeo, Aljon Charles R.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-801-9520', 'New Washington', '1st', '09/09/2024-IAS', '-', '-', '-', '-', '-', '-', 'Updated', NULL, '2025-02-25-Vedeo-Aljon Charles.pdf|2025-05-23 09:51:21,Vedeo ACR.pdf|2025-09-02 05:36:15', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
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
(64, '2024', 'RA 10612-JLSS', 'Guevarra, Shainah Joyce N.', 'ASU-Kalibo', 'BS Civil Engineering', '0916-5353-757', 'Kalibo', '1st', '-', '02/06/2025-ERRP', '-', '-', '-', '-', 'Did not submit requirements last semester 2024-2025', 'Problematic', NULL, 'Guevarra SJN.pdf|2025-09-02 07:13:12,Guevarra SJN_summer.pdf|2025-09-02 07:13:12', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
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
(93, '2025', 'RA 7687', 'Alcaraz, Christine Mabel C. ', 'ASU-Banga', 'BSEd Science', '0930-133-0199', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', '2025', 'Alcaraz CIC.pdf|2026-04-08 11:02:01', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(94, '2025', 'RA 10612-JLSS', 'Belga, Zyryl Jeff C.', 'ASU-Kalibo', 'BS Civil Engineering', '0906-046-3322', 'Malay', '2nd', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Belga ZJC.pdf|2026-04-08 11:16:45', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(95, '2025', 'RA 7687', 'Degracia, Mark Yuri A.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0995-367-9567', 'Roxas City', '-', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Degracia MYA.pdf|2026-04-08 11:33:55', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(96, '2025', 'RA 7687-JLSS', 'Dela Vega, Cherie Ann I.', 'ASU-Kalibo', 'BS Civil Engineering', '0946-317-6649', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Dela Vega CAI.pdf|2026-04-08 11:38:07', NULL, NULL, '', '0000-00-00 00:00:00', 'active'),
(97, '2025', 'RA 7687-JLSS', 'raiza', 'ASU-Kalibo', 'BS Civil Engineering', '0946-317-6649', 'Kalibo', '1st', NULL, NULL, '', NULL, '', '', '', 'Updated', NULL, 'Alejandro, LN.pdf|2026-04-14 03:13:46', NULL, NULL, '', '0000-00-00 00:00:00', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scholars`
--
ALTER TABLE `scholars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scholars`
--
ALTER TABLE `scholars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
