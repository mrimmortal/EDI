-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2019 at 11:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident_list`
--

CREATE TABLE `incident_list` (
  `incident_id` int(255) DEFAULT NULL,
  `logged_time` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_sla_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workgroup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptom` text COLLATE utf8mb4_unicode_ci,
  `pending_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution_deadline` datetime DEFAULT NULL,
  `resolution_violation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mttr` float DEFAULT NULL,
  `new` int(11) DEFAULT NULL,
  `workflow_error` int(11) DEFAULT NULL,
  `age_old` int(11) DEFAULT NULL,
  `bucket_age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incident_list`
--

INSERT INTO `incident_list` (`incident_id`, `logged_time`, `status`, `caller`, `remaining_sla_time`, `workgroup`, `assigned_to`, `updated_time`, `priority`, `symptom`, `pending_reason`, `resolution_deadline`, `resolution_violation`, `sla`, `mttr`, `new`, `workflow_error`, `age_old`, `bucket_age`) VALUES
(202609, '2019-01-31 21:48:45', 'In-Progress', 'Chavez, Carlos [Juarez]', NULL, 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-02-01 05:21:34', 'P4 - Low', 'EDI not showing on SAP', NULL, '2019-02-05 21:48:45', NULL, 'MXJZ - Juarez Working SLA Window', 0.31, 1, 0, 40, 'more than 9 days'),
(191802, '2019-01-15 01:00:46', 'Pending', 'Whaval, Nikhil', ' 0 Dy, 12 Hr, 10 Mi', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 05:17:24', 'P4 - Low', 'Invoices has not been success...', 'User Response Awaited', NULL, NULL, '9/5 Support', 15.18, 1, 0, 57, 'more than 9 days'),
(189693, '2019-01-11 00:26:11', 'Pending', 'Swarup, Rahul (Wipro)', ' 1 Dy, 21 Hr, 0 Mi', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-22 20:16:08', 'P4 - Low', 'INVALID_LOCATION for HARMAN M...', 'User Response Awaited', NULL, NULL, 'INPU - Pune (WT) Working SLA Window', 11.83, 1, 0, 61, 'more than 9 days'),
(201233, '2019-01-29 22:06:16', 'Resolved', 'Mercado, Francisca', ' 0 Dy, 19 Hr, 44 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-30 21:20:41', 'P4 - Low', 'UPDATE EDI EMAIL CONFIRMATION...', NULL, '2019-02-01 23:03:16', 'No', 'USEP - El Paso Working SLA Window', 0.97, 1, 0, 42, 'more than 9 days'),
(200675, '2019-01-29 03:14:21', 'Resolved', 'Degroot, Craig', NULL, 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-30 15:15:07', 'P4 - Low', 'IDoc number 113825375 does n...', NULL, '2019-02-02 01:44:00', 'No', 'USFR - Franklin Working SLA Window', 1.5, 1, 0, 43, 'more than 9 days'),
(199381, '2019-01-26 02:36:09', 'Resolved', 'Velazquez, Cesar', ' 0 Dy, 20 Hr, 14 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-30 20:57:46', 'P4 - Low', 'problem with the EDI', NULL, '2019-02-01 20:03:00', 'No', 'MXQT - Queretaro Working SLA Window', 4.77, 1, 0, 46, 'more than 9 days'),
(198811, '2019-01-25 03:05:58', 'Closed', 'Patil, Yashashree', ' 0 Dy, 18 Hr, 1 Mi', 'DevOps-EDI', 'Ansari, Salman (Cybertech)', '2019-01-26 00:00:24', 'P4 - Low', 'Other - In and Out - partner ...', NULL, '2019-01-30 09:03:00', 'No', '9/5 Support', 0.87, 1, 1, 47, 'more than 9 days'),
(197088, '2019-01-23 21:44:16', 'Closed', 'Patil, Yashashree', ' 0 Dy, 23 Hr, 58 Mi', 'DevOps-EDI', 'Dakuri, Vinay Kumar (Cybertech)', '2019-01-24 12:02:40', 'P4 - Low', 'Others - OUT-partner error Re...', NULL, '2019-01-29 09:03:00', 'No', '9/5 Support', 0.6, 1, 1, 48, 'more than 9 days'),
(195668, '2019-01-21 23:59:19', 'Resolved', 'Moolya, Sachin (Wipro)', ' 0 Dy, 14 Hr, 44 Mi', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 00:30:42', 'P4 - Low', 'Unacknowleged invoices', NULL, '2019-01-31 21:11:19', 'No', 'USNR - Northridge Working SLA Window', 8.02, 1, 0, 50, 'more than 9 days'),
(195612, '2019-01-21 21:45:59', 'Closed', 'Brown, Aaron', ' 0 Dy, 18 Hr, 21 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-23 16:23:18', 'P4 - Low', 'Toyota TMMI INVOIC workflow i...', NULL, '2019-01-25 01:44:59', 'No', 'USMV - Mountain View Working SLA Window', 1.78, 1, 0, 50, 'more than 9 days'),
(195549, '2019-01-21 20:00:47', 'Closed', 'Patil, Yashashree', ' 0 Dy, 23 Hr, 36 Mi', 'DevOps-EDI', 'Dakuri, Vinay Kumar (Cybertech)', '2019-01-22 12:24:11', 'P4 - Low', 'Volkswagen Brazil - OUT-partn...', NULL, '2019-01-25 09:03:00', 'No', '9/5 Support', 0.68, 1, 1, 50, 'more than 9 days'),
(194052, '2019-01-18 15:08:32', 'Closed', 'Sajtos, Sandor', ' 0 Dy, 4 Hr, 4 Mi', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-22 17:38:08', 'P4 - Low', 'EDI processing problem', NULL, '2019-01-22 21:40:32', 'No', 'HUSZ - Szekesfehervar Working SLA Window', 4.1, 1, 0, 53, 'more than 9 days'),
(193577, '2019-01-17 20:53:57', 'Closed', 'Patil, Yashashree', ' 1 Dy, 0 Hr, 29 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-18 11:31:35', 'P4 - Low', 'SHIBUSAWA - Out - partner err...', NULL, '2019-01-23 09:03:00', 'No', '9/5 Support', 0.61, 1, 1, 54, 'more than 9 days'),
(193013, '2019-01-16 22:13:29', 'Closed', 'Patil, Yashashree', ' 0 Dy, 9 Hr, 2 Mi', 'DevOps-EDI', 'Ansari, Salman (Cybertech)', '2019-01-19 01:40:46', 'P4 - Low', 'DSV - Out - partner error Rep...', NULL, '2019-01-22 09:03:00', 'No', '9/5 Support', 2.14, 1, 1, 55, 'more than 9 days'),
(192769, '2019-01-16 15:39:31', 'Closed', 'Patil, Yashashree', ' 1 Dy, 0 Hr, 40 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-16 20:07:16', 'P4 - Low', 'APL Hong Kong - Out - partner...', NULL, '2019-01-21 15:42:31', 'No', '9/5 Support', 0.19, 1, 1, 55, 'more than 9 days'),
(192768, '2019-01-16 15:38:57', 'Closed', 'Patil, Yashashree', ' 1 Dy, 1 Hr, 15 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-16 17:23:09', 'P4 - Low', 'Renault Revoz GXS SLMP AS2 - ...', NULL, '2019-01-21 15:41:57', 'No', '9/5 Support', 0.07, 1, 1, 55, 'more than 9 days'),
(192765, '2019-01-16 15:38:25', 'Closed', 'Patil, Yashashree', ' 1 Dy, 1 Hr, 15 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-16 17:23:08', 'P4 - Low', 'SHIBUSAWA - Out - partner err...', NULL, '2019-01-21 15:41:25', 'No', '9/5 Support', 0.07, 1, 1, 55, 'more than 9 days'),
(192489, '2019-01-16 05:59:11', 'Closed', 'Patil, Yashashree', ' 0 Dy, 23 Hr, 18 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-16 12:42:23', 'P4 - Low', 'Ryder3PL - OUT-partner error ...', NULL, '2019-01-21 09:03:00', 'No', '9/5 Support', 0.28, 1, 1, 55, 'more than 9 days'),
(192449, '2019-01-16 03:08:15', 'Closed', 'Perez, Daniel', ' 0 Dy, 9 Hr, 7 Mi', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-18 03:01:17', 'P4 - Low', 'Missing ASN for Kohls D/N#803...', NULL, '2019-01-19 03:08:15', 'No', 'USNR - Northridge Working SLA Window', 2, 1, 0, 56, 'more than 9 days'),
(191464, '2019-01-14 15:31:53', 'Closed', 'Patil, Yashashree', ' 1 Dy, 1 Hr, 36 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-14 16:55:48', 'P4 - Low', 'FLYJAC-OUT- partner error Rep...', NULL, '2019-01-17 15:34:53', 'No', '9/5 Support', 0.06, 1, 1, 57, 'more than 9 days'),
(190330, '2019-01-11 22:20:34', 'Closed', 'Resendiz, Jonathan', ' 0 Dy, 21 Hr, 3 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-16 21:13:30', 'P4 - Low', 'Confirm that Sold To/Ship To ...', NULL, '2019-01-18 21:25:34', 'No', 'MXQT - Queretaro Working SLA Window', 4.95, 1, 0, 60, 'more than 9 days'),
(190286, '2019-01-11 20:56:59', 'Closed', 'Patil, Yashashree', ' 0 Dy, 19 Hr, 5 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-14 16:55:47', 'P4 - Low', 'Others - OUT-partner error Re...', NULL, '2019-01-17 09:03:00', 'No', '9/5 Support', 2.83, 1, 1, 60, 'more than 9 days'),
(189701, '2019-01-11 00:46:29', 'Closed', 'Jadhav, Nitesh (Wipro)', ' 0 Dy, 22 Hr, 16 Mi', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-12 00:20:55', 'P4 - Low', 'UNACK PROD EDI DOCUMENT AAFES...', NULL, '2019-01-16 04:36:29', 'No', 'USNR - Northridge Working SLA Window', 0.98, 1, 0, 61, 'more than 9 days'),
(189623, '2019-01-10 21:00:41', 'Closed', 'Patil, Yashashree', ' 0 Dy, 20 Hr, 9 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-11 15:51:23', 'P4 - Low', 'Flyjack India Outbound SFTP -...', NULL, '2019-01-16 09:03:00', 'No', '9/5 Support', 0.79, 1, 1, 61, 'more than 9 days'),
(189621, '2019-01-10 20:59:44', 'Closed', 'Patil, Yashashree', ' 0 Dy, 20 Hr, 9 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-11 15:51:23', 'P4 - Low', 'Flyjack India China Inbound S...', NULL, '2019-01-16 09:03:00', 'No', '9/5 Support', 0.79, 1, 1, 61, 'more than 9 days'),
(189620, '2019-01-10 20:58:10', 'Closed', 'Patil, Yashashree', ' 0 Dy, 20 Hr, 9 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-11 15:51:22', 'P4 - Low', 'FLYJAC - OUT-partner error Re...', NULL, '2019-01-16 09:03:00', 'No', '9/5 Support', 0.79, 1, 1, 61, 'more than 9 days'),
(189440, '2019-01-10 15:59:29', 'Closed', 'Beke, Zoltan', ' 0 Dy, 15 Hr, 43 Mi', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-11 16:46:35', 'P4 - Low', 'URGENT(!) - general issue in ...', NULL, '2019-01-14 21:59:29', 'No', 'HUSZ - Szekesfehervar Working SLA Window', 1.03, 1, 0, 61, 'more than 9 days'),
(189098, '2019-01-10 04:48:55', 'Closed', 'Ruiz, Silvana', ' 0 Dy, 17 Hr, 18 Mi', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-11 23:01:40', 'P4 - Low', 'Target PO not transmitted to ...', NULL, '2019-01-15 22:07:55', 'No', 'USNR - Northridge Working SLA Window', 1.76, 1, 0, 62, 'more than 9 days'),
(189085, '2019-01-10 03:44:53', 'Closed', 'Hutchinson, Michelle', ' 0 Dy, 20 Hr, 9 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-11 15:51:22', 'P4 - Low', 'Paradies - Harman Rejections-...', NULL, '2019-01-16 09:03:00', 'No', '9/5 Support', 1.5, 1, 0, 62, 'more than 9 days'),
(188770, '2019-01-09 19:44:49', 'Closed', 'Patil, Yashashree', ' 0 Dy, 22 Hr, 44 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-10 13:16:23', 'P4 - Low', 'DSV - OUT-partner error Repor...', NULL, '2019-01-15 09:03:00', 'No', '9/5 Support', 0.73, 1, 1, 62, 'more than 9 days'),
(188418, '2019-01-09 12:18:00', 'Closed', 'Patil, Yashashree', ' 1 Dy, 2 Hr, 7 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-09 13:11:06', 'P4 - Low', 'Volkswagen Brazil-IN- partner...', NULL, '2019-01-14 12:21:00', 'No', '9/5 Support', 0.04, 1, 1, 62, 'more than 9 days'),
(188417, '2019-01-09 12:17:17', 'Closed', 'Patil, Yashashree', ' 1 Dy, 2 Hr, 6 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-09 13:11:06', 'P4 - Low', 'Renault Revoz GXS SLMP AS2-IN...', NULL, '2019-01-14 12:20:17', 'No', '9/5 Support', 0.04, 1, 1, 62, 'more than 9 days'),
(188415, '2019-01-09 12:16:26', 'Closed', 'Patil, Yashashree', ' 1 Dy, 2 Hr, 5 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-09 13:11:05', 'P4 - Low', 'Renault Revoz GXS SLMP AS2-IN...', NULL, '2019-01-14 12:19:26', 'No', '9/5 Support', 0.04, 1, 1, 62, 'more than 9 days'),
(188414, '2019-01-09 12:15:47', 'Closed', 'Patil, Yashashree', ' 1 Dy, 0 Hr, 26 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-09 14:49:33', 'P4 - Low', 'Ford USA OEM-IN- partner erro...', NULL, '2019-01-14 12:18:47', 'No', '9/5 Support', 0.11, 1, 1, 62, 'more than 9 days'),
(188116, '2019-01-08 21:10:11', 'Closed', 'Patil, Yashashree', ' 1 Dy, 0 Hr, 4 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-09 11:56:34', 'P4 - Low', 'SHIBUSAWA - OUT-partner error...', NULL, '2019-01-14 09:03:00', 'No', '9/5 Support', 0.62, 1, 1, 63, 'more than 9 days'),
(187784, '2019-01-08 13:28:48', 'Closed', 'Jiang, Paul (Nanyou)', ' 0 Dy, 6 Hr, 58 Mi', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-10 20:04:51', 'P4 - Low', 'HK APL cannot receive any IBD...', NULL, '2019-01-11 13:28:48', 'No', 'CNSN - Shenzhen Working SLA Window', 2.28, 1, 0, 63, 'more than 9 days'),
(186262, '2019-01-04 22:10:47', 'Closed', 'Patil, Yashashree', ' 0 Dy, 23 Hr, 19 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-07 12:41:25', 'P4 - Low', 'UNITED RADIO - Out - partner ...', NULL, '2019-01-10 09:03:00', 'No', '9/5 Support', 2.6, 1, 1, 67, 'more than 9 days'),
(186221, '2019-01-04 20:07:07', 'Closed', 'Patil, Yashashree', ' 0 Dy, 9 Hr, 2 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-08 20:24:54', 'P4 - Low', 'UNITED RADIO - Out - partner ...', NULL, '2019-01-10 09:03:00', 'No', '9/5 Support', 4.01, 1, 1, 67, 'more than 9 days'),
(185727, '2019-01-03 22:06:53', 'Closed', 'Patil, Yashashree', ' 0 Dy, 20 Hr, 4 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-04 15:56:07', 'P4 - Low', 'UNITED RADIO - Out - partner ...', NULL, '2019-01-09 09:03:00', 'No', '9/5 Support', 0.74, 1, 1, 68, 'more than 9 days'),
(185724, '2019-01-03 21:56:05', 'Closed', 'Moolya, Sachin (Wipro)', ' 0 Dy, 15 Hr, 57 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-16 17:24:35', 'P4 - Low', 'Invoices unacknowledged by cu...', NULL, '2019-01-18 21:45:05', 'No', 'USNR - Northridge Working SLA Window', 12.81, 1, 0, 68, 'more than 9 days'),
(185703, '2019-01-03 20:58:07', 'Closed', 'Hutchinson, Michelle', ' 0 Dy, 10 Hr, 58 Mi', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-16 15:01:06', 'P4 - Low', 'QUIBIDS - Missing 850\'s', NULL, '2019-01-17 16:58:00', 'No', '9/5 Support', 12.75, 1, 0, 68, 'more than 9 days'),
(185663, '2019-01-03 19:24:41', 'Closed', 'Patil, Yashashree', ' 0 Dy, 14 Hr, 20 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-07 12:41:24', 'P4 - Low', 'APL Hong Kong - Out - partner...', NULL, '2019-01-09 09:03:00', 'No', '9/5 Support', 3.72, 1, 1, 68, 'more than 9 days'),
(185662, '2019-01-03 19:24:15', 'Closed', 'Patil, Yashashree', ' 0 Dy, 14 Hr, 20 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-07 12:41:23', 'P4 - Low', 'Other - Out - partner error R...', NULL, '2019-01-09 09:03:00', 'No', '9/5 Support', 3.72, 1, 1, 68, 'more than 9 days'),
(185661, '2019-01-03 19:23:51', 'Closed', 'Patil, Yashashree', ' 0 Dy, 14 Hr, 20 Mi', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-07 12:41:22', 'P4 - Low', 'SHENZHEN 434019 LSP - Out - p...', NULL, '2019-01-09 09:03:00', 'No', '9/5 Support', 3.72, 1, 1, 68, 'more than 9 days'),
(185217, '2019-01-03 04:35:54', 'Closed', 'Patil, Yashashree', ' 0 Dy, 21 Hr, 24 Mi', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-03 14:36:18', 'P4 - Low', 'Others-OUT- partner error Rep...', NULL, '2019-01-08 09:03:00', 'No', '9/5 Support', 0.42, 1, 1, 69, 'more than 9 days'),
(185163, '2019-01-03 00:13:28', 'Closed', 'Perez, Daniel', ' 0 Dy, 0 Hr, 18 Mi', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-11 00:57:55', 'P4 - Low', 'N104 in the N1 ST Loop is mis...', NULL, '2019-01-08 00:13:28', 'Yes', 'USNR - Northridge Working SLA Window', 8.03, 1, 0, 69, 'more than 9 days'),
(185162, '2019-01-03 00:12:24', 'Closed', 'Perez, Daniel', ' 0 Dy, 0 Hr, 19 Mi', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-11 00:58:33', 'P4 - Low', 'The document provided was not...', NULL, '2019-01-08 00:12:24', 'Yes', 'USNR - Northridge Working SLA Window', 8.03, 1, 0, 69, 'more than 9 days'),
(183504, '2018-12-28 04:06:16', 'Closed', 'Patil, Yashashree', ' 0 Dy, 5 Hr, 13 Mi', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-02 14:16:49', 'P4 - Low', 'Others - OUT-partner error R...', NULL, '2019-01-02 09:03:00', 'Yes', '9/5 Support', 5.42, 0, 1, 75, 'more than 9 days');

-- --------------------------------------------------------

--
-- Table structure for table `sr_list`
--

CREATE TABLE `sr_list` (
  `sr_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `workgroup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resolution_deadline` datetime DEFAULT NULL,
  `resolution_violation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_up_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mttr` float DEFAULT NULL,
  `new` int(11) DEFAULT NULL,
  `age_old` int(11) DEFAULT NULL,
  `bucket_age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sr_list`
--

INSERT INTO `sr_list` (`sr_id`, `log_time`, `status`, `caller`, `workgroup`, `assigned_to`, `updated_time`, `priority`, `category`, `pending_reason`, `resolution_deadline`, `resolution_violation`, `logged_by`, `follow_up_count`, `description`, `mttr`, `new`, `age_old`, `bucket_age`) VALUES
('SR65809', '2019-01-31 14:34:29', 'Pending', 'Kertesz, Iren', 'DevOps-EDI', 'Ansari, Salman (Cybertech)', '2019-02-01 08:50:10', 'S4', 'SAP SECURITY', 'User Response Awaited', '2019-07-24 10:38:29', NULL, 'Chavhan, Shital', NULL, 'Need to unlock VF31 in PEP for', 0.76, 1, 40, '15-50 days'),
('SR65797', '2019-01-31 14:20:14', 'In-Progress', 'Garg, Ram(Wipro)', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-02-01 12:01:09', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-20 14:34:14', NULL, 'Garg, Ram(Wipro)', NULL, 'pl. create and test the map ch', 0.9, 1, 40, '15-50 days'),
('SR65389', '2019-01-29 21:48:09', 'Pending', 'Galinsky, Karen', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-31 19:50:44', 'EUC-New customer setup', 'EAM-EDI', 'User Response Awaited', '2019-06-06 21:16:09', NULL, 'Hegde, Vijet (CyberTech Syste..', NULL, 'As this issue is taking time t', 1.92, 1, 42, '15-50 days'),
('SR65216', '2019-01-29 14:09:51', 'Pending', 'Novak, Norbert', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-31 15:17:23', 'EUC-New vendor setup', 'EAM-EDI', 'User Response Awaited', '2019-04-24 10:30:51', NULL, 'Novak, Norbert', NULL, 'We have a supplier Future Elec', 2.05, 1, 42, '15-50 days'),
('SR64291', '2019-01-24 03:48:05', 'In-Progress', 'Hutchinson, Michelle', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-02-01 12:01:09', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-13 04:02:05', NULL, 'Hutchinson, Michelle', NULL, 'AAFES: There is an error with', 8.34, 1, 48, '15-50 days'),
('SR64209', '2019-01-23 21:39:52', 'In-Progress', 'Hoffmann, Elise', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-02-01 12:01:09', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-12 21:53:52', NULL, 'Hoffmann, Elise', NULL, 'Please assign this ticket ti C', 8.6, 1, 48, '15-50 days'),
('SR64084', '2019-01-23 15:53:31', 'In-Progress', 'Novak, Norbert', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-02-01 12:01:09', 'EUC-New vendor setup', 'EAM-EDI', NULL, '2019-04-17 16:53:31', NULL, 'Novak, Norbert', NULL, 'Actually different Harman site', 8.84, 1, 48, '15-50 days'),
('SR63602', '2019-01-21 20:00:16', 'In-Progress', 'Deshmukh, Gaurav (CyberTech)', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-02-01 12:01:09', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-08 20:14:16', NULL, 'Deshmukh, Gaurav (CyberTech)', NULL, 'Hi EDI Team, There is requirem', 10.67, 1, 50, '15-50 days'),
('SR63199', '2019-01-18 19:14:17', 'Pending', 'Hutchinson, Michelle', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 03:05:34', 'EUC-Minor EDI Map Change', 'EAM-EDI', 'User Response Awaited', '2019-02-07 19:28:17', NULL, 'Hutchinson, Michelle', NULL, 'MCX: 856 Document Errors', 11.33, 1, 53, '51-70 days'),
('SR63002', '2019-01-17 22:29:50', 'In-Progress', 'Hutchinson, Michelle', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-02-01 12:01:09', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-06 22:43:50', NULL, 'Hutchinson, Michelle', NULL, 'Sports Basement 810 Invoice Fa', 14.56, 1, 54, '51-70 days'),
('SR62763', '2019-01-17 01:58:00', 'Pending', 'Resendiz, Jonathan', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:32:22', 'EUC-New connection', 'EAM-EDI', 'Scheduled Ticket', '2019-02-28 13:39:00', NULL, 'Brown, Aaron', NULL, 'Please block the ASN output pu', 13.52, 1, 55, '51-70 days'),
('SR62751', '2019-01-17 01:09:25', 'Pending', 'Stokes, Jace', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-30 15:43:19', 'EUC-New connection', 'EAM-EDI', 'User Response Awaited', '2019-03-12 20:26:25', NULL, 'Stokes, Jace', NULL, 'Hello, For Ford AVAS Speakers', 13.61, 1, 55, '51-70 days'),
('SR62708', '2019-01-16 20:47:45', 'Pending', 'Gyorffy, Viktoria', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-31 13:27:06', 'S4', 'SAP FICO', 'Vendor Dependency', '2019-07-24 04:22:45', NULL, 'Gyorffy, Viktoria', NULL, 'Hello,I received some rejectio', 14.69, 1, 55, '51-70 days'),
('SR62391', '2019-01-15 19:14:50', 'Pending', 'Gyorffy, Viktoria', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-17 03:52:33', 'S4', 'SAP FICO', 'Scheduled Ticket', '2019-07-09 13:38:50', NULL, 'Gyorffy, Viktoria', NULL, 'Dear Team,Some invoices have b', 1.36, 1, 56, '51-70 days'),
('SR62386', '2019-01-15 18:59:28', 'Pending', 'Gyorffy, Viktoria', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-17 03:28:45', 'S4', 'SAP FICO', 'Scheduled Ticket', '2019-07-09 13:21:28', NULL, 'Gyorffy, Viktoria', NULL, 'Dear Team,Invoice numbers 2093', 1.35, 1, 56, '51-70 days'),
('SR61710', '2019-01-11 13:44:56', 'In-Progress', 'Garg, Ram(Wipro)', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-02-01 12:01:09', 'EUC-New EDI Map', 'EAM-EDI', NULL, '2019-03-04 14:16:56', NULL, 'Garg, Ram(Wipro)', NULL, 'pl. set up payment file with E', 20.93, 1, 60, '51-70 days'),
('SR61471', '2019-01-10 14:56:17', 'In-Progress', 'Qureshi, Shoaib Rajmahamad', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-02-01 12:01:09', 'EUC-New EDI Map', 'EAM-EDI', NULL, '2019-02-21 15:26:17', NULL, 'Qureshi, Shoaib Rajmahamad', NULL, 'Required EDI Connection & ASN', 21.88, 1, 61, '51-70 days'),
('SR60453', '2019-01-06 01:13:15', 'Pending', 'Perez, Daniel', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-30 14:24:53', 'EUC-Minor EDI Map Change', 'EAM-EDI', 'Scheduled Ticket', '2019-01-31 22:58:00', NULL, 'Brenner, Gail', NULL, 'Please extract the must arrive', 24.55, 1, 66, '51-70 days'),
('SR60029', '2019-01-03 01:38:31', 'Pending', 'Hutchinson, Michelle', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:33:02', 'EUC-New EDI Map', 'EAM-EDI', 'Scheduled Ticket', '2019-02-14 13:10:31', NULL, 'Davis, Gregory (Wipro)', NULL, 'We need your support for the n', 27.54, 1, 69, '51-70 days'),
('SR59885', '2019-01-02 15:28:19', 'Pending', 'Hegde, Vijet (CyberTech Syste..', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-31 20:02:53', 'EUC-New vendor setup', 'EAM-EDI', 'Other Team/Group Dependency', '2019-04-19 18:13:19', NULL, 'Hegde, Vijet (CyberTech Syste..', NULL, 'Valens is a supplier requestin', 29.19, 1, 69, '51-70 days'),
('SR57261', '2018-12-12 03:11:11', 'Pending', 'Renick, Debbie', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-23 02:24:17', 'EUC-Master Data', 'SAP SD', 'User Response Awaited', '2019-05-29 05:11:11', NULL, 'Flynn, Sandy', NULL, 'ASN for Chrysler not going thr', 41.97, 0, 91, 'more than 90 days'),
('SR56980', '2018-12-11 03:37:15', 'Pending', 'Richardson, Pam', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:27:04', 'EUC-New vendor setup', 'EAM-EDI', 'Scheduled Ticket', '2019-04-17 16:07:15', NULL, 'Richardson, Pam', NULL, 'Please set up vendor code Sams', 50.45, 0, 92, 'more than 90 days'),
('SR56956', '2018-12-11 00:20:41', 'Pending', 'Hutchinson, Michelle', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:27:41', 'EUC-New connection', 'EAM-EDI', 'Scheduled Ticket', '2019-02-18 03:21:41', NULL, 'Hutchinson, Michelle', NULL, 'Home Depot - EDI Testing and G', 50.59, 0, 92, 'more than 90 days'),
('SR56730', '2018-12-10 13:37:44', 'Pending', 'Garg, Ram(Wipro)', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-31 13:10:25', 'EUC-Minor EDI Map Change', 'EAM-EDI', 'Vendor Dependency', '2019-02-14 05:59:44', NULL, 'Garg, Ram(Wipro)', NULL, 'pl. update the EDI map as per', 51.98, 0, 92, 'more than 90 days'),
('SR53504', '2018-11-22 11:52:42', 'Pending', 'Cai, Suzhen', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-02 18:38:08', 'EUC-New connection', 'EAM-EDI', 'Scheduled Ticket', '2019-02-06 14:51:42', NULL, 'Deshmukh, Gaurav (CyberTech)', NULL, 'To implement ASN via EDI with', 41.28, 0, 110, 'more than 90 days'),
('SR48386', '2018-10-25 13:07:45', 'Pending', 'Ramachandran, Ramesh', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2018-12-10 21:22:53', 'EUC-New connection', 'EAM-EDI', 'Scheduled Ticket', '2019-01-01 16:05:45', NULL, 'Ramachandran, Ramesh', NULL, 'Amazon India has an applicatio', 46.39, 0, 138, 'more than 90 days'),
('SR46003', '2018-10-12 03:10:03', 'Pending', 'Hutchinson, Michelle', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:29:01', 'EUC-New customer setup', 'EAM-EDI', 'Scheduled Ticket', '2019-04-08 16:51:03', NULL, 'Brown, Aaron', NULL, 'System: HCP 850, 856, 810', 110.51, 0, 152, 'more than 90 days'),
('SR44696', '2018-10-06 00:57:09', 'Pending', 'Perez, Daniel', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-18 20:21:40', 'EUC-New EDI Map', 'EAM-EDI', 'Scheduled Ticket', '2019-02-28 09:34:00', NULL, 'Smith, Christopher (Wipro)', NULL, 'All EDI customer generated 997', 104.85, 0, 158, 'more than 90 days'),
('SR43448', '2018-10-01 04:25:02', 'Pending', 'Hutchinson, Michelle', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:30:02', 'EUC-New customer setup', 'EAM-EDI', 'Scheduled Ticket', '2019-02-14 12:50:02', NULL, 'Brenner, Gail', NULL, 'Assign: CyberTech System: HCP', 121.46, 0, 163, 'more than 90 days'),
('SR25051', '2018-06-27 18:39:25', 'Pending', 'Ruiz, Ericka', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 14:30:32', 'EUC-New connection', 'EAM-EDI', 'Scheduled Ticket', '2018-10-23 22:41:25', NULL, 'Brown, Aaron', NULL, 'Atte. Aaron Brown On July 1, 2', 216.87, 0, 258, 'more than 90 days'),
('SR63748', '2019-01-22 14:21:14', 'Resolved', 'Singh, Vinod', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-29 15:21:33', 'S4', 'SAP SCM', NULL, '2019-07-15 10:25:14', 'No', 'Singh, Vinod', NULL, 'Hi CybertechEdisupport,Please', 7.04, 1, 49, '15-50 days'),
('SR63010', '2019-01-17 23:26:05', 'Resolved', 'Brown, Aaron', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-29 11:08:48', 'EUC-New connection', 'EAM-EDI', NULL, '2019-03-08 09:49:05', 'No', 'Brown, Aaron', NULL, 'Please check why the ASN for Y', 11.49, 1, 54, '51-70 days'),
('SR61687', '2019-01-11 12:58:58', 'Closed', 'Qureshi, Shoaib Rajmahamad', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-29 00:00:45', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-05 07:06:58', 'No', 'Qureshi, Shoaib Rajmahamad', NULL, 'EDI for the supplier YAMAICHI', 17.46, 1, 60, '51-70 days'),
('SR61604', '2019-01-11 00:59:47', 'Closed', 'Perez, Daniel', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-19 00:00:15', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-31 01:13:47', 'No', 'Ambati, Shivaram (CyberTech)', NULL, 'Hello, We recently received a', 7.96, 1, 61, '51-70 days'),
('SR61299', '2019-01-09 20:20:47', 'Resolved', 'Hutchinson, Michelle', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-29 15:11:37', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-05 15:08:47', 'No', 'Hutchinson, Michelle', NULL, 'Walmart Supplier AS2 Certifica', 19.79, 1, 62, '51-70 days'),
('SR60429', '2019-01-04 23:41:37', 'Closed', 'Hutchinson, Michelle', 'DevOps-EDI', 'Kokane, Atul (Cybertech)', '2019-01-30 00:00:20', 'S4', 'SAP SECURITY', NULL, '2019-07-15 17:41:37', 'No', 'Davis, Gregory (Wipro)', NULL, 'EDI Team - See attachment for', 25.01, 1, 67, '51-70 days'),
('SR60428', '2019-01-04 23:28:30', 'Resolved', 'Sullivan, Brandon', 'DevOps-EDI', 'Paul, Ishan (Cybertech)', '2019-01-30 03:25:43', 'EUC-Business Process', 'SAP SD', NULL, '2019-07-12 12:40:30', 'No', 'Davis, Gregory (Wipro)', NULL, 'I have a customer that wants t', 25.16, 1, 67, '51-70 days'),
('SR59428', '2018-12-26 14:44:41', 'Closed', 'Resendiz, Jonathan', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-22 00:00:37', 'EUC-New customer setup', 'EAM-EDI', NULL, '2019-05-14 16:08:41', 'No', 'Hegde, Vijet (CyberTech Syste..', NULL, 'Setup the below customers for', 26.39, 0, 76, '71-90 days'),
('SR58861', '2018-12-20 12:23:06', 'Closed', 'Garg, Ram(Wipro)', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-30 00:00:11', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-02-08 08:07:06', 'No', 'Garg, Ram(Wipro)', NULL, 'pl. add below fields in 940 id', 40.48, 0, 82, '71-90 days'),
('SR58510', '2018-12-19 00:49:59', 'Closed', 'Hutchinson, Michelle', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-22 00:00:26', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-28 23:32:59', 'No', 'Hutchinson, Michelle', NULL, 'See attachment. Acct #50637 ha', 33.97, 0, 84, '71-90 days'),
('SR57821', '2018-12-14 15:09:51', 'Closed', 'Cai, Cynthia', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-11 00:00:43', 'EUC-007 Windows Account and Data Share', 'Windows Account', NULL, '2018-12-17 18:10:51', 'Yes', 'Adams, Lela (Wipro)', NULL, 'We have a new supplier. Suppli', 27.37, 0, 88, '71-90 days'),
('SR57215', '2018-12-11 21:38:35', 'Closed', 'Beke, Zoltan', 'DevOps-EDI', 'Gupta, Shubham (Cybertech)', '2019-01-11 00:00:47', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-23 13:17:35', 'No', 'Beke, Zoltan', NULL, 'Dear Gupta request #: please i', 30.1, 0, 91, 'more than 90 days'),
('SR50652', '2018-11-07 05:07:27', 'Closed', 'Teran, Dulce', 'DevOps-EDI', 'Ansari, Salman (Cybertech)', '2019-01-08 00:00:34', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-08 05:20:27', 'No', 'Ansari, Salman (Cybertech)', NULL, 'Analog Devices DESADV FailureA', 61.79, 0, 126, 'more than 90 days'),
('SR49650', '2018-10-31 20:34:28', 'Closed', 'Degroot, Craig', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-30 00:00:21', 'EUC-New vendor setup', 'EAM-EDI', NULL, '2019-04-15 01:27:28', 'No', 'Hegde, Vijet (CyberTech Syste..', NULL, 'Setup EDI subsystem for Custom', 90.14, 0, 132, 'more than 90 days'),
('SR48154', '2018-10-24 13:41:38', 'Closed', 'Hutchinson, Michelle', 'DevOps-EDI', 'Ambati, Shivaram (CyberTech)', '2019-01-18 00:01:18', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-15 02:32:38', 'No', 'Patil, Yashashree', NULL, 'System HCP KOHLS sent the orde', 85.47, 0, 139, 'more than 90 days'),
('SR45339', '2018-10-10 02:53:16', 'Closed', 'Galinsky, Karen', 'DevOps-EDI', 'Hegde, Vijet (CyberTech Systems)', '2019-01-29 00:00:50', 'EUC-New connection', 'EAM-EDI', NULL, '2019-02-28 08:16:16', 'No', 'Brown, Aaron', NULL, 'We currently have SAP set up f', 110.92, 0, 154, 'more than 90 days'),
('SR43197', '2018-09-28 12:55:11', 'Closed', 'Perez, Daniel', 'DevOps-EDI', 'Deshmukh, Gaurav (CyberTech)', '2019-01-18 00:00:52', 'EUC-Minor EDI Map Change', 'EAM-EDI', NULL, '2019-01-31 01:41:11', 'No', 'Patil, Yashashree', NULL, 'Please up-date our AS2 certifi', 111.5, 0, 165, 'more than 90 days'),
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 17968, 'more than 90 days');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
