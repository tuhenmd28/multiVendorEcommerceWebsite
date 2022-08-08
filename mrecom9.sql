-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 07:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrecom9`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md Mehedi Hasan', 'admin', 0, '01831853648', 'superadmin@gmail.com', '$2a$12$o0YIdNcpFJJqH5YGC4iml..25fS.3tT2y0YA12Vg4qdEZkIEXYSJu', '1656603192.jpg', 1, NULL, '2022-08-04 23:50:43'),
(2, 'Md Tuhen', 'vendor', 1, '01848494809', 'tuhen@gmail.com', '$2a$12$YLPTPt9mUv59Mm4encdbK.OFi58JjdX7iDGP8g0HyEJkmVpSRL77.', '1658459120.jpg', 1, NULL, '2022-07-28 11:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_discount` float(8,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descriptin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_descriptin`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Men', '', 0.00, '', 'Men', '', '', '', 1, NULL, '2022-08-05 02:30:57'),
(2, 0, 1, 'Women', '', 0.00, '', 'Women', '', '', '', 1, NULL, '2022-08-03 20:58:45'),
(3, 0, 1, 'Kids', '', 0.00, '', 'Kids', '', '', '', 1, NULL, NULL),
(4, 0, 2, 'Mobile', '', 10.00, 'some text', 'Mobile', 'Mobile', 'Mobile', 'Mobile', 1, '2022-08-05 02:29:30', '2022-08-07 11:30:31'),
(5, 4, 2, 'Smartphones', '', 10.00, 'text', 'Smartphones', 'Smartphones', 'Smartphones', 'Smartphones', 1, '2022-08-05 11:07:05', '2022-08-05 11:07:05'),
(6, 1, 1, 'T-Shirts', '', 0.00, 'T-Shirts', 'T-Shirts', 'T-Shirts', 'T-Shirts', 'T-Shirts', 1, '2022-08-06 04:08:48', '2022-08-06 04:08:48'),
(7, 1, 1, 'Shirts', '', 0.00, NULL, 'Shirts', NULL, NULL, NULL, 1, '2022-08-06 05:55:52', '2022-08-06 05:58:50'),
(8, 2, 1, 'Tops', '', 0.00, 'This is women section tops category description', 'tops', 'tops', 'tops', 'tops', 1, '2022-08-06 10:50:19', '2022-08-06 10:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '2022-07-28 16:47:48', NULL),
(2, 'AL', 'Albania', 1, '2022-07-28 16:47:48', NULL),
(3, 'DZ', 'Algeria', 1, '2022-07-28 16:47:48', NULL),
(4, 'DS', 'American Samoa', 1, '2022-07-28 16:47:48', NULL),
(5, 'AD', 'Andorra', 1, '2022-07-28 16:47:48', NULL),
(6, 'AO', 'Angola', 1, '2022-07-28 16:47:48', NULL),
(7, 'AI', 'Anguilla', 1, '2022-07-28 16:47:48', NULL),
(8, 'AQ', 'Antarctica', 1, '2022-07-28 16:47:48', NULL),
(9, 'AG', 'Antigua and Barbuda', 1, '2022-07-28 16:47:48', NULL),
(10, 'AR', 'Argentina', 1, '2022-07-28 16:47:48', NULL),
(11, 'AM', 'Armenia', 1, '2022-07-28 16:47:48', NULL),
(12, 'AW', 'Aruba', 1, '2022-07-28 16:47:48', NULL),
(13, 'AU', 'Australia', 1, '2022-07-28 16:47:48', NULL),
(14, 'AT', 'Austria', 1, '2022-07-28 16:47:48', NULL),
(15, 'AZ', 'Azerbaijan', 1, '2022-07-28 16:47:48', NULL),
(16, 'BS', 'Bahamas', 1, '2022-07-28 16:47:48', NULL),
(17, 'BH', 'Bahrain', 1, '2022-07-28 16:47:48', NULL),
(18, 'BD', 'Bangladesh', 1, '2022-07-28 16:47:48', NULL),
(19, 'BB', 'Barbados', 1, '2022-07-28 16:47:48', NULL),
(20, 'BY', 'Belarus', 1, '2022-07-28 16:47:48', NULL),
(21, 'BE', 'Belgium', 1, '2022-07-28 16:47:48', NULL),
(22, 'BZ', 'Belize', 1, '2022-07-28 16:47:48', NULL),
(23, 'BJ', 'Benin', 1, '2022-07-28 16:47:48', NULL),
(24, 'BM', 'Bermuda', 1, '2022-07-28 16:47:48', NULL),
(25, 'BT', 'Bhutan', 1, '2022-07-28 16:47:48', NULL),
(26, 'BO', 'Bolivia', 1, '2022-07-28 16:47:48', NULL),
(27, 'BA', 'Bosnia and Herzegovina', 1, '2022-07-28 16:47:48', NULL),
(28, 'BW', 'Botswana', 1, '2022-07-28 16:47:48', NULL),
(29, 'BV', 'Bouvet Island', 1, '2022-07-28 16:47:48', NULL),
(30, 'BR', 'Brazil', 1, '2022-07-28 16:47:48', NULL),
(31, 'IO', 'British Indian Ocean Territory', 1, '2022-07-28 16:47:48', NULL),
(32, 'BN', 'Brunei Darussalam', 1, '2022-07-28 16:47:48', NULL),
(33, 'BG', 'Bulgaria', 1, '2022-07-28 16:47:48', NULL),
(34, 'BF', 'Burkina Faso', 1, '2022-07-28 16:47:48', NULL),
(35, 'BI', 'Burundi', 1, '2022-07-28 16:47:48', NULL),
(36, 'KH', 'Cambodia', 1, '2022-07-28 16:47:48', NULL),
(37, 'CM', 'Cameroon', 1, '2022-07-28 16:47:48', NULL),
(38, 'CA', 'Canada', 1, '2022-07-28 16:47:48', NULL),
(39, 'CV', 'Cape Verde', 1, '2022-07-28 16:47:48', NULL),
(40, 'KY', 'Cayman Islands', 1, '2022-07-28 16:47:48', NULL),
(41, 'CF', 'Central African Republic', 1, '2022-07-28 16:47:48', NULL),
(42, 'TD', 'Chad', 1, '2022-07-28 16:47:48', NULL),
(43, 'CL', 'Chile', 1, '2022-07-28 16:47:48', NULL),
(44, 'CN', 'China', 1, '2022-07-28 16:47:48', NULL),
(45, 'CX', 'Christmas Island', 1, '2022-07-28 16:47:48', NULL),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '2022-07-28 16:47:48', NULL),
(47, 'CO', 'Colombia', 1, '2022-07-28 16:47:48', NULL),
(48, 'KM', 'Comoros', 1, '2022-07-28 16:47:48', NULL),
(49, 'CD', 'Democratic Republic of the Congo', 1, '2022-07-28 16:47:48', NULL),
(50, 'CG', 'Republic of Congo', 1, '2022-07-28 16:47:48', NULL),
(51, 'CK', 'Cook Islands', 1, '2022-07-28 16:47:48', NULL),
(52, 'CR', 'Costa Rica', 1, '2022-07-28 16:47:48', NULL),
(53, 'HR', 'Croatia (Hrvatska)', 1, '2022-07-28 16:47:48', NULL),
(54, 'CU', 'Cuba', 1, '2022-07-28 16:47:48', NULL),
(55, 'CY', 'Cyprus', 1, '2022-07-28 16:47:48', NULL),
(56, 'CZ', 'Czech Republic', 1, '2022-07-28 16:47:48', NULL),
(57, 'DK', 'Denmark', 1, '2022-07-28 16:47:48', NULL),
(58, 'DJ', 'Djibouti', 1, '2022-07-28 16:47:48', NULL),
(59, 'DM', 'Dominica', 1, '2022-07-28 16:47:48', NULL),
(60, 'DO', 'Dominican Republic', 1, '2022-07-28 16:47:48', NULL),
(61, 'TP', 'East Timor', 1, '2022-07-28 16:47:48', NULL),
(62, 'EC', 'Ecuador', 1, '2022-07-28 16:47:48', NULL),
(63, 'EG', 'Egypt', 1, '2022-07-28 16:47:48', NULL),
(64, 'SV', 'El Salvador', 1, '2022-07-28 16:47:48', NULL),
(65, 'GQ', 'Equatorial Guinea', 1, '2022-07-28 16:47:48', NULL),
(66, 'ER', 'Eritrea', 1, '2022-07-28 16:47:48', NULL),
(67, 'EE', 'Estonia', 1, '2022-07-28 16:47:48', NULL),
(68, 'ET', 'Ethiopia', 1, '2022-07-28 16:47:48', NULL),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '2022-07-28 16:47:48', NULL),
(70, 'FO', 'Faroe Islands', 1, '2022-07-28 16:47:48', NULL),
(71, 'FJ', 'Fiji', 1, '2022-07-28 16:47:48', NULL),
(72, 'FI', 'Finland', 1, '2022-07-28 16:47:48', NULL),
(73, 'FR', 'France', 1, '2022-07-28 16:47:48', NULL),
(74, 'FX', 'France, Metropolitan', 1, '2022-07-28 16:47:48', NULL),
(75, 'GF', 'French Guiana', 1, '2022-07-28 16:47:48', NULL),
(76, 'PF', 'French Polynesia', 1, '2022-07-28 16:47:48', NULL),
(77, 'TF', 'French Southern Territories', 1, '2022-07-28 16:47:48', NULL),
(78, 'GA', 'Gabon', 1, '2022-07-28 16:47:48', NULL),
(79, 'GM', 'Gambia', 1, '2022-07-28 16:47:48', NULL),
(80, 'GE', 'Georgia', 1, '2022-07-28 16:47:48', NULL),
(81, 'DE', 'Germany', 1, '2022-07-28 16:47:48', NULL),
(82, 'GH', 'Ghana', 1, '2022-07-28 16:47:48', NULL),
(83, 'GI', 'Gibraltar', 1, '2022-07-28 16:47:48', NULL),
(84, 'GK', 'Guernsey', 1, '2022-07-28 16:47:48', NULL),
(85, 'GR', 'Greece', 1, '2022-07-28 16:47:48', NULL),
(86, 'GL', 'Greenland', 1, '2022-07-28 16:47:48', NULL),
(87, 'GD', 'Grenada', 1, '2022-07-28 16:47:48', NULL),
(88, 'GP', 'Guadeloupe', 1, '2022-07-28 16:47:48', NULL),
(89, 'GU', 'Guam', 1, '2022-07-28 16:47:48', NULL),
(90, 'GT', 'Guatemala', 1, '2022-07-28 16:47:48', NULL),
(91, 'GN', 'Guinea', 1, '2022-07-28 16:47:48', NULL),
(92, 'GW', 'Guinea-Bissau', 1, '2022-07-28 16:47:48', NULL),
(93, 'GY', 'Guyana', 1, '2022-07-28 16:47:48', NULL),
(94, 'HT', 'Haiti', 1, '2022-07-28 16:47:48', NULL),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '2022-07-28 16:47:48', NULL),
(96, 'HN', 'Honduras', 1, '2022-07-28 16:47:48', NULL),
(97, 'HK', 'Hong Kong', 1, '2022-07-28 16:47:48', NULL),
(98, 'HU', 'Hungary', 1, '2022-07-28 16:47:48', NULL),
(99, 'IS', 'Iceland', 1, '2022-07-28 16:47:48', NULL),
(100, 'IN', 'India', 1, '2022-07-28 16:47:48', NULL),
(101, 'IM', 'Isle of Man', 1, '2022-07-28 16:47:48', NULL),
(102, 'ID', 'Indonesia', 1, '2022-07-28 16:47:48', NULL),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '2022-07-28 16:47:48', NULL),
(104, 'IQ', 'Iraq', 1, '2022-07-28 16:47:48', NULL),
(105, 'IE', 'Ireland', 1, '2022-07-28 16:47:48', NULL),
(106, 'IL', 'Israel', 1, '2022-07-28 16:47:48', NULL),
(107, 'IT', 'Italy', 1, '2022-07-28 16:47:48', NULL),
(108, 'CI', 'Ivory Coast', 1, '2022-07-28 16:47:48', NULL),
(109, 'JE', 'Jersey', 1, '2022-07-28 16:47:48', NULL),
(110, 'JM', 'Jamaica', 1, '2022-07-28 16:47:48', NULL),
(111, 'JP', 'Japan', 1, '2022-07-28 16:47:48', NULL),
(112, 'JO', 'Jordan', 1, '2022-07-28 16:47:48', NULL),
(113, 'KZ', 'Kazakhstan', 1, '2022-07-28 16:47:48', NULL),
(114, 'KE', 'Kenya', 1, '2022-07-28 16:47:48', NULL),
(115, 'KI', 'Kiribati', 1, '2022-07-28 16:47:48', NULL),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '2022-07-28 16:47:48', NULL),
(117, 'KR', 'Korea, Republic of', 1, '2022-07-28 16:47:48', NULL),
(118, 'XK', 'Kosovo', 1, '2022-07-28 16:47:48', NULL),
(119, 'KW', 'Kuwait', 1, '2022-07-28 16:47:48', NULL),
(120, 'KG', 'Kyrgyzstan', 1, '2022-07-28 16:47:48', NULL),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '2022-07-28 16:47:48', NULL),
(122, 'LV', 'Latvia', 1, '2022-07-28 16:47:48', NULL),
(123, 'LB', 'Lebanon', 1, '2022-07-28 16:47:48', NULL),
(124, 'LS', 'Lesotho', 1, '2022-07-28 16:47:48', NULL),
(125, 'LR', 'Liberia', 1, '2022-07-28 16:47:48', NULL),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '2022-07-28 16:47:48', NULL),
(127, 'LI', 'Liechtenstein', 1, '2022-07-28 16:47:48', NULL),
(128, 'LT', 'Lithuania', 1, '2022-07-28 16:47:48', NULL),
(129, 'LU', 'Luxembourg', 1, '2022-07-28 16:47:48', NULL),
(130, 'MO', 'Macau', 1, '2022-07-28 16:47:48', NULL),
(131, 'MK', 'North Macedonia', 1, '2022-07-28 16:47:48', NULL),
(132, 'MG', 'Madagascar', 1, '2022-07-28 16:47:48', NULL),
(133, 'MW', 'Malawi', 1, '2022-07-28 16:47:48', NULL),
(134, 'MY', 'Malaysia', 1, '2022-07-28 16:47:48', NULL),
(135, 'MV', 'Maldives', 1, '2022-07-28 16:47:48', NULL),
(136, 'ML', 'Mali', 1, '2022-07-28 16:47:48', NULL),
(137, 'MT', 'Malta', 1, '2022-07-28 16:47:48', NULL),
(138, 'MH', 'Marshall Islands', 1, '2022-07-28 16:47:48', NULL),
(139, 'MQ', 'Martinique', 1, '2022-07-28 16:47:48', NULL),
(140, 'MR', 'Mauritania', 1, '2022-07-28 16:47:48', NULL),
(141, 'MU', 'Mauritius', 1, '2022-07-28 16:47:48', NULL),
(142, 'TY', 'Mayotte', 1, '2022-07-28 16:47:48', NULL),
(143, 'MX', 'Mexico', 1, '2022-07-28 16:47:48', NULL),
(144, 'FM', 'Micronesia, Federated States of', 1, '2022-07-28 16:47:48', NULL),
(145, 'MD', 'Moldova, Republic of', 1, '2022-07-28 16:47:48', NULL),
(146, 'MC', 'Monaco', 1, '2022-07-28 16:47:48', NULL),
(147, 'MN', 'Mongolia', 1, '2022-07-28 16:47:48', NULL),
(148, 'ME', 'Montenegro', 1, '2022-07-28 16:47:48', NULL),
(149, 'MS', 'Montserrat', 1, '2022-07-28 16:47:48', NULL),
(150, 'MA', 'Morocco', 1, '2022-07-28 16:47:48', NULL),
(151, 'MZ', 'Mozambique', 1, '2022-07-28 16:47:48', NULL),
(152, 'MM', 'Myanmar', 1, '2022-07-28 16:47:48', NULL),
(153, 'NA', 'Namibia', 1, '2022-07-28 16:47:48', NULL),
(154, 'NR', 'Nauru', 1, '2022-07-28 16:47:48', NULL),
(155, 'NP', 'Nepal', 1, '2022-07-28 16:47:48', NULL),
(156, 'NL', 'Netherlands', 1, '2022-07-28 16:47:48', NULL),
(157, 'AN', 'Netherlands Antilles', 1, '2022-07-28 16:47:48', NULL),
(158, 'NC', 'New Caledonia', 1, '2022-07-28 16:47:48', NULL),
(159, 'NZ', 'New Zealand', 1, '2022-07-28 16:47:48', NULL),
(160, 'NI', 'Nicaragua', 1, '2022-07-28 16:47:48', NULL),
(161, 'NE', 'Niger', 1, '2022-07-28 16:47:48', NULL),
(162, 'NG', 'Nigeria', 1, '2022-07-28 16:47:48', NULL),
(163, 'NU', 'Niue', 1, '2022-07-28 16:47:48', NULL),
(164, 'NF', 'Norfolk Island', 1, '2022-07-28 16:47:48', NULL),
(165, 'MP', 'Northern Mariana Islands', 1, '2022-07-28 16:47:48', NULL),
(166, 'NO', 'Norway', 1, '2022-07-28 16:47:48', NULL),
(167, 'OM', 'Oman', 1, '2022-07-28 16:47:48', NULL),
(168, 'PK', 'Pakistan', 1, '2022-07-28 16:47:48', NULL),
(169, 'PW', 'Palau', 1, '2022-07-28 16:47:48', NULL),
(170, 'PS', 'Palestine', 1, '2022-07-28 16:47:48', NULL),
(171, 'PA', 'Panama', 1, '2022-07-28 16:47:48', NULL),
(172, 'PG', 'Papua New Guinea', 1, '2022-07-28 16:47:48', NULL),
(173, 'PY', 'Paraguay', 1, '2022-07-28 16:47:48', NULL),
(174, 'PE', 'Peru', 1, '2022-07-28 16:47:48', NULL),
(175, 'PH', 'Philippines', 1, '2022-07-28 16:47:48', NULL),
(176, 'PN', 'Pitcairn', 1, '2022-07-28 16:47:48', NULL),
(177, 'PL', 'Poland', 1, '2022-07-28 16:47:48', NULL),
(178, 'PT', 'Portugal', 1, '2022-07-28 16:47:48', NULL),
(179, 'PR', 'Puerto Rico', 1, '2022-07-28 16:47:48', NULL),
(180, 'QA', 'Qatar', 1, '2022-07-28 16:47:48', NULL),
(181, 'RE', 'Reunion', 1, '2022-07-28 16:47:48', NULL),
(182, 'RO', 'Romania', 1, '2022-07-28 16:47:48', NULL),
(183, 'RU', 'Russian Federation', 1, '2022-07-28 16:47:48', NULL),
(184, 'RW', 'Rwanda', 1, '2022-07-28 16:47:48', NULL),
(185, 'KN', 'Saint Kitts and Nevis', 1, '2022-07-28 16:47:48', NULL),
(186, 'LC', 'Saint Lucia', 1, '2022-07-28 16:47:48', NULL),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '2022-07-28 16:47:48', NULL),
(188, 'WS', 'Samoa', 1, '2022-07-28 16:47:48', NULL),
(189, 'SM', 'San Marino', 1, '2022-07-28 16:47:48', NULL),
(190, 'ST', 'Sao Tome and Principe', 1, '2022-07-28 16:47:48', NULL),
(191, 'SA', 'Saudi Arabia', 1, '2022-07-28 16:47:48', NULL),
(192, 'SN', 'Senegal', 1, '2022-07-28 16:47:48', NULL),
(193, 'RS', 'Serbia', 1, '2022-07-28 16:47:48', NULL),
(194, 'SC', 'Seychelles', 1, '2022-07-28 16:47:48', NULL),
(195, 'SL', 'Sierra Leone', 1, '2022-07-28 16:47:48', NULL),
(196, 'SG', 'Singapore', 1, '2022-07-28 16:47:48', NULL),
(197, 'SK', 'Slovakia', 1, '2022-07-28 16:47:48', NULL),
(198, 'SI', 'Slovenia', 1, '2022-07-28 16:47:48', NULL),
(199, 'SB', 'Solomon Islands', 1, '2022-07-28 16:47:48', NULL),
(200, 'SO', 'Somalia', 1, '2022-07-28 16:47:48', NULL),
(201, 'ZA', 'South Africa', 1, '2022-07-28 16:47:48', NULL),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '2022-07-28 16:47:48', NULL),
(203, 'SS', 'South Sudan', 1, '2022-07-28 16:47:48', NULL),
(204, 'ES', 'Spain', 1, '2022-07-28 16:47:48', NULL),
(205, 'LK', 'Sri Lanka', 1, '2022-07-28 16:47:48', NULL),
(206, 'SH', 'St. Helena', 1, '2022-07-28 16:47:48', NULL),
(207, 'PM', 'St. Pierre and Miquelon', 1, '2022-07-28 16:47:48', NULL),
(208, 'SD', 'Sudan', 1, '2022-07-28 16:47:48', NULL),
(209, 'SR', 'Suriname', 1, '2022-07-28 16:47:48', NULL),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '2022-07-28 16:47:48', NULL),
(211, 'SZ', 'Eswatini', 1, '2022-07-28 16:47:48', NULL),
(212, 'SE', 'Sweden', 1, '2022-07-28 16:47:48', NULL),
(213, 'CH', 'Switzerland', 1, '2022-07-28 16:47:48', NULL),
(214, 'SY', 'Syrian Arab Republic', 1, '2022-07-28 16:47:48', NULL),
(215, 'TW', 'Taiwan', 1, '2022-07-28 16:47:48', NULL),
(216, 'TJ', 'Tajikistan', 1, '2022-07-28 16:47:48', NULL),
(217, 'TZ', 'Tanzania, United Republic of', 1, '2022-07-28 16:47:48', NULL),
(218, 'TH', 'Thailand', 1, '2022-07-28 16:47:48', NULL),
(219, 'TG', 'Togo', 1, '2022-07-28 16:47:48', NULL),
(220, 'TK', 'Tokelau', 1, '2022-07-28 16:47:48', NULL),
(221, 'TO', 'Tonga', 1, '2022-07-28 16:47:48', NULL),
(222, 'TT', 'Trinidad and Tobago', 1, '2022-07-28 16:47:48', NULL),
(223, 'TN', 'Tunisia', 1, '2022-07-28 16:47:48', NULL),
(224, 'TR', 'Turkey', 1, '2022-07-28 16:47:48', NULL),
(225, 'TM', 'Turkmenistan', 1, '2022-07-28 16:47:48', NULL),
(226, 'TC', 'Turks and Caicos Islands', 1, '2022-07-28 16:47:48', NULL),
(227, 'TV', 'Tuvalu', 1, '2022-07-28 16:47:48', NULL),
(228, 'UG', 'Uganda', 1, '2022-07-28 16:47:48', NULL),
(229, 'UA', 'Ukraine', 1, '2022-07-28 16:47:48', NULL),
(230, 'AE', 'United Arab Emirates', 1, '2022-07-28 16:47:48', NULL),
(231, 'GB', 'United Kingdom', 1, '2022-07-28 16:47:48', NULL),
(232, 'US', 'United States', 1, '2022-07-28 16:47:48', NULL),
(233, 'UM', 'United States minor outlying islands', 1, '2022-07-28 16:47:48', NULL),
(234, 'UY', 'Uruguay', 1, '2022-07-28 16:47:48', NULL),
(235, 'UZ', 'Uzbekistan', 1, '2022-07-28 16:47:48', NULL),
(236, 'VU', 'Vanuatu', 1, '2022-07-28 16:47:48', NULL),
(237, 'VA', 'Vatican City State', 1, '2022-07-28 16:47:48', NULL),
(238, 'VE', 'Venezuela', 1, '2022-07-28 16:47:48', NULL),
(239, 'VN', 'Vietnam', 1, '2022-07-28 16:47:48', NULL),
(240, 'VG', 'Virgin Islands (British)', 1, '2022-07-28 16:47:48', NULL),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '2022-07-28 16:47:48', NULL),
(242, 'WF', 'Wallis and Futuna Islands', 1, '2022-07-28 16:47:48', NULL),
(243, 'EH', 'Western Sahara', 1, '2022-07-28 16:47:48', NULL),
(244, 'YE', 'Yemen', 1, '2022-07-28 16:47:48', NULL),
(245, 'ZM', 'Zambia', 1, '2022-07-28 16:47:48', NULL),
(246, 'ZW', 'Zimbabwe', 1, '2022-07-28 16:47:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_24_154009_create_vendors_table', 2),
(6, '2022_06_24_155516_create_admins_table', 2),
(7, '2022_07_01_042658_create_vendors_business_details_table', 3),
(8, '2022_07_01_043639_create_vendors_bank_details_table', 4),
(9, '2022_07_28_172818_create_sections_table', 5),
(10, '2022_08_03_150343_create_categories_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 1, NULL, '2022-08-02 10:58:52'),
(2, 'Electronics', 1, NULL, '2022-08-03 08:57:16'),
(3, 'Appliances', 1, NULL, '2022-08-03 08:57:13'),
(4, 'computer', 1, '2022-08-02 21:35:11', '2022-08-02 21:35:11'),
(5, 'Desktop', 1, '2022-08-03 08:57:55', '2022-08-03 08:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Md Mehedi hasan', 'mdmehedihasan11@gmail.com', NULL, '$2a$12$o0YIdNcpFJJqH5YGC4iml..25fS.3tT2y0YA12Vg4qdEZkIEXYSJu', NULL, '2022-06-24 04:29:11', '2022-06-24 04:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Md Tuhen', 'South Islamabad', 'South Islamabad', 'Chittagong', 'Bangladesh', '56789', '01848494809', 'tuhen@gmail.com', 0, NULL, '2022-07-28 11:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_bank_details`
--

CREATE TABLE `vendors_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_bank_details`
--

INSERT INTO `vendors_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_name`, `account_number`, `bank_ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Md Tuhen Prodan', 'Bnak Asia', '235467655', '676756776', NULL, '2022-07-23 09:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_proof_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `shop_email`, `address_proof`, `address_proof_image`, `business_license_number`, `gst_number`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tuhen Electronics Store', 'Chitagong,GEC', 'Chitagong', 'Chitagong', 'Bangladesh', '12345', '01848494809', 'tuhenElectronicstore.com', 'tuhen@gmail.com', 'NID Card', '', '56711655', '5671111167', '400125678', NULL, '2022-07-28 11:15:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Indexes for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
