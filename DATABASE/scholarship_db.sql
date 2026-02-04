-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 07:46 AM
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
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`, `fullname`, `address`, `phone`, `email`) VALUES
(1, 'admin', 'admin', 'Mr. Admin', 'Kalibo', '09814833003', 'admin@gmail.com');

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
  `periodic_requirements` text NOT NULL,
  `periodic_requirements_filename` text DEFAULT NULL,
  `periodic_requirements_upload_date` datetime DEFAULT NULL,
  `updated_cog_filename` varchar(255) DEFAULT NULL,
  `updated_cog_upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholars`
--

INSERT INTO `scholars` (`id`, `year_of_award`, `scholarship_program`, `name`, `school`, `course`, `contact_no`, `municipality`, `district`, `periodic_requirements_1st_sem`, `periodic_requirements_2nd_sem`, `summer`, `updated_cog`, `delayed_requirements`, `lacking_requirements`, `remarks`, `status`, `periodic_requirements`, `periodic_requirements_filename`, `periodic_requirements_upload_date`, `updated_cog_filename`, `updated_cog_upload_date`) VALUES
(1, '2019', 'RA 7687', 'Caberte, Artemio Jr. C.', 'ASU-Banga', 'Vet. Med.', '0907-978-5820', 'Bacolod City', '-', '', '', '-', 'uploads/COG - Caberte - Artemio Jr., C..pdf', '09/10/2024-ERRP;10/01/24-MDV', '2nd Sem SY 2023-2024', 'ok submitted - 11/07/2024-ERRP', 'Ongoing', '1st sem periodic Requirements - Caberte - Artemio Jr. - C..pdf|2025-03-12 04:24:14,2nd sem periodic Requirements - Caberte Artemio Jr. C..pdf|2025-03-12 04:40:14,vxvxd.pdf|2025-03-31 07:26:58', '2nd sem periodic Requirements_Caberte, Artemio Jr. C._03-11-2025.pdf', '2025-03-11 09:21:13', 'COG - Caberte - Artemio Jr., C..pdf', '2025-03-12 04:38:33'),
(2, '2019', 'RA 7687', 'Nicodemus, Jacinth Andrea Y.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0946-216-9619', 'Numancia', '2nd', '-', '-', '-', '-', '-', '1st & 2nd Sem SY 2022-2023;1st & 2nd Sem SY 2023-2024', 'ok submitted - 11/06/2024 - VMMP; 1st & 2nd sem 2021-2022 - submitted 11/15/2024 JVG', ' ', '', NULL, NULL, NULL, NULL),
(3, '2019', 'RA 7687', 'Magsael, Nina Blaise C.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0910-313-1281', 'Numancia', '1st', '-', '-', '-', '-', '-', '1st & 2nd Sem SY 2022-2023;1st & 2nd Sem SY 2023-2024', 'To check if will continue scholarship, no update from the scholar', ' ', '', NULL, NULL, NULL, NULL),
(4, '2019', 'RA 7687', 'Panaligan, Ma. Jocelyn D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0905-602-1270', 'Bacolod City', '-', '', '-', '-', '-', '-', '2nd Sem SY 2022-2023;1st & 2nd Sem SY 2023-2024', 'ok submitted - 11/06/2024 - VMMP', ' ', '', NULL, NULL, NULL, NULL),
(5, '2020', 'RA 7687', 'Magsisi, Cassandra Jade', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0976-287-0771', 'Kalibo', '1st', '-', '-', '-', '-', '09/02/2024-VMMP', '2nd Sem SY 2023-2024', 'ok submitted - 10/17/2024 -JVG', ' ', '', NULL, NULL, NULL, NULL),
(6, '2021', 'RA 7687', 'Apolonio, Glea May M.', 'ASU-Kalibo', 'BS Civil Engineering', '0969-034-1883', 'Lezo', '2nd ', '08/05/2024-VMMP', '02/03/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(7, '2021', 'MERIT', 'Ibit, Marafe Genaen B.', 'ASU-Banga', 'BS Biology', '0918-567-3248', 'New Washington', '1st', '7/29/2024-JVG', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(8, '2021', 'RA 7687', 'Vicente, Cheska Mae A.', 'ASU-Banga', 'BS Biology', '0951-275-7152', 'Other Region', '-', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(9, '2022', 'RA 7687', 'Castor, Steffilane R.', 'ASU-Banga', 'BS Biology', '0912-941-3170', 'Banga', '1st', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(10, '2022', 'RA 7687', 'De Joseph, Mayvilyn C.', 'ASU-Banga', 'BS Biology', '0908-127-9001', 'Makato', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(11, '2022', 'RA 7687', 'Igtanloc, Christy Michelle H.', 'ASU-Kalibo', 'BS Information Technology', '0912-752-8406', 'Numancia', '2nd', '08/29/2024-IAS', '01/28/2025-VMMP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(12, '2022', 'RA 7687', 'Kaindoy, Lian Patrice D.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0938-821-0782', 'Kalibo', '1st', '09/16/2024-AUD', '-', '-', '-', '07/20/2024-JVG', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(13, '2022', 'RA 7687', 'Quime, Harvey B.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-262-0315', 'Banga', '1st', '08/15/2024-AUD', '01/24/2025-ARS', '-', '-', '09/30/2024-ARS', '2nd Sem SY 2023-2024', 'ok Submitted - 10/14/24 VMMP', ' ', '', NULL, NULL, NULL, NULL),
(14, '2022', 'RA 7687', 'Recelestino, Nikki S.', 'ASU-Banga', 'BSED Mathematics', '0961-945-0599', 'Malinao', '2nd', '09/06/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(15, '2022', 'RA 7687', 'Rivero, Aicalyn Kyle Z.', 'ASU-Banga', 'BS Biology', '0956-263-0466', 'Malay', '2nd', '07/24/2024-ERRP', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(16, '2022', 'MERIT', 'Solidum, Rafaella I.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '-', 'Other Region', '-', '-', '-', '-', '-', '-', '2nd Sem SY 2022-2023;1st & 2nd Sem SY 2023-2024', 'Not sure where she submits her requirements', ' ', '', NULL, NULL, NULL, NULL),
(17, '2023', 'RA 7687', 'Araza, Paul Angelo B.', 'ASU-Kalibo', 'BS Civil Engineering', '0999-864-2835', 'Altavas', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(18, '2023', 'RA 7687', 'Arboleda, Steven John C.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-755-6554', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(19, '2023', 'RA 7687', 'Borreros, Jeriah M.', 'ASU-Kalibo', 'BS Civil Engineering', '0905-662-8176', 'Kalibo', '1st', '08/30/2024-JVG', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(20, '2023', 'RA 7687', 'Chu, John Lloyd R.', 'ASU-Kalibo', 'BS Civil Engineering', '0981-494-3113', 'Banga', '1st', '09/09/2024-JVG', '02/07/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(21, '2023', 'RA 7687', 'Crisostomo, Lance Kirby C.', 'ASU-Kalibo', 'BS Civil Engineering', '0970-095-4650', 'Kalibo', '1st', '08/29/2024-IAS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(22, '2023', 'RA 7687', 'Gajisan, Ryan F.', 'ASU-Kalibo', 'BS Information Technology', '0916-322-0466', 'Malay', '2nd', '09/05/2024-JVG', '02/10/2025-VMMP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(23, '2023', 'MERIT', 'Idolog, Jeana R.', 'ASU-Kalibo', 'BS Civil Engineering', '0939-110-5724', 'Kalibo', '1st', '09/10/2024-VMMP', '01/28/2025-VMMP', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL),
(24, '2023', 'RA 7687', 'Jimenez, Christian Glenn O.', 'ASU-Kalibo', 'BS Information Technology', '0915-0861-546', 'Kalibo', '1st', '09/11/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(25, '2023', 'RA 7687', 'Mallorca, Jasmine Lee B.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0950-996-0486', 'Iloilo', '-', '08/16/2024-PPD', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(26, '2023', 'RA 7687', 'Punzal, Jenina Mickaela A.', 'ASU-Banga', 'BSED Mathematics', '0921-988-2101', 'Kalibo', '1st', '08/20/2024-ERRP', '02/06/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(27, '2023', 'RA 7687', 'Rario, James Lyster D.', 'ASU-Kalibo', 'BS Civil Engineering', '0961-807-0072', 'New Washington', '1st', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(28, '2023', 'RA 7687', 'Reforma, Vince Jesther L.', 'ASU-Kalibo', 'BS Civil Engineering', '0951-215-2035', 'Banga', '1st', '9/17/2024-ARS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(29, '2023', 'RA 7687', 'Remon, Norielyn T.', 'ASU-Banga', 'BS Biology', '0908-786-7149', 'Tangalan', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(30, '2023', 'RA 7687', 'Salido, AJ J.', 'ASU-Banga', 'BS Biology', '0970-513-5475', 'Ibajay', '2nd', '08/07/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(31, '2023', 'RA 7687', 'Vedeo, Aljon Charles R.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-801-9520', 'New Washington', '1st', '09/09/2024-IAS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(32, '2023', 'RA 7687', 'Villarias, John  Germel Paul M.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0976-139-1767', 'Makato', '2nd', '07/26/2024-ERRP', '02/07/2025-ERRP', '-', '08/09/2024-VMMP', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(33, '2023', 'RA 7687-JLSS', 'Espiritu, Rico Jay G.', 'ASU-Banga', 'BS Biology', '0998-156-2774', 'Tangalan', '2nd', '11/18/24-VMMP', '1/23/2025-ERRP', '07/25/2024-JVG', '-', '-', '-', '-', 'Ongoing', '', NULL, NULL, '', '0000-00-00 00:00:00'),
(34, '2023', 'RA 7687-JLSS', 'Tampos, Genevieve Marie B.', 'ASU-Banga', 'BSED Mathematics', '0966-162-7922', 'Tangalan', '2nd', '08/14/2024-JVG', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(35, '2023', 'RA 7687-JLSS', 'Melgar, Danielle R.', 'ASU-Banga', 'BS Biology', '0915-022-3888', 'Kalibo', '1st', '08/15/2024-ERRP', '02/06/2025-ERRP', '07/24/2024-IAS', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(36, '2023', 'MERIT-JLSS', 'Roldan, Avelina Jhones L.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0908-1279-512', 'Buruanga', '2nd', '08/02/2024-PPD', '-', '-', '11/15/2024 - JVG', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(37, '2023', 'MERIT-JLSS', 'Briones, Errold Francis R.', 'ASU-Banga', 'BS Biology', '0950-271-6218', 'Makato', '2nd', '08/19/2024-IAS', '01/23/2025-MDV', '07/26/2024-ERP', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(38, '2023', 'RA 10612-JLSS', 'Baladjay, Jerlie Mae C.', 'ASU-Banga', 'BSED Mathematics', '0916-226-3655', 'Nabas', '2nd', '8/14/2024-JVG', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(39, '2023', 'RA 10612-JLSS', 'Luces, Elmo C.', 'ASU-Banga', 'BSED Mathematics', '0947-531-3497', 'Malay', '2nd', '08/14/2024-JVG', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(40, '2023', 'RA 10612-JLSS', 'Narciso, Mark Neil R.', 'ASU-Banga', 'BSED Mathematics', '0960-676-3591', 'Malinao', '2nd', '08/13/2024-ARS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(41, '2023', 'RA 10612-JLSS', 'Zacarias, Prince Nicole N.', 'ASU-Banga', 'BSED Science', '0938-845-0154', 'Kalibo', '1st', '08/06/2024-ERRP', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(42, '2023', 'RA 10612-JLSS', 'Zorca, Bhea Mae N.', 'ASU-Banga', 'BSED Mathematics', '0966-276-6077', 'Kalibo', '1st', '08/14/2024-JVG', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(43, '2023', 'RA 7687', 'Esto Naeden Lyn L.', 'ASU-Kalibo', 'BS Information Technology', '0966-184-3782', 'New Washington', '1st', '08/19/2024-IAS', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(44, '2024', 'RA 7687', 'Barte, Zara J.', 'ASU-Kalibo', 'BS Information Technology', '0927-877-9625', 'Balete', '1st', '-', '01/24/2025-ARS', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(45, '2024', 'MERIT', 'Bautista, Mark Andrew M.', 'ASU-Kalibo', 'BS Civil Engineering', '0906-455-8806', 'Antique', '-', '-', '01/27/2025-AUD', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(46, '2024', 'RA 7687', 'Bautista, Ramon Chito M.', 'ASU-Banga', 'BS Biology', '0966-985-1287', 'Ibajay', '2nd', '-', '1/28/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(47, '2024', 'MERIT', 'Casimero, Mehlcon D.', 'ASU-Kalibo', 'BS Information Technology', '0945-490-8465', 'Kalibo', '1st', '-', '1/24/2025-ARS', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(48, '2024', 'MERIT', 'Cichon, Chad Cromwell E.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-149-1371', 'Kalibo', '1st', '-', '1/27/2025-AUD', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(49, '2024', 'RA 7687', 'Dionzon, Christine A.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0977-451-8211', 'Banga', '1st', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(50, '2024', 'RA 7687', 'Molo, Aron Job T.', 'ASU-Kalibo', 'BS Civil Engineering', '0970-643-9118', 'Tangalan', '2nd', '-', '01/17/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(51, '2024', 'RA 7687', 'Ocampo, Miguel Pauley O.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-801-6626', 'Kalibo', '1st', '-', '01/14/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(52, '2024', 'RA 7687', 'Pelayo, Jeric Q.', 'ASU-Kalibo', 'BS Civil Engineering', '0963-428-8596', 'Kalibo', '1st', '-', '01/14/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(53, '2024', 'RA 7687', 'Placio, Sean Ronels R.', 'ASU-Banga', 'BS Applied Mathematics', '0963-988-4337', 'Ibajay', '2nd', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(54, '2024', 'RA 7687', 'Tandog, Andrea A.', 'ASU-Kalibo', 'BS Civil Engineering', '0915-500-8911', 'Romblon', '-', '-', '01/15/2025-ERRP', '02/04/2025-IAS', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(55, '2024', 'RA 7687', 'Tandog, Ken Vincent T.', 'ASU-Kalibo', 'BS Civil Engineering', '0985-081-0032', 'Tangalan', '2nd', '-', '02/04/2025-IAS', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(56, '2024', 'RA 7687', 'Verangel, Lareign V.', 'ASU-Banga', 'BS Food Technology', '0916-626-0285', 'Kalibo', '1st', '-', '01/31/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(57, '2024', 'RA 7687', 'Vergara, Eurecka Yzabel M.', 'ASU-Kalibo', 'BS Civil Engineering', '0956-470-9675', 'Ibajay', '2nd', '-', '01/15/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(58, '2024', 'RA 7687', 'Villanueva, Juris Marie M.', 'ASU-Banga', 'BS Biology', '0938-884-9736', 'Kalibo', '1st', '-', '01/30/2025-IAS', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(59, '2024', 'MERIT', 'Yuson, Jaimz Neathann B.', 'ASU-Kalibo', 'BS Civil Engineering', '0948-095-7736', 'Numancia', '2nd', '-', '01/15/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(60, '2024', 'MERIT', 'Italia, Beanne Rexannie I.', 'ASU-Banga', 'Doctor of Veterinary Medicine', '0977-3137-905', 'Iloilo', '-', '-', '01/23/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(61, '2024', 'RA 10612-JLSS', 'Ambay, Edilmarc M.', 'ASU-Banga', 'BS Biology', '0963-0400-760', 'Ibajay', '2nd', '-', '01/23/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(62, '2024', 'RA 7687 - JLSS', 'Arcenio, Kate  Jasmine S.', 'ASU-Banga', 'BS Biology', '0966-8400-619', 'Numancia', '2nd', '-', '1/23/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(63, '2024', 'MERIT - JLSS', 'Castillo, Jujen O.', 'ASU-Banga', 'BSED Mathematics', '0920-2808-173', 'Kalibo', '1st', '', '02/06/2025- ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(64, '2024', 'RA 10612-JLSS', 'Guevarra, Shainah Joyce N.', 'ASU-Kalibo', 'BS Civil Engineering', '0916-5353-757', 'Kalibo', '1st', '-', '02/06/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(65, '2024', 'MERIT - JLSS', 'Sanglitan, Evar, Jr. I.', 'ASU-Ibajay', 'BS Computer Science', '0908-2825-497', 'Tangalan', '2nd', '-', '-', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(66, '2024', 'RA 7687 - JLSS', 'Valle, Jay Mark O.', 'ASU-Banga', 'BS Biology', '0930-848-7542', 'Kalibo', '1st', '-', '01/21/2025-JVG', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(67, '2024', 'RA 10612-JLSS', 'Verangel, Niño Janre V.', 'ASU-Kalibo', 'BS Information Technology', '0970-230-1501', 'Kalibo', '1st', '-', '01/30/2025-IAS', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL),
(68, '2024', 'RA 7687-JLSS', 'Viray, Daniella P.', 'ASU-Banga', 'BSED Science', '0912-5179-633', 'Lezo', '2nd', '-', '02/03/2025-ERRP', '-', '-', '-', '-', '-', ' ', '', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholars`
--
ALTER TABLE `scholars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scholars`
--
ALTER TABLE `scholars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
