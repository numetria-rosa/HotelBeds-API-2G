-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 12:09 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cercina`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `pid` int(11) NOT NULL,
  `id` varchar(255) NOT NULL,
  `agentid` varchar(255) NOT NULL,
  `bookingreference` varchar(255) NOT NULL,
  `agentrefno` varchar(255) NOT NULL,
  `totalcharges` decimal(10,3) NOT NULL,
  `grossamount` decimal(10,3) NOT NULL,
  `totalmarkup` decimal(10,3) NOT NULL,
  `convertion` varchar(10) NOT NULL DEFAULT '0',
  `leadertitle` varchar(255) NOT NULL,
  `leaderfirstname` varchar(255) NOT NULL,
  `leaderlastname` varchar(255) NOT NULL,
  `currencycode` varchar(255) NOT NULL,
  `agencydevise` varchar(255) NOT NULL,
  `localhotelid` varchar(255) NOT NULL,
  `hotelname` varchar(255) NOT NULL,
  `categoryCode` varchar(255) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `destinationCode` varchar(255) NOT NULL,
  `countryname` varchar(255) NOT NULL,
  `cityname` varchar(255) NOT NULL,
  `cityid` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `hoteladdress` longtext NOT NULL,
  `currentstatus` varchar(255) NOT NULL,
  `totaladults` int(11) NOT NULL,
  `totalchildren` int(11) NOT NULL,
  `totalkids` int(11) NOT NULL DEFAULT '0',
  `totalrooms` int(11) NOT NULL,
  `checkindate` varchar(255) NOT NULL,
  `checkoutdate` varchar(255) NOT NULL,
  `hotelphone` varchar(255) NOT NULL,
  `selectednights` int(11) NOT NULL,
  `pidagence` int(11) NOT NULL,
  `pidagent` int(11) NOT NULL,
  `starttime` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `bookingservicetype` varchar(255) NOT NULL,
  `contactemail` varchar(255) NOT NULL,
  `contactmobile` varchar(255) NOT NULL,
  `contactvol` varchar(255) NOT NULL,
  `contactmessage` longtext NOT NULL,
  `options` varchar(255) NOT NULL,
  `cp` longtext NOT NULL,
  `creationUser` varchar(255) NOT NULL,
  `pendingAmount` varchar(255) NOT NULL,
  `cancellation` varchar(11) NOT NULL,
  `modification` varchar(11) NOT NULL,
  `SupplierName` varchar(255) NOT NULL,
  `SupplierVatNumber` varchar(255) NOT NULL,
  `quota` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`pid`, `id`, `agentid`, `bookingreference`, `agentrefno`, `totalcharges`, `grossamount`, `totalmarkup`, `convertion`, `leadertitle`, `leaderfirstname`, `leaderlastname`, `currencycode`, `agencydevise`, `localhotelid`, `hotelname`, `categoryCode`, `categoryName`, `destinationCode`, `countryname`, `cityname`, `cityid`, `latitude`, `longitude`, `hoteladdress`, `currentstatus`, `totaladults`, `totalchildren`, `totalkids`, `totalrooms`, `checkindate`, `checkoutdate`, `hotelphone`, `selectednights`, `pidagence`, `pidagent`, `starttime`, `endtime`, `bookingservicetype`, `contactemail`, `contactmobile`, `contactvol`, `contactmessage`, `options`, `cp`, `creationUser`, `pendingAmount`, `cancellation`, `modification`, `SupplierName`, `SupplierVatNumber`, `quota`) VALUES
(1, '100468', '53', 'C2STNCTE_948506', '', '88.992', '0.000', '88.992', '0', 'MR', 'test', 'test', 'TND', '', '143', 'Menara', '4', '4 ÃƒÂ‰toiles', '1', 'Tunisie', 'Hammamet', '104', '36.39233569338982', '10.55643076931427', 'Adresse : Avenue De La Paix Bp 57? Hammamet 8050', 'vouchered', 2, 0, 0, 1, '2022-04-14', '2022-04-15', '72 226 999', 1, 49, 49, '2022-03-11 11:58:01', '2022-03-11 11:58:01', 'carthagehotels', '', '', '', 'Si possible, grand lit', '', '', '2703', '', '11/04/2022', '88.992', 'Cte Hotels', '', 0),
(2, '100738', '53', 'C2STNCTE_950461', '', '65.992', '0.000', '65.993', '0', 'MR', 'testapi emnavoyage', 'testapi emnavoyage', 'TND', '', '102', 'HAMMAMET GARDEN RESORT & SPA ', '4', '4 ÃƒÂ‰toiles', '1', 'Tunisie', 'Hammamet', '104', '36.40171915924117', '10.567405738628535', 'Adresse : 119 BP, Hammamet', 'vouchered', 1, 0, 0, 1, '2022-04-14', '2022-04-15', '72 227 033', 1, 0, 0, '2022-03-21 10:34:09', '2022-03-21 10:34:09', 'carthagehotels', '', '', '', 'Si possible, arrivÃƒÂ©e tardive', '', '', '2703', '', '11/04/2022', '65.992', 'Cte Hotels', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookingroomdetails`
--

CREATE TABLE `bookingroomdetails` (
  `pid` int(11) NOT NULL,
  `salutation` varchar(11) NOT NULL,
  `firstname` longtext NOT NULL,
  `lastname` longtext NOT NULL,
  `passengertype` varchar(255) NOT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `pidroom` int(11) NOT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookingrooms`
--

CREATE TABLE `bookingrooms` (
  `pid` int(11) NOT NULL,
  `roomtypedescription` longtext NOT NULL,
  `numberofroom` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `pidbooking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookingrooms`
--

INSERT INTO `bookingrooms` (`pid`, `roomtypedescription`, `numberofroom`, `status`, `id`, `code`, `pidbooking`) VALUES
(1, ' Chambre Double : Logement Petit DÃƒÂ©jeuner', 1, '', 1, '', 1),
(2, ' Chambre Single : Logement Petit DÃƒÂ©jeuner', 1, '', 2, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `pid` int(11) NOT NULL,
  `agence` int(11) NOT NULL,
  `deposit` decimal(10,3) NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'TND',
  `deposit_on` varchar(255) NOT NULL,
  `comment` longtext NOT NULL,
  `oldCredit` decimal(10,3) NOT NULL DEFAULT '0.000',
  `superworker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`pid`, `agence`, `deposit`, `currency`, `deposit_on`, `comment`, `oldCredit`, `superworker`) VALUES
(2024, 50, '20.000', '', '2022-03-18 10:22:43', 'TEST', '0.000', 2),
(2025, 51, '20.000', '', '2022-03-22 13:55:21', 'fdgsfg', '0.000', 2),
(2026, 51, '20.000', '', '2022-03-22 13:57:20', 'fdfdfdd', '0.000', 2),
(2027, 51, '20.000', '', '2022-03-22 15:26:23', 'deposit', '0.000', 2),
(2028, 51, '30.000', '', '2022-03-22 15:26:36', 'deposit', '0.000', 2),
(2029, 51, '10.000', '', '2022-03-22 15:28:42', 'deposit', '30.000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `devises`
--

CREATE TABLE `devises` (
  `pid` int(11) NOT NULL,
  `CurrLongName` varchar(255) NOT NULL,
  `CurrShortName` varchar(255) NOT NULL,
  `CurrChange` decimal(10,3) NOT NULL,
  `CurrToTND` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devises`
--

INSERT INTO `devises` (`pid`, `CurrLongName`, `CurrShortName`, `CurrChange`, `CurrToTND`) VALUES
(1, 'Euro', 'EUR', '0.350', '3.750'),
(3, 'Tunisian Dinar', 'TND', '1.000', '1.000'),
(4, 'Us Dollar', 'USD', '0.360', '3.350'),
(5, 'Algerian Dinar', 'DZD', '75.000', '0.000'),
(6, 'Franc CFA', 'CFA', '236.000', '0.000'),
(7, 'Egyptian Pound', 'EGP', '7.364', '0.000'),
(8, 'Utd. Arab Emir. Dirham', 'AED', '1.805', '1.100'),
(9, 'Australian Dollar', 'AUD', '0.535', '0.000'),
(10, 'Swiss Franc', 'CHF', '0.934', '0.000'),
(11, 'United Kingdom Pound', 'GBP', '0.200', '6.000'),
(12, 'Kuwaiti Dinar', 'KWD', '0.124', '0.000'),
(13, 'Libyan Dinar', 'LYD', '0.561', '0.000'),
(14, 'Qatari Rial', 'QAR', '1.491', '0.000'),
(15, 'Saudi Riyal', 'SAR', '0.801', '1.248'),
(16, 'Swedish Krona', 'SEK', '3.473', '0.000'),
(17, 'Moroccan Dirham', 'MAD', '3.961', '0.000'),
(18, 'Afghani', 'AFA', '1.000', '0.000'),
(19, 'Lek', 'ALL', '0.000', '0.000'),
(20, 'Armenian Dram', 'AMD', '0.000', '0.000'),
(21, 'Antil. Guilder', 'ANG', '0.000', '0.000'),
(22, 'Kwanza Reajust.', 'AOR', '0.000', '0.000'),
(23, 'Argentine Peso', 'ARS', '0.000', '0.000'),
(24, 'Chelin Austriaco', 'ATS', '0.000', '0.000'),
(25, 'Aruban Guilder', 'AWG', '0.000', '0.000'),
(26, 'Azerb. Manat', 'AZM', '0.000', '0.000'),
(27, 'Azerbaijan Manat', 'AZN', '0.000', '0.000'),
(28, 'Dinar', 'BAD', '0.000', '0.000'),
(29, 'Bosnia And Herzegovina Convertible Mark', 'BAM', '0.000', '0.000'),
(30, 'Barbados Dollar', 'BBD', '0.000', '0.000'),
(31, 'Taka', 'BDT', '0.000', '0.000'),
(32, 'Bulgarian Lev', 'BGN', '0.000', '0.000'),
(33, 'Bahraini Dinar', 'BHD', '0.000', '0.000'),
(34, 'Burundi Franc', 'BIF', '0.000', '0.000'),
(35, 'Bermudn. Dollar', 'BMD', '0.000', '0.000'),
(36, 'Brunei Dollar', 'BND', '0.000', '0.000'),
(37, 'Boliviano', 'BOB', '0.000', '0.000'),
(38, 'Brazilian Real', 'BRL', '0.000', '0.000'),
(39, 'Bahamian Dollar', 'BSD', '0.000', '0.000'),
(40, 'Ngultrum', 'BTN', '0.000', '0.000'),
(41, 'Botswanan Pula', 'BWP', '0.000', '0.000'),
(42, 'Belarus Ruble', 'BYB', '0.000', '0.000'),
(43, 'Belarusian Ruble', 'BYR', '0.000', '0.000'),
(44, 'Belize Dollar', 'BZD', '0.000', '0.000'),
(45, 'Canadian Dollar', 'CAD', '0.000', '0.000'),
(46, 'Chilean Peso', 'CLP', '0.000', '0.000'),
(47, 'Chinese Yuan Renminbi', 'CNY', '0.000', '0.000'),
(48, 'Colombian Peso', 'COP', '0.000', '0.000'),
(49, 'Costa R. Colon', 'CRC', '0.000', '0.000'),
(50, 'Cuban Peso', 'CUP', '0.000', '0.000'),
(51, 'Cape V. Escudo', 'CVE', '0.000', '0.000'),
(52, 'Czech Koruna', 'CZK', '0.000', '0.000'),
(53, 'Djibouti Franc', 'DJF', '0.000', '0.000'),
(54, 'Danish Krone', 'DKK', '0.000', '0.000'),
(55, 'Dominican Peso', 'DOP', '0.000', '0.000'),
(56, 'Ecuadorian Sucre', 'ECS', '0.000', '0.000'),
(57, 'Ethiopian Birr', 'ETB', '0.000', '0.000'),
(58, 'Fiji Dollar', 'FJD', '0.000', '0.000'),
(59, 'Flknd. Is.pound', 'FKP', '0.000', '0.000'),
(60, 'Georgian Lari', 'GEL', '0.000', '0.000'),
(61, 'Ghanaian Cedi', 'GHC', '0.000', '0.000'),
(62, 'Gibraltar Pound', 'GIP', '0.000', '0.000'),
(63, 'Gambian Dalasi', 'GMD', '0.000', '0.000'),
(64, 'Guinea Franc', 'GNF', '0.000', '0.000'),
(65, 'Quetzal', 'GTQ', '0.000', '0.000'),
(66, 'Hong Kong Dollar', 'HKD', '0.000', '0.000'),
(67, 'Honduran Lempira', 'HNL', '0.000', '0.000'),
(68, 'Croatian Kuna', 'HRK', '0.000', '0.000'),
(69, 'Haitian Gourde', 'HTG', '0.000', '0.000'),
(70, 'Hungarian Forint', 'HUF', '0.000', '0.000'),
(71, 'Indonesian Rupiah', 'IDR', '0.000', '0.000'),
(72, 'Israel New Shekel', 'ILS', '0.000', '0.000'),
(73, 'Indian Rupee', 'INR', '0.000', '0.000'),
(74, 'Iraqi Dinar', 'IQD', '0.000', '0.000'),
(75, 'Iranian Rial', 'IRR', '0.000', '0.000'),
(76, 'Iceland Krona', 'ISK', '0.000', '0.000'),
(77, 'Jamaican Dollar', 'JMD', '0.000', '0.000'),
(78, 'Jordanian Dinar', 'JOD', '0.000', '0.000'),
(79, 'Japanese Yen', 'JPY', '0.000', '0.000'),
(80, 'Kenyen Shilling', 'KES', '0.000', '0.000'),
(81, 'Kyrgyzstan Som', 'KGS', '0.000', '0.000'),
(82, 'Cambodian Riel', 'KHR', '0.000', '0.000'),
(83, 'Comoro Franc', 'KMF', '0.000', '0.000'),
(84, 'Nth. Korean Won', 'KPW', '0.000', '0.000'),
(85, 'Sth. Korean Won', 'KRW', '0.000', '0.000'),
(86, 'Cayman Islands Dollar', 'KYD', '0.000', '0.000'),
(87, 'Kazakhstani Tenge', 'KZT', '0.000', '0.000'),
(88, 'Laotian Kip', 'LAK', '0.000', '0.000'),
(89, 'Lebanese Pound', 'LBP', '0.000', '0.000'),
(90, 'Sri Lanka Rupee', 'LKR', '0.000', '0.000'),
(91, 'Liberian Dollar', 'LRD', '0.000', '0.000'),
(92, 'Basotho Loti', 'LSL', '0.000', '0.000'),
(93, 'Lithuanian Litas', 'LTL', '0.000', '0.000'),
(94, 'Latvian Lats', 'LVL', '0.000', '0.000'),
(95, 'Moldovan Leu', 'MDL', '0.000', '0.000'),
(96, 'Malagasy Franc', 'MGF', '0.000', '0.000'),
(97, 'Macedonian Denar', 'MKD', '0.000', '0.000'),
(98, 'Burmese Kyat', 'MMK', '0.000', '0.000'),
(99, 'Mongolian Tugrik', 'MNT', '0.000', '0.000'),
(100, 'Macau Pataca', 'MOP', '0.000', '0.000'),
(101, 'Mauritanian Ouguiya', 'MRO', '0.000', '0.000'),
(102, 'Mauritius Rupee', 'MUR', '0.000', '0.000'),
(103, 'Maldivian Rufiyaa', 'MVR', '0.000', '0.000'),
(104, 'Malawian Kwacha', 'MWK', '0.000', '0.000'),
(105, 'Mexican Peso', 'MXN', '0.000', '0.000'),
(106, 'Malaysian Ringgit', 'MYR', '0.000', '0.000'),
(107, 'Mozambican Metical', 'MZM', '0.000', '0.000'),
(108, 'Namibia Dollar', 'NAD', '0.000', '0.000'),
(109, 'Nigerian Naira', 'NGN', '0.000', '0.000'),
(110, 'Nicaraguan Cordoba Oro', 'NIO', '0.000', '0.000'),
(111, 'Norwegian Kroner', 'NOK', '0.000', '0.000'),
(112, 'Nepalese Rupee', 'NPR', '0.000', '0.000'),
(113, 'New Zealand Dollar', 'NZD', '0.000', '0.000'),
(114, 'Omani Rial', 'OMR', '0.000', '0.000'),
(115, 'Panamanian Balboa', 'PAB', '0.000', '0.000'),
(116, 'Peruvian Nuevo Sol', 'PEN', '0.000', '0.000'),
(117, 'Papua New Guinean Kina', 'PGK', '0.000', '0.000'),
(118, 'Philippine Peso', 'PHP', '0.000', '0.000'),
(119, 'Pakistan Rupee', 'PKR', '0.000', '0.000'),
(120, 'Polish Zloty', 'PLN', '0.000', '0.000'),
(121, 'Paraguayan Guarani', 'PYG', '0.000', '0.000'),
(122, 'Chinese Yuan Rmb', 'RMB', '0.000', '0.000'),
(123, 'Romanian New Leu', 'RON', '0.000', '0.000'),
(124, 'Serbian Dinar', 'RSD', '0.000', '0.000'),
(125, 'Russian Rouble', 'RUB', '0.000', '0.000'),
(126, 'Rwanda Franc', 'RWF', '0.000', '0.000'),
(127, 'Solomon Islander Dollar', 'SBD', '0.000', '0.000'),
(128, 'Seychel. Rupee', 'SCR', '0.000', '0.000'),
(129, 'Sudanese Dinar', 'SDD', '0.000', '0.000'),
(130, 'Singapore Dollar', 'SGD', '0.000', '0.000'),
(131, 'Sierra Leonean Leone', 'SLL', '0.000', '0.000'),
(132, 'Som. Shilling', 'SOS', '0.000', '0.000'),
(133, 'Surinam Guilder', 'SRG', '0.000', '0.000'),
(134, 'Dobra', 'STD', '0.000', '0.000'),
(135, 'El Salv. Colon', 'SVC', '0.000', '0.000'),
(136, 'Syrian Pound', 'SYP', '0.000', '0.000'),
(137, 'Lilangeni', 'SZL', '0.000', '0.000'),
(138, 'Thai Baht', 'THB', '0.000', '0.000'),
(139, 'Tajik Ruble', 'TJR', '0.000', '0.000'),
(140, 'Somoni', 'TJS', '0.000', '0.000'),
(141, 'Manat', 'TMM', '0.000', '0.000'),
(142, 'Tongan Pa Anga', 'TOP', '0.000', '0.000'),
(143, 'Timor Escudo', 'TPE', '0.000', '0.000'),
(144, 'Turkish New Lira', 'TRY', '0.000', '0.000'),
(145, 'Trinidad And Tobago Dollar', 'TTD', '0.000', '0.000'),
(146, 'New Twn. Dollar', 'TWD', '0.000', '0.000'),
(147, 'Tanzn. Shilling', 'TZS', '0.000', '0.000'),
(148, 'Ukrainian Hryvnia', 'UAH', '0.000', '0.000'),
(149, 'Uganda Shilling', 'UGX', '0.000', '0.000'),
(150, 'Peso Uruguayo', 'UYU', '0.000', '0.000'),
(151, 'Uzbekistan Sum', 'UZS', '0.000', '0.000'),
(152, 'Bolivar', 'VEB', '0.000', '0.000'),
(153, 'Venezuelan Bolivar Fuerte', 'VEF', '0.000', '0.000'),
(154, 'Venezuelan Bolivar Soberano', 'VES', '0.000', '0.000'),
(155, 'Vietnamese Dong', 'VND', '0.000', '0.000'),
(156, 'Samoan Tala', 'WST', '0.000', '0.000'),
(157, 'Central African Franc Beac', 'XAF', '0.000', '0.000'),
(158, 'East. C. Dollar', 'XCD', '0.000', '0.000'),
(159, 'Sp. Drwg. Right', 'XDR', '0.000', '0.000'),
(160, 'Unidad Monetaria Europea', 'XEU', '0.000', '0.000'),
(161, 'Franco Cfa', 'XOF', '0.000', '0.000'),
(162, 'French Pacific Franc', 'XPF', '0.000', '0.000'),
(163, 'Yemeni Rial', 'YER', '0.000', '0.000'),
(164, 'New Dinar', 'YUM', '0.000', '0.000'),
(165, 'South African Rand', 'ZAR', '0.000', '0.000'),
(166, 'Zambian Kwacha', 'ZMK', '0.000', '0.000'),
(167, 'Zambian Kwacha', 'ZMW', '0.000', '0.000'),
(168, 'New Zaire', 'ZRN', '0.000', '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `historyused`
--

CREATE TABLE `historyused` (
  `pid` int(11) NOT NULL,
  `superWorker` int(11) NOT NULL,
  `insertedOn` varchar(255) NOT NULL,
  `tache` varchar(255) NOT NULL,
  `usedTable` varchar(255) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `markup`
--

CREATE TABLE `markup` (
  `markup_b2c` decimal(10,0) NOT NULL DEFAULT '0',
  `markup_b2b` decimal(10,0) NOT NULL DEFAULT '0',
  `markup_b2e` decimal(10,0) NOT NULL DEFAULT '0',
  `markuppersonne` decimal(10,3) NOT NULL DEFAULT '0.000',
  `markup_personne_b2b` decimal(10,3) NOT NULL DEFAULT '0.000',
  `markup_personne_b2e` decimal(10,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markup`
--

INSERT INTO `markup` (`markup_b2c`, `markup_b2b`, `markup_b2e`, `markuppersonne`, `markup_personne_b2b`, `markup_personne_b2e`) VALUES
('22', '19', '12', '6000.000', '6.000', '7.000'),
('0', '0', '0', '6000.000', '6.000', '7.000');

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `id_pays` smallint(5) UNSIGNED NOT NULL,
  `code` int(3) NOT NULL,
  `alpha2` varchar(2) NOT NULL,
  `alpha3` varchar(3) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`id_pays`, `code`, `alpha2`, `alpha3`, `nom`) VALUES
(1, 4, 'AF', 'AFG', 'Afghanistan'),
(2, 8, 'AL', 'ALB', 'Albanie'),
(3, 10, 'AQ', 'ATA', 'Antarctique'),
(4, 12, 'DZ', 'DZA', 'AlgÃƒÂ©rie'),
(5, 16, 'AS', 'ASM', 'Samoa AmÃƒÂ©ricaines'),
(6, 20, 'AD', 'AND', 'Andorre'),
(7, 24, 'AO', 'AGO', 'Angola'),
(8, 28, 'AG', 'ATG', 'Antigua-et-Barbuda'),
(9, 31, 'AZ', 'AZE', 'AzerbaÃƒÂ¯djan'),
(10, 32, 'AR', 'ARG', 'Argentine'),
(11, 36, 'AU', 'AUS', 'Australie'),
(12, 40, 'AT', 'AUT', 'Autriche'),
(13, 44, 'BS', 'BHS', 'Bahamas'),
(14, 48, 'BH', 'BHR', 'BahreÃƒÂ¯n'),
(15, 50, 'BD', 'BGD', 'Bangladesh'),
(16, 51, 'AM', 'ARM', 'ArmÃƒÂ©nie'),
(17, 52, 'BB', 'BRB', 'Barbade'),
(18, 56, 'BE', 'BEL', 'Belgique'),
(19, 60, 'BM', 'BMU', 'Bermudes'),
(20, 64, 'BT', 'BTN', 'Bhoutan'),
(21, 68, 'BO', 'BOL', 'Bolivie'),
(22, 70, 'BA', 'BIH', 'Bosnie-HerzÃƒÂ©govine'),
(23, 72, 'BW', 'BWA', 'Botswana'),
(24, 74, 'BV', 'BVT', 'ÃƒÂŽle Bouvet'),
(25, 76, 'BR', 'BRA', 'BrÃƒÂ©sil'),
(26, 84, 'BZ', 'BLZ', 'Belize'),
(27, 86, 'IO', 'IOT', 'Territoire Britannique de l\'OcÃƒÂ©an Indien'),
(28, 90, 'SB', 'SLB', 'ÃƒÂŽles Salomon'),
(29, 92, 'VG', 'VGB', 'ÃƒÂŽles Vierges Britanniques'),
(30, 96, 'BN', 'BRN', 'BrunÃƒÂ©i Darussalam'),
(31, 100, 'BG', 'BGR', 'Bulgarie'),
(32, 104, 'MM', 'MMR', 'Myanmar'),
(33, 108, 'BI', 'BDI', 'Burundi'),
(34, 112, 'BY', 'BLR', 'BÃƒÂ©larus'),
(35, 116, 'KH', 'KHM', 'Cambodge'),
(36, 120, 'CM', 'CMR', 'Cameroun'),
(37, 124, 'CA', 'CAN', 'Canada'),
(38, 132, 'CV', 'CPV', 'Cap-vert'),
(39, 136, 'KY', 'CYM', 'ÃƒÂŽles CaÃƒÂ¯manes'),
(40, 140, 'CF', 'CAF', 'RÃƒÂ©publique Centrafricaine'),
(41, 144, 'LK', 'LKA', 'Sri Lanka'),
(42, 148, 'TD', 'TCD', 'Tchad'),
(43, 152, 'CL', 'CHL', 'Chili'),
(44, 156, 'CN', 'CHN', 'Chine'),
(45, 158, 'TW', 'TWN', 'TaÃƒÂ¯wan'),
(46, 162, 'CX', 'CXR', 'ÃƒÂŽle Christmas'),
(47, 166, 'CC', 'CCK', 'ÃƒÂŽles Cocos (Keeling)'),
(48, 170, 'CO', 'COL', 'Colombie'),
(49, 174, 'KM', 'COM', 'Comores'),
(50, 175, 'YT', 'MYT', 'Mayotte'),
(51, 178, 'CG', 'COG', 'RÃƒÂ©publique du Congo'),
(52, 180, 'CD', 'COD', 'RÃƒÂ©publique DÃƒÂ©mocratique du Congo'),
(53, 184, 'CK', 'COK', 'ÃƒÂŽles Cook'),
(54, 188, 'CR', 'CRI', 'Costa Rica'),
(55, 191, 'HR', 'HRV', 'Croatie'),
(56, 192, 'CU', 'CUB', 'Cuba'),
(57, 196, 'CY', 'CYP', 'Chypre'),
(58, 203, 'CZ', 'CZE', 'RÃƒÂ©publique TchÃƒÂ¨que'),
(59, 204, 'BJ', 'BEN', 'BÃƒÂ©nin'),
(60, 208, 'DK', 'DNK', 'Danemark'),
(61, 212, 'DM', 'DMA', 'Dominique'),
(62, 214, 'DO', 'DOM', 'RÃƒÂ©publique Dominicaine'),
(63, 218, 'EC', 'ECU', 'ÃƒÂ‰quateur'),
(64, 222, 'SV', 'SLV', 'El Salvador'),
(65, 226, 'GQ', 'GNQ', 'GuinÃƒÂ©e ÃƒÂ‰quatoriale'),
(66, 231, 'ET', 'ETH', 'ÃƒÂ‰thiopie'),
(67, 232, 'ER', 'ERI', 'ÃƒÂ‰rythrÃƒÂ©e'),
(68, 233, 'EE', 'EST', 'Estonie'),
(69, 234, 'FO', 'FRO', 'ÃƒÂŽles FÃƒÂ©roÃƒÂ©'),
(70, 238, 'FK', 'FLK', 'ÃƒÂŽles (malvinas) Falkland'),
(71, 239, 'GS', 'SGS', 'GÃƒÂ©orgie du Sud et les ÃƒÂŽles Sandwich du '),
(72, 242, 'FJ', 'FJI', 'Fidji'),
(73, 246, 'FI', 'FIN', 'Finlande'),
(74, 248, 'AX', 'ALA', 'ÃƒÂŽles ÃƒÂ…land'),
(75, 250, 'FR', 'FRA', 'France'),
(76, 254, 'GF', 'GUF', 'Guyane FranÃƒÂ§aise'),
(77, 258, 'PF', 'PYF', 'PolynÃƒÂ©sie FranÃƒÂ§aise'),
(78, 260, 'TF', 'ATF', 'Terres Australes FranÃƒÂ§aises'),
(79, 262, 'DJ', 'DJI', 'Djibouti'),
(80, 266, 'GA', 'GAB', 'Gabon'),
(81, 268, 'GE', 'GEO', 'GÃƒÂ©orgie'),
(82, 270, 'GM', 'GMB', 'Gambie'),
(83, 275, 'PS', 'PSE', 'Territoire Palestinien OccupÃƒÂ©'),
(84, 276, 'DE', 'DEU', 'Allemagne'),
(85, 288, 'GH', 'GHA', 'Ghana'),
(86, 292, 'GI', 'GIB', 'Gibraltar'),
(87, 296, 'KI', 'KIR', 'Kiribati'),
(88, 300, 'GR', 'GRC', 'GrÃƒÂ¨ce'),
(89, 304, 'GL', 'GRL', 'Groenland'),
(90, 308, 'GD', 'GRD', 'Grenade'),
(91, 312, 'GP', 'GLP', 'Guadeloupe'),
(92, 316, 'GU', 'GUM', 'Guam'),
(93, 320, 'GT', 'GTM', 'Guatemala'),
(94, 324, 'GN', 'GIN', 'GuinÃƒÂ©e'),
(95, 328, 'GY', 'GUY', 'Guyana'),
(96, 332, 'HT', 'HTI', 'HaÃƒÂ¯ti'),
(97, 334, 'HM', 'HMD', 'ÃƒÂŽles Heard et Mcdonald'),
(98, 336, 'VA', 'VAT', 'Saint-SiÃƒÂ¨ge (ÃƒÂ©tat de la CitÃƒÂ© du Vati'),
(99, 340, 'HN', 'HND', 'Honduras'),
(100, 344, 'HK', 'HKG', 'Hong-Kong'),
(101, 348, 'HU', 'HUN', 'Hongrie'),
(102, 352, 'IS', 'ISL', 'Islande'),
(103, 356, 'IN', 'IND', 'Inde'),
(104, 360, 'ID', 'IDN', 'IndonÃƒÂ©sie'),
(105, 364, 'IR', 'IRN', 'RÃƒÂ©publique Islamique d\'Iran'),
(106, 368, 'IQ', 'IRQ', 'Iraq'),
(107, 372, 'IE', 'IRL', 'Irlande'),
(108, 376, 'IL', 'ISR', 'IsraÃƒÂ«l'),
(109, 380, 'IT', 'ITA', 'Italie'),
(110, 384, 'CI', 'CIV', 'CÃƒÂ´te d\'Ivoire'),
(111, 388, 'JM', 'JAM', 'JamaÃƒÂ¯que'),
(112, 392, 'JP', 'JPN', 'Japon'),
(113, 398, 'KZ', 'KAZ', 'Kazakhstan'),
(114, 400, 'JO', 'JOR', 'Jordanie'),
(115, 404, 'KE', 'KEN', 'Kenya'),
(116, 408, 'KP', 'PRK', 'RÃƒÂ©publique Populaire DÃƒÂ©mocratique de Co'),
(117, 410, 'KR', 'KOR', 'RÃƒÂ©publique de CorÃƒÂ©e'),
(118, 414, 'KW', 'KWT', 'KoweÃƒÂ¯t'),
(119, 417, 'KG', 'KGZ', 'Kirghizistan'),
(120, 418, 'LA', 'LAO', 'RÃƒÂ©publique DÃƒÂ©mocratique Populaire Lao'),
(121, 422, 'LB', 'LBN', 'Liban'),
(122, 426, 'LS', 'LSO', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Lettonie'),
(124, 430, 'LR', 'LBR', 'LibÃƒÂ©ria'),
(125, 434, 'LY', 'LBY', 'Libye'),
(126, 438, 'LI', 'LIE', 'Liechtenstein'),
(127, 440, 'LT', 'LTU', 'Lituanie'),
(128, 442, 'LU', 'LUX', 'Luxembourg'),
(129, 446, 'MO', 'MAC', 'Macao'),
(130, 450, 'MG', 'MDG', 'Madagascar'),
(131, 454, 'MW', 'MWI', 'Malawi'),
(132, 458, 'MY', 'MYS', 'Malaisie'),
(133, 462, 'MV', 'MDV', 'Maldives'),
(134, 466, 'ML', 'MLI', 'Mali'),
(135, 470, 'MT', 'MLT', 'Malte'),
(136, 474, 'MQ', 'MTQ', 'Martinique'),
(137, 478, 'MR', 'MRT', 'Mauritanie'),
(138, 480, 'MU', 'MUS', 'Maurice'),
(139, 484, 'MX', 'MEX', 'Mexique'),
(140, 492, 'MC', 'MCO', 'Monaco'),
(141, 496, 'MN', 'MNG', 'Mongolie'),
(142, 498, 'MD', 'MDA', 'RÃƒÂ©publique de Moldova'),
(143, 500, 'MS', 'MSR', 'Montserrat'),
(144, 504, 'MA', 'MAR', 'Maroc'),
(145, 508, 'MZ', 'MOZ', 'Mozambique'),
(146, 512, 'OM', 'OMN', 'Oman'),
(147, 516, 'NA', 'NAM', 'Namibie'),
(148, 520, 'NR', 'NRU', 'Nauru'),
(149, 524, 'NP', 'NPL', 'NÃƒÂ©pal'),
(150, 528, 'NL', 'NLD', 'Pays-Bas'),
(151, 530, 'AN', 'ANT', 'Antilles NÃƒÂ©erlandaises'),
(152, 533, 'AW', 'ABW', 'Aruba'),
(153, 540, 'NC', 'NCL', 'Nouvelle-CalÃƒÂ©donie'),
(154, 548, 'VU', 'VUT', 'Vanuatu'),
(155, 554, 'NZ', 'NZL', 'Nouvelle-ZÃƒÂ©lande'),
(156, 558, 'NI', 'NIC', 'Nicaragua'),
(157, 562, 'NE', 'NER', 'Niger'),
(158, 566, 'NG', 'NGA', 'NigÃƒÂ©ria'),
(159, 570, 'NU', 'NIU', 'NiuÃƒÂ©'),
(160, 574, 'NF', 'NFK', 'ÃƒÂŽle Norfolk'),
(161, 578, 'NO', 'NOR', 'NorvÃƒÂ¨ge'),
(162, 580, 'MP', 'MNP', 'ÃƒÂŽles Mariannes du Nord'),
(163, 581, 'UM', 'UMI', 'ÃƒÂŽles Mineures ÃƒÂ‰loignÃƒÂ©es des ÃƒÂ‰tats'),
(164, 583, 'FM', 'FSM', 'ÃƒÂ‰tats FÃƒÂ©dÃƒÂ©rÃƒÂ©s de MicronÃƒÂ©sie'),
(165, 584, 'MH', 'MHL', 'ÃƒÂŽles Marshall'),
(166, 585, 'PW', 'PLW', 'Palaos'),
(167, 586, 'PK', 'PAK', 'Pakistan'),
(168, 591, 'PA', 'PAN', 'Panama'),
(169, 598, 'PG', 'PNG', 'Papouasie-Nouvelle-GuinÃƒÂ©e'),
(170, 600, 'PY', 'PRY', 'Paraguay'),
(171, 604, 'PE', 'PER', 'PÃƒÂ©rou'),
(172, 608, 'PH', 'PHL', 'Philippines'),
(173, 612, 'PN', 'PCN', 'Pitcairn'),
(174, 616, 'PL', 'POL', 'Pologne'),
(175, 620, 'PT', 'PRT', 'Portugal'),
(176, 624, 'GW', 'GNB', 'GuinÃƒÂ©e-Bissau'),
(177, 626, 'TL', 'TLS', 'Timor-Leste'),
(178, 630, 'PR', 'PRI', 'Porto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar'),
(180, 638, 'RE', 'REU', 'RÃƒÂ©union'),
(181, 642, 'RO', 'ROU', 'Roumanie'),
(182, 643, 'RU', 'RUS', 'FÃƒÂ©dÃƒÂ©ration de Russie'),
(183, 646, 'RW', 'RWA', 'Rwanda'),
(184, 654, 'SH', 'SHN', 'Sainte-HÃƒÂ©lÃƒÂ¨ne'),
(185, 659, 'KN', 'KNA', 'Saint-Kitts-et-Nevis'),
(186, 660, 'AI', 'AIA', 'Anguilla'),
(187, 662, 'LC', 'LCA', 'Sainte-Lucie'),
(188, 666, 'PM', 'SPM', 'Saint-Pierre-et-Miquelon'),
(189, 670, 'VC', 'VCT', 'Saint-Vincent-et-les Grenadines'),
(190, 674, 'SM', 'SMR', 'Saint-Marin'),
(191, 678, 'ST', 'STP', 'Sao TomÃƒÂ©-et-Principe'),
(192, 682, 'SA', 'SAU', 'Arabie Saoudite'),
(193, 686, 'SN', 'SEN', 'SÃƒÂ©nÃƒÂ©gal'),
(194, 690, 'SC', 'SYC', 'Seychelles'),
(195, 694, 'SL', 'SLE', 'Sierra Leone'),
(196, 702, 'SG', 'SGP', 'Singapour'),
(197, 703, 'SK', 'SVK', 'Slovaquie'),
(198, 704, 'VN', 'VNM', 'Viet Nam'),
(199, 705, 'SI', 'SVN', 'SlovÃƒÂ©nie'),
(200, 706, 'SO', 'SOM', 'Somalie'),
(201, 710, 'ZA', 'ZAF', 'Afrique du Sud'),
(202, 716, 'ZW', 'ZWE', 'Zimbabwe'),
(203, 724, 'ES', 'ESP', 'Espagne'),
(204, 732, 'EH', 'ESH', 'Sahara Occidental'),
(205, 736, 'SD', 'SDN', 'Soudan'),
(206, 740, 'SR', 'SUR', 'Suriname'),
(207, 744, 'SJ', 'SJM', 'Svalbard etÃƒÂŽle Jan Mayen'),
(208, 748, 'SZ', 'SWZ', 'Swaziland'),
(209, 752, 'SE', 'SWE', 'SuÃƒÂ¨de'),
(210, 756, 'CH', 'CHE', 'Suisse'),
(211, 760, 'SY', 'SYR', 'RÃƒÂ©publique Arabe Syrienne'),
(212, 762, 'TJ', 'TJK', 'Tadjikistan'),
(213, 764, 'TH', 'THA', 'ThaÃƒÂ¯lande'),
(214, 768, 'TG', 'TGO', 'Togo'),
(215, 772, 'TK', 'TKL', 'Tokelau'),
(216, 776, 'TO', 'TON', 'Tonga'),
(217, 780, 'TT', 'TTO', 'TrinitÃƒÂ©-et-Tobago'),
(218, 784, 'AE', 'ARE', 'ÃƒÂ‰mirats Arabes Unis'),
(219, 788, 'TN', 'TUN', 'Tunisie'),
(220, 792, 'TR', 'TUR', 'Turquie'),
(221, 795, 'TM', 'TKM', 'TurkmÃƒÂ©nistan'),
(222, 796, 'TC', 'TCA', 'ÃƒÂŽles Turks et CaÃƒÂ¯ques'),
(223, 798, 'TV', 'TUV', 'Tuvalu'),
(224, 800, 'UG', 'UGA', 'Ouganda'),
(225, 804, 'UA', 'UKR', 'Ukraine'),
(226, 807, 'MK', 'MKD', 'L\'ex-RÃƒÂ©publique Yougoslave de MacÃƒÂ©doine'),
(227, 818, 'EG', 'EGY', 'ÃƒÂ‰gypte'),
(228, 826, 'GB', 'GBR', 'Royaume-Uni'),
(229, 833, 'IM', 'IMN', 'ÃƒÂŽle de Man'),
(230, 834, 'TZ', 'TZA', 'RÃƒÂ©publique-Unie de Tanzanie'),
(231, 840, 'US', 'USA', 'ÃƒÂ‰tats-Unis'),
(232, 850, 'VI', 'VIR', 'ÃƒÂŽles Vierges des ÃƒÂ‰tats-Unis'),
(233, 854, 'BF', 'BFA', 'Burkina Faso'),
(234, 858, 'UY', 'URY', 'Uruguay'),
(235, 860, 'UZ', 'UZB', 'OuzbÃƒÂ©kistan'),
(236, 862, 'VE', 'VEN', 'Venezuela'),
(237, 876, 'WF', 'WLF', 'Wallis et Futuna'),
(238, 882, 'WS', 'WSM', 'Samoa'),
(239, 887, 'YE', 'YEM', 'YÃƒÂ©men'),
(240, 891, 'CS', 'SCG', 'Serbie-et-MontÃƒÂ©nÃƒÂ©gro'),
(241, 894, 'ZM', 'ZMB', 'Zambie');

-- --------------------------------------------------------

--
-- Table structure for table `superworkers`
--

CREATE TABLE `superworkers` (
  `pid` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `role` varchar(255) NOT NULL DEFAULT 'subadmin',
  `created_on` varchar(255) NOT NULL,
  `last_login` varchar(255) NOT NULL,
  `markup` float NOT NULL,
  `markupp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `superworkers`
--

INSERT INTO `superworkers` (`pid`, `login`, `password`, `first_name`, `last_name`, `email`, `etat`, `role`, `created_on`, `last_login`, `markup`, `markupp`) VALUES
(1, 'GSA_B2B', 'GSA_sup425010', 'Admin', 'DmcBooking', 'superadmin@dmcbooking.com', 1, '1,2,3,4,5,6,7,8,9', '2017-01-10 15:10:05', '2022-03-16 10:58:50', 0, 0),
(2, 'ghofrane', 'test;2', 'Ghofrane', 'kochkache', 'test@test.com', 1, '1,2,3,4,5,6,7,8,9', '2017-01-10 15:10:05', '2022-03-24 09:11:40', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `Verified` int(11) NOT NULL,
  `Etat` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `Code` varchar(255) NOT NULL,
  `credit` decimal(10,3) NOT NULL DEFAULT '0.000',
  `code_devise` varchar(200) DEFAULT NULL,
  `code_pays` varchar(200) DEFAULT NULL,
  `code_ville` varchar(200) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `code_postal` varchar(100) DEFAULT NULL,
  `reg_commerce` varchar(100) DEFAULT NULL,
  `num_fiscal` varchar(100) DEFAULT NULL,
  `num_licence` varchar(100) DEFAULT NULL,
  `code_iata` varchar(100) DEFAULT NULL,
  `markup` int(11) NOT NULL DEFAULT '10',
  `roles` varchar(100) DEFAULT NULL,
  `email_client` varchar(100) DEFAULT NULL,
  `tel_client` varchar(100) DEFAULT NULL,
  `canal` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `telephone`, `password`, `CreatedAt`, `Verified`, `Etat`, `firstname`, `lastname`, `Code`, `credit`, `code_devise`, `code_pays`, `code_ville`, `fax`, `adresse`, `code_postal`, `reg_commerce`, `num_fiscal`, `num_licence`, `code_iata`, `markup`, `roles`, `email_client`, `tel_client`, `canal`, `logo`) VALUES
(49, 'test', 'oussama.dev@dmcbooking.com', '+21620570277', '05a671c66aefea124cc08b76ea6d30bb', '2022-03-16 10:05:21', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', ''),
(50, 'fff', '', '', '', '0000-00-00 00:00:00', 0, 0, 'test', 'test test test', '', '0.000', NULL, 'TN', '17', '', 'test test de 1 test test de 2', '8050', 'ttt', 'ttt', 'ttt', 'ttt', 0, '1,0,3,4,0,0,0,0,0,10,0,0,0,0', 'test@test.com', '+21622333444', 'B2B', ''),
(51, 'test', '', '', '', '0000-00-00 00:00:00', 0, 0, 'test', 'test', '', '40.000', NULL, '', '', NULL, 'test test de 1\r\ntest test de 2', '8050', 'gg', 'gg', 'ggg', 'gg', 0, '1,0,0,0,0,0,0,0,0,10,11,0,13,0', 'test@test.com', '+21622333444', 'B2C', ''),
(52, 'tet', 'test@test.com', '+21622333444', '$2y$10$O9tMAZNZl88fjCL6EwcSY.ZjQ1kFhFCcGecJk2ANl8XMHW/pgnhEC', '0000-00-00 00:00:00', 0, 1, 'test', 'test', '', '0.000', NULL, 'TN', '16', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(53, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$CmkrSQKRnZutMMvS72AZyeSZU4qfzbo3p8kp3o0Wbj1UuL73jxXhG', '2022-03-22 10:27:15', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '329', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(54, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$S1ErkcRmZ.cUTEY3h7kr5O1aqUWJlRj1yINzIIj1LxsXL6R4a/7E6', '2022-03-22 11:00:22', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '329', NULL, 'avenue tarak ben ziad\r\navenue taib azzabi', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(55, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$IvmHn6NOyEyIPKgvws/qaOMo1kAfp1MKciMaLxnCID83v2sMHjy5G', '2022-03-22 12:02:56', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '509', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(56, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$zBhct5W23DlA1EM3/sIKQOuDHw032jSMGmBiCpkE7Sld7iiS7DK76', '2022-03-22 12:04:56', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '16', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(57, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$Cg1ZM5CzjsRNjkcYGmtp0umYjO2UP8MDzz3oXVZ0BXCeiRgG.Lbha', '2022-03-22 12:06:11', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '5', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(58, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$FYFEgmK78k/iNxX2VyPSIuR0p7Qu/gLFoBoLsL358pg.AN.bDysvG', '2022-03-22 12:07:24', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '5', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(59, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$Sz0Rg3azTlyjEU30Qa.2weUsgLfPN4iswFHxRI9bHe0YrrFSM6ycC', '2022-03-22 12:08:46', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '4', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(60, 'dqsdf', 'test@test.com', '+21622333444', '$2y$10$3T0.mciljV62LPu6SJdtNeXifHxLH0lia5vvhtYUDlA/x0VYEFIw.', '2022-03-22 12:09:23', 0, 0, 'test', 'test', '', '0.000', NULL, 'FR', '148', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(61, 'ghofrane', 'test@test.com', '+21622333444', '$2y$10$gqc2Y5UQjxHHZ7/FGi5phOrcV.jo9NxTqyzNyJUJWnMrv040M6sXG', '2022-03-22 13:52:51', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '329', NULL, 'test test de 1\r\ntest test de 2', '', '', '', '', '', 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2C', ''),
(62, 'rr', 'test@test.com', '+21622333444', 'f38f86718260c41c17070a9ce3134d3a', '2022-03-23 14:57:16', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '3', NULL, 'test test de 1 test test de 2', '8050', 'rrr', '', '', '', 0, '0,0,3,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2C', ''),
(63, 'rr', 'test@test.com', '+21622333444', 'f38f86718260c41c17070a9ce3134d3a', '2022-03-23 14:57:16', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '3', NULL, 'test test de 1 test test de 2', '8050', 'rrr', '', '', '', 0, '0,0,3,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2C', ''),
(64, 'rr', 'test@test.com', '+21622333444', 'f38f86718260c41c17070a9ce3134d3a', '2022-03-23 15:02:19', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '3', NULL, 'test test de 1 test test de 2', '8050', 'rrr', '', '', '', 0, '0,0,3,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2C', ''),
(65, 'rr', 'test@test.com', '+21622333444', 'f38f86718260c41c17070a9ce3134d3a', '2022-03-23 15:34:59', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '3', NULL, 'test test de 1\r\ntest test de 2', '8050', 'rrr', '', '', '', 0, '0,0,3,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2C', ''),
(66, 'sqdqf', 'test@test.com', '+21622333444', 'ced141265b96c037a3cab9dee0f3b4fa', '2022-03-23 15:38:10', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '6', NULL, 'test test de 1\r\ntest test de 2', '8050', 'ttt', 'ttt', 'ttt', 'tttt', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2C', ''),
(67, 'ddd', 'test@test.com', '+21622333444', 'd41d8cd98f00b204e9800998ecf8427e', '2022-03-23 15:46:15', 0, 0, '', 'test test', '', '0.000', NULL, 'TN', '17', NULL, 'test test de 1\r\ntest test de 2', '8050', 'ttt', 'tt', 'tt', 'tt', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', '217867780-20220323154440.png'),
(68, 'ddffff', 'test@test.com', '+21622333444', '50f84daf3a6dfd6a9f20c9f8ef428942', '2022-03-23 16:21:02', 0, 0, 'test', 'test', '', '0.000', NULL, 'TN', '507', NULL, 'test test de 1\r\ntest test de 2', '8050', 'ggg', 'ggg', 'ggg', 'ggg', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2E', ''),
(69, 'test', 'test@test.com', '+21622333444', '098f6bcd4621d373cade4e832627b4f6', '2022-03-24 09:17:26', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '33', NULL, 'test test de 1\r\ntest test de 2', '8050', '215896', '256', '25', '2563', 2, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', '134079699-20220324091701.png'),
(70, 'zzz', 'test@test.com', '+21622333444', 'f3abb86bd34cf4d52698f14c0da1dc60', '2022-03-24 09:22:38', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '70', NULL, 'test test de 1\r\ntest test de 2', '8050', '1258', '158', '2333', '1236', 3, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', '757363622-20220324092105.png'),
(71, 'ffff', 'test@test.com', '+21622333444', 'c1925243771e383c160525e7475fbb37', '2022-03-24 09:23:29', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', 'fffff', 'fff', 'fff', 'ffff', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', ''),
(72, 'ffff', 'test@test.com', '+21622333444', 'c1925243771e383c160525e7475fbb37', '2022-03-24 09:25:15', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', 'fffff', 'fff', 'fff', 'ffff', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', ''),
(73, 'ffff', 'test@test.com', '+21622333444', 'c1925243771e383c160525e7475fbb37', '2022-03-24 09:25:20', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', 'fffff', 'fff', 'fff', 'ffff', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', ''),
(74, 'ffff', 'test@test.com', '+21622333444', 'c1925243771e383c160525e7475fbb37', '2022-03-24 09:25:44', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', 'fffff', 'fff', 'fff', 'ffff', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', ''),
(75, 'ffff', 'test@test.com', '+21622333444', 'c1925243771e383c160525e7475fbb37', '2022-03-24 09:26:41', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', 'fffff', 'fff', 'fff', 'ffff', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', ''),
(76, 'kkk', 'test@test.com', '+21622333444', '115cb53deea1f407b6a4d3513fc492b0', '2022-03-24 09:33:13', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '25', NULL, 'test test de 1\r\ntest test de 2', '8050', '555', '555', '6666', '555', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', ''),
(77, 'frggg', 'test@test.com', '+21622333444', 'ba248c985ace94863880921d8900c53f', '2022-03-24 09:38:49', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '40', NULL, 'test test de 1\r\ntest test de 2', '8050', '444', '4', '44', '44', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', ''),
(78, 'test', 'test@test.com', '+21622333444', 'c74fa4e634fe328abf54a7d94be357e2', '2022-03-24 10:35:23', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '47', NULL, 'test test de 1\r\ntest test de 2', '8050', '123', '156', '222', '123', 0, '1,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', '817993991-20220324103421.png'),
(79, 'ttt', 'test@test.com', '+21622333444', '32bf0e6fcff51e53bd74e70ba1d622b2', '2022-03-24 10:56:31', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '32', NULL, 'test test de 1\r\ntest test de 2', '8050', 'ttt', 'ttt', 'ttt', 'tttt', 0, '0,0,0,0,0,0,0,0,0,10,0,0,0,0', NULL, NULL, 'B2B', '688123496-20220324105605.png'),
(80, 'ttt', 'test@test.com', '+21622333444', '9990775155c3518a0d7917f7780b24aa', '2022-03-24 10:57:42', 0, 0, '', 'test test', '', '0.000', NULL, 'DZ', '25', NULL, 'test test de 1\r\ntest test de 2', '8050', 'tttt', 'ttt', 'ttt', 'ttt', 0, '1,0,0,0,0,0,0,0,0,0,0,0,0,0', NULL, NULL, 'B2B', '543702822-20220324105737.png');

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

CREATE TABLE `ville` (
  `id_ville` int(10) UNSIGNED NOT NULL,
  `flag_admin_last_update` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `id_admin_last_update` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `date_heure_last_update` datetime NOT NULL,
  `nom_eng` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ens` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_deu` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_nld` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_fra` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_esp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_cat` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ita` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_por` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_bra` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_nob` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_fin` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_swe` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_dan` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_cze` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_hun` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ron` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_jpn` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_zho` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_pol` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ell` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_rus` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_tur` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_bul` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ara` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_kor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_heb` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_lav` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ukr` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_ind` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_mal` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_tha` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_est` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_hrv` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_lit` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_slk` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_srp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_slv` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_vie` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_tgl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom_isl` varchar(255) CHARACTER SET utf8 NOT NULL,
  `id_pays` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `etat_activer` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `etat_delete` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`id_ville`, `flag_admin_last_update`, `id_admin_last_update`, `date_heure_last_update`, `nom_eng`, `nom_ens`, `nom_deu`, `nom_nld`, `nom_fra`, `nom_esp`, `nom_cat`, `nom_ita`, `nom_por`, `nom_bra`, `nom_nob`, `nom_fin`, `nom_swe`, `nom_dan`, `nom_cze`, `nom_hun`, `nom_ron`, `nom_jpn`, `nom_zho`, `nom_pol`, `nom_ell`, `nom_rus`, `nom_tur`, `nom_bul`, `nom_ara`, `nom_kor`, `nom_heb`, `nom_lav`, `nom_ukr`, `nom_ind`, `nom_mal`, `nom_tha`, `nom_est`, `nom_hrv`, `nom_lit`, `nom_slk`, `nom_srp`, `nom_slv`, `nom_vie`, `nom_tgl`, `nom_isl`, `id_pays`, `etat_activer`, `etat_delete`) VALUES
(1, 2, 1, '2016-08-08 00:00:00', 'Ariana', '', '', '', 'Ariana', 'Ariana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(2, 0, 1, '2016-08-08 00:00:00', 'BÃƒÂ©ja', '', '', '', 'BÃƒÂ©ja', 'BÃ©ja', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(3, 0, 1, '2016-08-08 00:00:00', 'Ben Arous', '', '', '', 'Ben Arous', 'Ben Arous', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(4, 0, 1, '2016-08-08 00:00:00', 'Bizerte', '', '', '', 'Bizerte', 'Bizerte', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(5, 0, 1, '2016-08-08 00:00:00', 'GabÃƒÂ¨s', '', '', '', 'GabÃƒÂ¨s', 'GabÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(6, 0, 1, '2016-08-08 00:00:00', 'Gafsa', '', '', '', 'Gafsa', 'Gafsa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(7, 0, 1, '2016-08-08 00:00:00', 'Jendouba', '', '', '', 'Jendouba', 'Jendouba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(8, 0, 1, '2016-08-08 00:00:00', 'Kairouan', '', '', '', 'Kairouan', 'Kairouan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(9, 0, 1, '2016-08-08 00:00:00', 'Kasserine', '', '', '', 'Kasserine', 'Kasserine', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(10, 0, 1, '2016-08-08 00:00:00', 'KÃƒÂ©bili', '', '', '', 'KÃƒÂ©bili', 'KÃ©bili', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(11, 0, 1, '2016-08-08 00:00:00', 'La Manouba', '', '', '', 'La Manouba', 'La Manouba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(12, 0, 1, '2016-08-08 00:00:00', 'Le Kef', '', '', '', 'Le Kef', 'Le Kef', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(13, 0, 1, '2016-08-08 00:00:00', 'Mahdia', '', '', '', 'Mahdia', 'Mahdia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(14, 0, 1, '2016-08-08 00:00:00', 'MÃƒÂ©denine', '', '', '', 'MÃƒÂ©denine', 'MÃ©denine', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(15, 0, 1, '2016-08-08 00:00:00', 'Monastir', '', '', '', 'Monastir', 'Monastir', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(16, 0, 1, '2016-08-08 00:00:00', 'Nabeul', '', '', '', 'Nabeul', 'Nabeul', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(17, 0, 1, '2016-08-08 00:00:00', 'Sfax', '', '', '', 'Sfax', 'Sfax', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(18, 0, 1, '2016-08-08 00:00:00', 'Sidi Bouzid', '', '', '', 'Sidi Bouzid', 'Sidi Bouzid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(19, 0, 1, '2016-08-08 00:00:00', 'Siliana', '', '', '', 'Siliana', 'Siliana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(20, 0, 1, '2016-08-08 00:00:00', 'Sousse', '', '', '', 'Sousse', 'Sousse', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(21, 0, 1, '2016-08-08 00:00:00', 'Tataouine', '', '', '', 'Tataouine', 'Tataouine', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(22, 0, 1, '2016-08-08 00:00:00', 'Tozeur', '', '', '', 'Tozeur', 'Tozeur', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(23, 0, 1, '2016-08-08 00:00:00', 'Tunis', '', '', '', 'Tunis', 'Tunis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(24, 0, 1, '2016-08-08 00:00:00', 'Zaghouan', '', '', '', 'Zaghouan', 'Zaghouan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(25, 0, 1, '2016-08-08 00:00:00', 'Adrar', '', '', '', 'Adrar', 'Adrar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(26, 0, 1, '2016-08-08 00:00:00', 'Chlef', '', '', '', 'Chlef', 'Chlef', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(27, 0, 1, '2016-08-08 00:00:00', 'Laghouat', '', '', '', 'Laghouat', 'Laghouat', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(28, 0, 1, '2016-08-08 00:00:00', 'Oum El Bouaghi', '', '', '', 'Oum El Bouaghi', 'Oum El Bouaghi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(29, 0, 1, '2016-08-08 00:00:00', 'Batna', '', '', '', 'Batna', 'Batna', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(30, 0, 1, '2016-08-08 00:00:00', 'BÃƒÂ©jaÃƒÂ¯a', '', '', '', 'BÃƒÂ©jaÃƒÂ¯a', 'BÃ©jaÃ¯a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(31, 0, 1, '2016-08-08 00:00:00', 'Biskra', '', '', '', 'Biskra', 'Biskra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(32, 0, 1, '2016-08-08 00:00:00', 'BÃƒÂ©char', '', '', '', 'BÃƒÂ©char', 'BÃ©char', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(33, 0, 1, '2016-08-08 00:00:00', 'Blida', '', '', '', 'Blida', 'Blida', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(34, 0, 1, '2016-08-08 00:00:00', 'Bouira', '', '', '', 'Bouira', 'Bouira', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(35, 0, 1, '2016-08-08 00:00:00', 'Tamanrasset', '', '', '', 'Tamanrasset', 'Tamanrasset', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(36, 0, 1, '2016-08-08 00:00:00', 'TÃƒÂ©bessa', '', '', '', 'TÃƒÂ©bessa', 'TÃ©bessa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(37, 0, 1, '2016-08-08 00:00:00', 'Tlemcen', '', '', '', 'Tlemcen', 'Tlemcen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(38, 0, 1, '2016-08-08 00:00:00', 'Tiaret', '', '', '', 'Tiaret', 'Tiaret', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(39, 0, 1, '2016-08-08 00:00:00', 'Tizi Ouzou', '', '', '', 'Tizi Ouzou', 'Tizi Ouzou', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(40, 0, 1, '2016-08-08 00:00:00', 'Alger', '', '', '', 'Alger', 'Alger', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(41, 0, 1, '2016-08-08 00:00:00', 'Djelfa', '', '', '', 'Djelfa', 'Djelfa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(42, 0, 1, '2016-08-08 00:00:00', 'Jijel', '', '', '', 'Jijel', 'Jijel', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(43, 0, 1, '2016-08-08 00:00:00', 'SÃƒÂ©tif', '', '', '', 'SÃƒÂ©tif', 'SÃ©tif', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(44, 0, 1, '2016-08-08 00:00:00', 'SaÃƒÂ¯da', '', '', '', 'SaÃƒÂ¯da', 'SaÃ¯da', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(45, 0, 1, '2016-08-08 00:00:00', 'Skikda', '', '', '', 'Skikda', 'Skikda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(46, 0, 1, '2016-08-08 00:00:00', 'Sidi Bel AbbÃƒÂ¨s', '', '', '', 'Sidi Bel AbbÃƒÂ¨s', 'Sidi Bel AbbÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(47, 0, 1, '2016-08-08 00:00:00', 'Annaba', '', '', '', 'Annaba', 'Annaba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(48, 0, 1, '2016-08-08 00:00:00', 'Guelma', '', '', '', 'Guelma', 'Guelma', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(49, 0, 1, '2016-08-08 00:00:00', 'Constantine', '', '', '', 'Constantine', 'Constantine', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(50, 0, 1, '2016-08-08 00:00:00', 'MÃ©dÃ©a', '', '', '', 'MÃƒÂ©dÃƒÂ©a', 'MÃ©dÃ©a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(51, 0, 1, '2016-08-08 00:00:00', 'Mostaganem', '', '', '', 'Mostaganem', 'Mostaganem', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(52, 0, 1, '2016-08-08 00:00:00', 'M\'Sila', '', '', '', 'M\'Sila', 'M\'Sila', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(53, 0, 1, '2016-08-08 00:00:00', 'Mascara', '', '', '', 'Mascara', 'Mascara', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(54, 0, 1, '2016-08-08 00:00:00', 'Ouargla', '', '', '', 'Ouargla', 'Ouargla', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(55, 0, 1, '2016-08-08 00:00:00', 'Oran', '', '', '', 'Oran', 'Oran', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(56, 0, 1, '2016-08-08 00:00:00', 'Bayadh', '', '', '', 'Bayadh', 'Bayadh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(57, 0, 1, '2016-08-08 00:00:00', 'Illizi', '', '', '', 'Illizi', 'Illizi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(58, 0, 1, '2016-08-08 00:00:00', 'Bordj Bou Arreridj', '', '', '', 'Bordj Bou Arreridj', 'Bordj Bou Arreridj', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(59, 0, 1, '2016-08-08 00:00:00', 'BoumerdÃƒÂ¨s', '', '', '', 'BoumerdÃƒÂ¨s', 'BoumerdÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(60, 0, 1, '2016-08-08 00:00:00', 'El Tarf', '', '', '', 'El Tarf', 'El Tarf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(61, 0, 1, '2016-08-08 00:00:00', 'Tindouf', '', '', '', 'Tindouf', 'Tindouf', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(62, 0, 1, '2016-08-08 00:00:00', 'Tissemsilt', '', '', '', 'Tissemsilt', 'Tissemsilt', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(63, 0, 1, '2016-08-08 00:00:00', 'El Oued', '', '', '', 'El Oued', 'El Oued', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(64, 0, 1, '2016-08-08 00:00:00', 'Khenchela', '', '', '', 'Khenchela', 'Khenchela', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(65, 0, 1, '2016-08-08 00:00:00', 'Souk Ahras', '', '', '', 'Souk Ahras', 'Souk Ahras', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(66, 0, 1, '2016-08-08 00:00:00', 'Tipaza', '', '', '', 'Tipaza', 'Tipaza', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(67, 0, 1, '2016-08-08 00:00:00', 'Mila', '', '', '', 'Mila', 'Mila', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(68, 0, 1, '2016-08-08 00:00:00', 'AÃƒÂ¯n Defla', '', '', '', 'AÃƒÂ¯n Defla', 'AÃ¯n Defla', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(69, 0, 1, '2016-08-08 00:00:00', 'NaÃ¢ma', '', '', '', 'NaÃƒÂ¢ma', 'NaÃ¢ma', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(70, 0, 1, '2016-08-08 00:00:00', 'AÃƒÂ¯n TÃƒÂ©mouchent', '', '', '', 'AÃƒÂ¯n TÃƒÂ©mouchent', 'AÃ¯n TÃ©mouchent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(71, 0, 1, '2016-08-08 00:00:00', 'GhardaÃƒÂ¯a', '', '', '', 'GhardaÃƒÂ¯a', 'GhardaÃ¯a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(72, 0, 1, '2016-08-08 00:00:00', 'Relizane', '', '', '', 'Relizane', 'Relizane', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 4, 1, 0),
(73, 0, 1, '2016-08-08 00:00:00', 'Bourg-en-Bresse', '', '', '', 'Bourg-en-Bresse', 'Bourg-en-Bresse', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(74, 0, 1, '2016-08-08 00:00:00', 'Laon', '', '', '', 'Laon', 'Laon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(75, 0, 1, '2016-08-08 00:00:00', 'Moulins', '', '', '', 'Moulins', 'Moulins', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(76, 0, 1, '2016-08-08 00:00:00', 'Digne-les-Bains', '', '', '', 'Digne-les-Bains', 'Digne-les-Bains', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(77, 0, 1, '2016-08-08 00:00:00', 'Nice', '', '', '', 'Nice', 'Nice', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(78, 0, 1, '2016-08-08 00:00:00', 'Charleville-MÃƒÂ©ziÃƒÂ¨res', '', '', '', 'Charleville-MÃƒÂ©ziÃƒÂ¨res', 'Charleville-MÃ©ziÃ¨res', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(79, 0, 1, '2016-08-08 00:00:00', 'Privas', '', '', '', 'Privas', 'Privas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(80, 0, 1, '2016-08-08 00:00:00', 'Foix', '', '', '', 'Foix', 'Foix', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(81, 0, 1, '2016-08-08 00:00:00', 'Troyes', '', '', '', 'Troyes', 'Troyes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(82, 0, 1, '2016-08-08 00:00:00', 'Carcassonne', '', '', '', 'Carcassonne', 'Carcassonne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(83, 0, 1, '2016-08-08 00:00:00', 'Rodez', '', '', '', 'Rodez', 'Rodez', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(84, 0, 1, '2016-08-08 00:00:00', 'Strasbourg', '', '', '', 'Strasbourg', 'Strasbourg', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(85, 0, 1, '2016-08-08 00:00:00', 'Marseille', '', '', '', 'Marseille', 'Marseille', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(86, 0, 1, '2016-08-08 00:00:00', 'Caen', '', '', '', 'Caen', 'Caen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(87, 0, 1, '2016-08-08 00:00:00', 'Aurillac', '', '', '', 'Aurillac', 'Aurillac', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(88, 0, 1, '2016-08-08 00:00:00', 'AngoulÃƒÂªme', '', '', '', 'AngoulÃƒÂªme', 'AngoulÃªme', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(89, 0, 1, '2016-08-08 00:00:00', 'La Rochelle', '', '', '', 'La Rochelle', 'La Rochelle', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(90, 0, 1, '2016-08-08 00:00:00', 'Bourges', '', '', '', 'Bourges', 'Bourges', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(91, 0, 1, '2016-08-08 00:00:00', 'Tulle', '', '', '', 'Tulle', 'Tulle', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(92, 0, 1, '2016-08-08 00:00:00', 'Ajaccio', '', '', '', 'Ajaccio', 'Ajaccio', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(93, 0, 1, '2016-08-08 00:00:00', 'GuÃƒÂ©ret', '', '', '', 'GuÃƒÂ©ret', 'GuÃ©ret', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(94, 0, 1, '2016-08-08 00:00:00', 'Dijon', '', '', '', 'Dijon', 'Dijon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(95, 0, 1, '2016-08-08 00:00:00', 'Saint-Brieuc', '', '', '', 'Saint-Brieuc', 'Saint-Brieuc', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(96, 0, 1, '2016-08-08 00:00:00', 'Niort', '', '', '', 'Niort', 'Niort', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(97, 0, 1, '2016-08-08 00:00:00', 'PÃƒÂ©rigueux', '', '', '', 'PÃƒÂ©rigueux', 'PÃ©rigueux', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(98, 0, 1, '2016-08-08 00:00:00', 'BesanÃƒÂ§on', '', '', '', 'BesanÃƒÂ§on', 'BesanÃ§on', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(99, 0, 1, '2016-08-08 00:00:00', 'Valence', '', '', '', 'Valence', 'Valence', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(100, 0, 1, '2016-08-08 00:00:00', 'ÃƒÂ‰vry', '', '', '', 'ÃƒÂ‰vry', 'Ã‰vry', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(101, 0, 1, '2016-08-08 00:00:00', 'ÃƒÂ‰vreux', '', '', '', 'ÃƒÂ‰vreux', 'Ã‰vreux', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(102, 0, 1, '2016-08-08 00:00:00', 'Chartres', '', '', '', 'Chartres', 'Chartres', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(103, 0, 1, '2016-08-08 00:00:00', 'Quimper', '', '', '', 'Quimper', 'Quimper', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(104, 0, 1, '2016-08-08 00:00:00', 'NÃƒÂ®mes', '', '', '', 'NÃƒÂ®mes', 'NÃ®mes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(105, 0, 1, '2016-08-08 00:00:00', 'Auch', '', '', '', 'Auch', 'Auch', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(106, 0, 1, '2016-08-08 00:00:00', 'Bordeaux', '', '', '', 'Bordeaux', 'Bordeaux', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(107, 0, 1, '2016-08-08 00:00:00', 'Basse-Terre', '', '', '', 'Basse-Terre', 'Basse-Terre', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(108, 0, 1, '2016-08-08 00:00:00', 'Cayenne', '', '', '', 'Cayenne', 'Cayenne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(109, 0, 1, '2016-08-08 00:00:00', 'Colmar', '', '', '', 'Colmar', 'Colmar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(110, 0, 1, '2016-08-08 00:00:00', 'Bastia', '', '', '', 'Bastia', 'Bastia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(111, 0, 1, '2016-08-08 00:00:00', 'Toulouse', '', '', '', 'Toulouse', 'Toulouse', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(112, 0, 1, '2016-08-08 00:00:00', 'Le Puy-en-Velay', '', '', '', 'Le Puy-en-Velay', 'Le Puy-en-Velay', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(113, 0, 1, '2016-08-08 00:00:00', 'Chaumont', '', '', '', 'Chaumont', 'Chaumont', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(114, 0, 1, '2016-08-08 00:00:00', 'Annecy', '', '', '', 'Annecy', 'Annecy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(115, 0, 1, '2016-08-08 00:00:00', 'Vesoul', '', '', '', 'Vesoul', 'Vesoul', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(116, 0, 1, '2016-08-08 00:00:00', 'Limoges', '', '', '', 'Limoges', 'Limoges', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(117, 0, 1, '2016-08-08 00:00:00', 'Gap', '', '', '', 'Gap', 'Gap', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(118, 0, 1, '2016-08-08 00:00:00', 'Tarbes', '', '', '', 'Tarbes', 'Tarbes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(119, 0, 1, '2016-08-08 00:00:00', 'Nanterre', '', '', '', 'Nanterre', 'Nanterre', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(120, 0, 1, '2016-08-08 00:00:00', 'Montpellier', '', '', '', 'Montpellier', 'Montpellier', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(121, 0, 1, '2016-08-08 00:00:00', 'Rennes', '', '', '', 'Rennes', 'Rennes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(122, 0, 1, '2016-08-08 00:00:00', 'ChÃƒÂ¢teauroux', '', '', '', 'ChÃƒÂ¢teauroux', 'ChÃ¢teauroux', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(123, 0, 1, '2016-08-08 00:00:00', 'Tours', '', '', '', 'Tours', 'Tours', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(124, 0, 1, '2016-08-08 00:00:00', 'Grenoble', '', '', '', 'Grenoble', 'Grenoble', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(125, 0, 1, '2016-08-08 00:00:00', 'Lons-le-Saunier', '', '', '', 'Lons-le-Saunier', 'Lons-le-Saunier', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(126, 0, 1, '2016-08-08 00:00:00', 'Saint-Denis', '', '', '', 'Saint-Denis', 'Saint-Denis', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(127, 0, 1, '2016-08-08 00:00:00', 'Mont-de-Marsan', '', '', '', 'Mont-de-Marsan', 'Mont-de-Marsan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(128, 0, 1, '2016-08-08 00:00:00', 'Blois', '', '', '', 'Blois', 'Blois', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(129, 0, 1, '2016-08-08 00:00:00', 'Saint-ÃƒÂ‰tienne', '', '', '', 'Saint-ÃƒÂ‰tienne', 'Saint-Ã‰tienne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(130, 0, 1, '2016-08-08 00:00:00', 'Nantes', '', '', '', 'Nantes', 'Nantes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(131, 0, 1, '2016-08-08 00:00:00', 'OrlÃƒÂ©ans', '', '', '', 'OrlÃƒÂ©ans', 'OrlÃ©ans', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(132, 0, 1, '2016-08-08 00:00:00', 'Cahors', '', '', '', 'Cahors', 'Cahors', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(133, 0, 1, '2016-08-08 00:00:00', 'Agen', '', '', '', 'Agen', 'Agen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(134, 0, 1, '2016-08-08 00:00:00', 'Mende', '', '', '', 'Mende', 'Mende', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(135, 0, 1, '2016-08-08 00:00:00', 'Angers', '', '', '', 'Angers', 'Angers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(136, 0, 1, '2016-08-08 00:00:00', 'Saint-LÃƒÂ´', '', '', '', 'Saint-LÃƒÂ´', 'Saint-LÃ´', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(137, 0, 1, '2016-08-08 00:00:00', 'ChÃƒÂ¢lons-en-Champagne', '', '', '', 'ChÃƒÂ¢lons-en-Champagne', 'ChÃ¢lons-en-Champagne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(138, 0, 1, '2016-08-08 00:00:00', 'Fort-de-France', '', '', '', 'Fort-de-France', 'Fort-de-France', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(139, 0, 1, '2016-08-08 00:00:00', 'Laval', '', '', '', 'Laval', 'Laval', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(140, 0, 1, '2016-08-08 00:00:00', 'Mamoudzou', '', '', '', 'Mamoudzou', 'Mamoudzou', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(141, 0, 1, '2016-08-08 00:00:00', 'Nancy', '', '', '', 'Nancy', 'Nancy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(142, 0, 1, '2016-08-08 00:00:00', 'Bar-le-Duc', '', '', '', 'Bar-le-Duc', 'Bar-le-Duc', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(143, 0, 1, '2016-08-08 00:00:00', 'Vannes', '', '', '', 'Vannes', 'Vannes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(144, 0, 1, '2016-08-08 00:00:00', 'Metz', '', '', '', 'Metz', 'Metz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(145, 0, 1, '2016-08-08 00:00:00', 'Nevers', '', '', '', 'Nevers', 'Nevers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(146, 0, 1, '2016-08-08 00:00:00', 'Lille', '', '', '', 'Lille', 'Lille', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(147, 0, 1, '2016-08-08 00:00:00', 'Beauvais', '', '', '', 'Beauvais', 'Beauvais', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(148, 0, 1, '2016-08-08 00:00:00', 'AlenÃƒÂ§on', '', '', '', 'AlenÃƒÂ§on', 'AlenÃ§on', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(149, 0, 1, '2016-08-08 00:00:00', 'Paris', '', '', '', 'Paris', 'Paris', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(150, 0, 1, '2016-08-08 00:00:00', 'Arras', '', '', '', 'Arras', 'Arras', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(151, 0, 1, '2016-08-08 00:00:00', 'Clermont-Ferrand', '', '', '', 'Clermont-Ferrand', 'Clermont-Ferrand', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(152, 0, 1, '2016-08-08 00:00:00', 'Pau', '', '', '', 'Pau', 'Pau', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(153, 0, 1, '2016-08-08 00:00:00', 'Perpignan', '', '', '', 'Perpignan', 'Perpignan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(154, 0, 1, '2016-08-08 00:00:00', 'Lyon', '', '', '', 'Lyon', 'Lyon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(155, 0, 1, '2016-08-08 00:00:00', 'Le Mans', '', '', '', 'Le Mans', 'Le Mans', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(156, 0, 1, '2016-08-08 00:00:00', 'ChambÃƒÂ©ry', '', '', '', 'ChambÃƒÂ©ry', 'ChambÃ©ry', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(157, 0, 1, '2016-08-08 00:00:00', 'MÃƒÂ¢con', '', '', '', 'MÃƒÂ¢con', 'MÃ¢con', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(158, 0, 1, '2016-08-08 00:00:00', 'Melun', '', '', '', 'Melun', 'Melun', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(159, 0, 1, '2016-08-08 00:00:00', 'Rouen', '', '', '', 'Rouen', 'Rouen', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(160, 0, 1, '2016-08-08 00:00:00', 'Bobigny', '', '', '', 'Bobigny', 'Bobigny', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(161, 0, 1, '2016-08-08 00:00:00', 'Amiens', '', '', '', 'Amiens', 'Amiens', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(162, 0, 1, '2016-08-08 00:00:00', 'Albi', '', '', '', 'Albi', 'Albi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(163, 0, 1, '2016-08-08 00:00:00', 'Montauban', '', '', '', 'Montauban', 'Montauban', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(164, 0, 1, '2016-08-08 00:00:00', 'Belfort', '', '', '', 'Belfort', 'Belfort', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(165, 0, 1, '2016-08-08 00:00:00', 'Cergy', '', '', '', 'Cergy', 'Cergy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(166, 0, 1, '2016-08-08 00:00:00', 'CrÃƒÂ©teil', '', '', '', 'CrÃƒÂ©teil', 'CrÃ©teil', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(167, 0, 1, '2016-08-08 00:00:00', 'Toulon', '', '', '', 'Toulon', 'Toulon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(168, 0, 1, '2016-08-08 00:00:00', 'Avignon', '', '', '', 'Avignon', 'Avignon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(169, 0, 1, '2016-08-08 00:00:00', 'La Roche-sur-Yon', '', '', '', 'La Roche-sur-Yon', 'La Roche-sur-Yon', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(170, 0, 1, '2016-08-08 00:00:00', 'Poitiers', '', '', '', 'Poitiers', 'Poitiers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(171, 0, 1, '2016-08-08 00:00:00', 'ÃƒÂ‰pinal', '', '', '', 'ÃƒÂ‰pinal', 'Ã‰pinal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(172, 0, 1, '2016-08-08 00:00:00', 'Auxerre', '', '', '', 'Auxerre', 'Auxerre', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(173, 0, 1, '2016-08-08 00:00:00', 'Versailles', '', '', '', 'Versailles', 'Versailles', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 75, 1, 0),
(174, 0, 1, '2016-08-08 00:00:00', 'Madrid', '', '', '', 'Madrid', 'Madrid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(175, 0, 1, '2016-08-08 00:00:00', 'Barcelone', '', '', '', 'Barcelone', 'Barcelone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(176, 0, 1, '2016-08-08 00:00:00', 'Valence', '', '', '', 'Valence', 'Valence', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(177, 0, 1, '2016-08-08 00:00:00', 'SÃ©ville', '', '', '', 'SÃƒÂ©ville', 'SÃ©ville', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(178, 0, 1, '2016-08-08 00:00:00', 'Saragosse', '', '', '', 'Saragosse', 'Saragosse', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(179, 0, 1, '2016-08-08 00:00:00', 'Malaga', '', '', '', 'Malaga', 'Malaga', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(180, 0, 1, '2016-08-08 00:00:00', 'Murcie', '', '', '', 'Murcie', 'Murcie', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(181, 0, 1, '2016-08-08 00:00:00', 'Palma de Majorque', '', '', '', 'Palma de Majorque', 'Palma de Majorque', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(182, 0, 1, '2016-08-08 00:00:00', 'Las Palmas de Gran Canaria', '', '', '', 'Las Palmas de Gran Canaria', 'Las Palmas de Gran Canaria', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(183, 0, 1, '2016-08-08 00:00:00', 'Bilbao', '', '', '', 'Bilbao', 'Bilbao', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(184, 0, 1, '2016-08-08 00:00:00', 'Alicante', '', '', '', 'Alicante', 'Alicante', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(185, 0, 1, '2016-08-08 00:00:00', 'Cordoue', '', '', '', 'Cordoue', 'Cordoue', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(186, 0, 1, '2016-08-08 00:00:00', 'Valladolid', '', '', '', 'Valladolid', 'Valladolid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(187, 0, 1, '2016-08-08 00:00:00', 'Vigo', '', '', '', 'Vigo', 'Vigo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(188, 0, 1, '2016-08-08 00:00:00', 'GijÃ³n', '', '', '', 'GijÃƒÂ³n', 'GijÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(189, 0, 1, '2016-08-08 00:00:00', 'L\'Hospitalet de Llobregat', '', '', '', 'L\'Hospitalet de Llobregat', 'L\'Hospitalet de Llobregat', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(190, 0, 1, '2016-08-08 00:00:00', 'La Corogne', '', '', '', 'La Corogne', 'La Corogne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(191, 0, 1, '2016-08-08 00:00:00', 'Grenade', '', '', '', 'Grenade', 'Grenade', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(192, 0, 1, '2016-08-08 00:00:00', 'Vitoria-Gasteiz', '', '', '', 'Vitoria-Gasteiz', 'Vitoria-Gasteiz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(193, 0, 1, '2016-08-08 00:00:00', 'Elche', '', '', '', 'Elche', 'Elche', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(194, 0, 1, '2016-08-08 00:00:00', 'Santa Cruz de Tenerife', '', '', '', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(195, 0, 1, '2016-08-08 00:00:00', 'Oviedo', '', '', '', 'Oviedo', 'Oviedo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(196, 0, 1, '2016-08-08 00:00:00', 'Badalona', '', '', '', 'Badalona', 'Badalona', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(197, 0, 1, '2016-08-08 00:00:00', 'CarthagÃ¨ne', '', '', '', 'CarthagÃƒÂ¨ne', 'CarthagÃ¨ne', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(198, 0, 1, '2016-08-08 00:00:00', 'MÃ³stoles', '', '', '', 'MÃƒÂ³stoles', 'MÃ³stoles', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(199, 0, 1, '2016-08-08 00:00:00', 'Terrassa', '', '', '', 'Terrassa', 'Terrassa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(200, 0, 1, '2016-08-08 00:00:00', 'Jerez de la Frontera', '', '', '', 'Jerez de la Frontera', 'Jerez de la Frontera', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(201, 0, 1, '2016-08-08 00:00:00', 'Sabadell', '', '', '', 'Sabadell', 'Sabadell', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(202, 0, 1, '2016-08-08 00:00:00', 'AlcalÃ¡ de Henares', '', '', '', 'AlcalÃƒÂ¡ de Henares', 'AlcalÃ¡ de Henares', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(203, 0, 1, '2016-08-08 00:00:00', 'Pampelune', '', '', '', 'Pampelune', 'Pampelune', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(204, 0, 1, '2016-08-08 00:00:00', 'Fuenlabrada', '', '', '', 'Fuenlabrada', 'Fuenlabrada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(205, 0, 1, '2016-08-08 00:00:00', 'AlmerÃ­a', '', '', '', 'AlmerÃƒÂ­a', 'AlmerÃ­a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(206, 0, 1, '2016-08-08 00:00:00', 'Saint-SÃ©bastien', '', '', '', 'Saint-SÃƒÂ©bastien', 'Saint-SÃ©bastien', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(207, 0, 1, '2016-08-08 00:00:00', 'LeganÃ©s', '', '', '', 'LeganÃƒÂ©s', 'LeganÃ©s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(208, 0, 1, '2016-08-08 00:00:00', 'Santander', '', '', '', 'Santander', 'Santander', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(209, 0, 1, '2016-08-08 00:00:00', 'CastellÃ³n de la Plana', '', '', '', 'CastellÃƒÂ³n de la Plana', 'CastellÃ³n de la Plana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(210, 0, 1, '2016-08-08 00:00:00', 'Burgos', '', '', '', 'Burgos', 'Burgos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(211, 0, 1, '2016-08-08 00:00:00', 'AlcorcÃ³n', '', '', '', 'AlcorcÃƒÂ³n', 'AlcorcÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0);
INSERT INTO `ville` (`id_ville`, `flag_admin_last_update`, `id_admin_last_update`, `date_heure_last_update`, `nom_eng`, `nom_ens`, `nom_deu`, `nom_nld`, `nom_fra`, `nom_esp`, `nom_cat`, `nom_ita`, `nom_por`, `nom_bra`, `nom_nob`, `nom_fin`, `nom_swe`, `nom_dan`, `nom_cze`, `nom_hun`, `nom_ron`, `nom_jpn`, `nom_zho`, `nom_pol`, `nom_ell`, `nom_rus`, `nom_tur`, `nom_bul`, `nom_ara`, `nom_kor`, `nom_heb`, `nom_lav`, `nom_ukr`, `nom_ind`, `nom_mal`, `nom_tha`, `nom_est`, `nom_hrv`, `nom_lit`, `nom_slk`, `nom_srp`, `nom_slv`, `nom_vie`, `nom_tgl`, `nom_isl`, `id_pays`, `etat_activer`, `etat_delete`) VALUES
(212, 0, 1, '2016-08-08 00:00:00', 'Albacete', '', '', '', 'Albacete', 'Albacete', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(213, 0, 1, '2016-08-08 00:00:00', 'Getafe', '', '', '', 'Getafe', 'Getafe', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(214, 0, 1, '2016-08-08 00:00:00', 'Salamanque', '', '', '', 'Salamanque', 'Salamanque', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(215, 0, 1, '2016-08-08 00:00:00', 'LogroÃ±o', '', '', '', 'LogroÃƒÂ±o', 'LogroÃ±o', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(216, 0, 1, '2016-08-08 00:00:00', 'San CristÃ³bal de La Laguna', '', '', '', 'San CristÃƒÂ³bal de La Laguna', 'San CristÃ³bal de La Laguna', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(217, 0, 1, '2016-08-08 00:00:00', 'Huelva', '', '', '', 'Huelva', 'Huelva', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(218, 0, 1, '2016-08-08 00:00:00', 'Badajoz', '', '', '', 'Badajoz', 'Badajoz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(219, 0, 1, '2016-08-08 00:00:00', 'Tarragone', '', '', '', 'Tarragone', 'Tarragone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(220, 0, 1, '2016-08-08 00:00:00', 'LeÃ³n', '', '', '', 'LeÃƒÂ³n', 'LeÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(221, 0, 1, '2016-08-08 00:00:00', 'LÃ©rida', '', '', '', 'LÃƒÂ©rida', 'LÃ©rida', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(222, 0, 1, '2016-08-08 00:00:00', 'Marbella', '', '', '', 'Marbella', 'Marbella', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(223, 0, 1, '2016-08-08 00:00:00', 'Cadix', '', '', '', 'Cadix', 'Cadix', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(224, 0, 1, '2016-08-08 00:00:00', 'Salamanque', '', '', '', 'Salamanque', 'Salamanque', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(225, 0, 1, '2016-08-08 00:00:00', 'LogroÃ±o', '', '', '', 'LogroÃƒÂ±o', 'LogroÃ±o', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(226, 0, 1, '2016-08-08 00:00:00', 'San CristÃ³bal de La Laguna', '', '', '', 'San CristÃƒÂ³bal de La Laguna', 'San CristÃ³bal de La Laguna', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(227, 0, 1, '2016-08-08 00:00:00', 'Huelva', '', '', '', 'Huelva', 'Huelva', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(228, 0, 1, '2016-08-08 00:00:00', 'Badajoz', '', '', '', 'Badajoz', 'Badajoz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(229, 0, 1, '2016-08-08 00:00:00', 'Tarragone', '', '', '', 'Tarragone', 'Tarragone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(230, 0, 1, '2016-08-08 00:00:00', 'LeÃ³n', '', '', '', 'LeÃƒÂ³n', 'LeÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(231, 0, 1, '2016-08-08 00:00:00', 'LÃ©rida', '', '', '', 'LÃƒÂ©rida', 'LÃ©rida', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(232, 0, 1, '2016-08-08 00:00:00', 'Marbella', '', '', '', 'Marbella', 'Marbella', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(233, 0, 1, '2016-08-08 00:00:00', 'Cadix', '', '', '', 'Cadix', 'Cadix', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(234, 0, 1, '2016-08-08 00:00:00', 'Dos Hermanas', '', '', '', 'Dos Hermanas', 'Dos Hermanas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(235, 0, 1, '2016-08-08 00:00:00', 'MatarÃ³', '', '', '', 'MatarÃƒÂ³', 'MatarÃ³', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(236, 0, 1, '2016-08-08 00:00:00', 'Santa Coloma de Gramenet', '', '', '', 'Santa Coloma de Gramenet', 'Santa Coloma de Gramenet', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(237, 0, 1, '2016-08-08 00:00:00', 'TorrejÃ³n de Ardoz', '', '', '', 'TorrejÃƒÂ³n de Ardoz', 'TorrejÃ³n de Ardoz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(238, 0, 1, '2016-08-08 00:00:00', 'JaÃ©n', '', '', '', 'JaÃƒÂ©n', 'JaÃ©n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(239, 0, 1, '2016-08-08 00:00:00', 'AlgÃ©siras', '', '', '', 'AlgÃƒÂ©siras', 'AlgÃ©siras', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(240, 0, 1, '2016-08-08 00:00:00', 'Parla', '', '', '', 'Parla', 'Parla', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(241, 0, 1, '2016-08-08 00:00:00', 'Reus', '', '', '', 'Reus', 'Reus', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(242, 0, 1, '2016-08-08 00:00:00', 'Alcobendas', '', '', '', 'Alcobendas', 'Alcobendas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(243, 0, 1, '2016-08-08 00:00:00', 'Orense', '', '', '', 'Orense', 'Orense', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(244, 0, 1, '2016-08-08 00:00:00', 'Torrevieja', '', '', '', 'Torrevieja', 'Torrevieja', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(245, 0, 1, '2016-08-08 00:00:00', 'Telde', '', '', '', 'Telde', 'Telde', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(246, 0, 1, '2016-08-08 00:00:00', 'Barakaldo', '', '', '', 'Barakaldo', 'Barakaldo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(247, 0, 1, '2016-08-08 00:00:00', 'San Fernando', '', '', '', 'San Fernando', 'San Fernando', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(248, 0, 1, '2016-08-08 00:00:00', 'Lugo', '', '', '', 'Lugo', 'Lugo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(249, 0, 1, '2016-08-08 00:00:00', 'GÃ©rone', '', '', '', 'GÃƒÂ©rone', 'GÃ©rone', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(250, 0, 1, '2016-08-08 00:00:00', 'Saint-Jacques-de-Compostelle', '', '', '', 'Saint-Jacques-de-Compostelle', 'Saint-Jacques-de-Compostelle', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(251, 0, 1, '2016-08-08 00:00:00', 'CÃ¡ceres', '', '', '', 'CÃƒÂ¡ceres', 'CÃ¡ceres', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(252, 0, 1, '2016-08-08 00:00:00', 'Lorca', '', '', '', 'Lorca', 'Lorca', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(253, 0, 1, '2016-08-08 00:00:00', 'Coslada', '', '', '', 'Coslada', 'Coslada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(254, 0, 1, '2016-08-08 00:00:00', 'Talavera de la Reina', '', '', '', 'Talavera de la Reina', 'Talavera de la Reina', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(255, 0, 1, '2016-08-08 00:00:00', 'El Puerto de Santa MarÃ­a', '', '', '', 'El Puerto de Santa MarÃƒÂ­a', 'El Puerto de Santa MarÃ­a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(256, 0, 1, '2016-08-08 00:00:00', 'CornellÃ  de Llobregat', '', '', '', 'CornellÃƒÂ  de Llobregat', 'CornellÃ  de Llobregat', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(257, 0, 1, '2016-08-08 00:00:00', 'Orihuela', '', '', '', 'Orihuela', 'Orihuela', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(258, 0, 1, '2016-08-08 00:00:00', 'AvilÃ©s', '', '', '', 'AvilÃƒÂ©s', 'AvilÃ©s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(259, 0, 1, '2016-08-08 00:00:00', 'Las Rozas de Madrid', '', '', '', 'Las Rozas de Madrid', 'Las Rozas de Madrid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(260, 0, 1, '2016-08-08 00:00:00', 'Palencia', '', '', '', 'Palencia', 'Palencia', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(261, 0, 1, '2016-08-08 00:00:00', 'Pozuelo de AlarcÃ³n', '', '', '', 'Pozuelo de AlarcÃƒÂ³n', 'Pozuelo de AlarcÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(262, 0, 1, '2016-08-08 00:00:00', 'Sant Boi de Llobregat', '', '', '', 'Sant Boi de Llobregat', 'Sant Boi de Llobregat', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(263, 0, 1, '2016-08-08 00:00:00', 'Getxo', '', '', '', 'Getxo', 'Getxo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(264, 0, 1, '2016-08-08 00:00:00', 'Guadalajara', '', '', '', 'Guadalajara', 'Guadalajara', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(265, 0, 1, '2016-08-08 00:00:00', 'El Ejido', '', '', '', 'El Ejido', 'El Ejido', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(266, 0, 1, '2016-08-08 00:00:00', 'Toledo', '', '', '', 'Toledo', 'Toledo', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(267, 0, 1, '2016-08-08 00:00:00', 'Pontevedra', '', '', '', 'Pontevedra', 'Pontevedra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(268, 0, 1, '2016-08-08 00:00:00', 'Gandie', '', '', '', 'Gandie', 'Gandie', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(269, 0, 1, '2016-08-08 00:00:00', 'Roquetas de Mar', '', '', '', 'Roquetas de Mar', 'Roquetas de Mar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(270, 0, 1, '2016-08-08 00:00:00', 'Ceuta', '', '', '', 'Ceuta', 'Ceuta', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(271, 0, 1, '2016-08-08 00:00:00', 'Torrent', '', '', '', 'Torrent', 'Torrent', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(272, 0, 1, '2016-08-08 00:00:00', 'Sant Cugat del VallÃ¨s', '', '', '', 'Sant Cugat del VallÃƒÂ¨s', 'Sant Cugat del VallÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(273, 0, 1, '2016-08-08 00:00:00', 'Chiclana de la Frontera', '', '', '', 'Chiclana de la Frontera', 'Chiclana de la Frontera', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(274, 0, 1, '2016-08-08 00:00:00', 'Arona', '', '', '', 'Arona', 'Arona', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(275, 0, 1, '2016-08-08 00:00:00', 'Manresa', '', '', '', 'Manresa', 'Manresa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(276, 0, 1, '2016-08-08 00:00:00', 'Ferrol', '', '', '', 'Ferrol', 'Ferrol', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(277, 0, 1, '2016-08-08 00:00:00', 'VÃ©lez-MÃ¡laga', '', '', '', 'VÃƒÂ©lez-MÃƒÂ¡laga', 'VÃ©lez-MÃ¡laga', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(278, 0, 1, '2016-08-08 00:00:00', 'San SebastiÃ¡n de los Reyes', '', '', '', 'San SebastiÃƒÂ¡n de los Reyes', 'San SebastiÃ¡n de los Reyes', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(279, 0, 1, '2016-08-08 00:00:00', 'Ciudad Real', '', '', '', 'Ciudad Real', 'Ciudad Real', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(280, 0, 1, '2016-08-08 00:00:00', 'RubÃ­', '', '', '', 'RubÃƒÂ­', 'RubÃ­', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(281, 0, 1, '2016-08-08 00:00:00', 'Melilla', '', '', '', 'Melilla', 'Melilla', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(282, 0, 1, '2016-08-08 00:00:00', 'Mijas', '', '', '', 'Mijas', 'Mijas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(283, 0, 1, '2016-08-08 00:00:00', 'Benidorm', '', '', '', 'Benidorm', 'Benidorm', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(284, 0, 1, '2016-08-08 00:00:00', 'Fuengirola', '', '', '', 'Fuengirola', 'Fuengirola', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(285, 0, 1, '2016-08-08 00:00:00', 'AlcalÃ¡ de GuadaÃ­ra', '', '', '', 'AlcalÃƒÂ¡ de GuadaÃƒÂ­ra', 'AlcalÃ¡ de GuadaÃ­ra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(286, 0, 1, '2016-08-08 00:00:00', 'Ponferrada', '', '', '', 'Ponferrada', 'Ponferrada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(287, 0, 1, '2016-08-08 00:00:00', 'Zamora', '', '', '', 'Zamora', 'Zamora', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(288, 0, 1, '2016-08-08 00:00:00', 'Majadahonda', '', '', '', 'Majadahonda', 'Majadahonda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(289, 0, 1, '2016-08-08 00:00:00', 'Sagonte', '', '', '', 'Sagonte', 'Sagonte', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(290, 0, 1, '2016-08-08 00:00:00', 'Vilanova i la GeltrÃº', '', '', '', 'Vilanova i la GeltrÃƒÂº', 'Vilanova i la GeltrÃº', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(291, 0, 1, '2016-08-08 00:00:00', 'Rivas-Vaciamadrid', '', '', '', 'Rivas-Vaciamadrid', 'Rivas-Vaciamadrid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(292, 0, 1, '2016-08-08 00:00:00', 'SanlÃºcar de Barrameda', '', '', '', 'SanlÃƒÂºcar de Barrameda', 'SanlÃºcar de Barrameda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(293, 0, 1, '2016-08-08 00:00:00', 'La LÃ­nea de la ConcepciÃ³n', '', '', '', 'La LÃƒÂ­nea de la ConcepciÃƒÂ³n', 'La LÃ­nea de la ConcepciÃ³n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(294, 0, 1, '2016-08-08 00:00:00', 'Torremolinos', '', '', '', 'Torremolinos', 'Torremolinos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(295, 0, 1, '2016-08-08 00:00:00', 'El Prat de Llobregat', '', '', '', 'El Prat de Llobregat', 'El Prat de Llobregat', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(296, 0, 1, '2016-08-08 00:00:00', 'Estepona', '', '', '', 'Estepona', 'Estepona', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(297, 0, 1, '2016-08-08 00:00:00', 'Viladecans', '', '', '', 'Viladecans', 'Viladecans', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(298, 0, 1, '2016-08-08 00:00:00', 'Molina de Segura', '', '', '', 'Molina de Segura', 'Molina de Segura', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(299, 0, 1, '2016-08-08 00:00:00', 'Paterna', '', '', '', 'Paterna', 'Paterna', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(300, 0, 1, '2016-08-08 00:00:00', 'Alcoy', '', '', '', 'Alcoy', 'Alcoy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(301, 0, 1, '2016-08-08 00:00:00', 'Linares', '', '', '', 'Linares', 'Linares', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(302, 0, 1, '2016-08-08 00:00:00', 'Santa LucÃ­a de Tirajana', '', '', '', 'Santa LucÃƒÂ­a de Tirajana', 'Santa LucÃ­a de Tirajana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(303, 0, 1, '2016-08-08 00:00:00', 'Irun', '', '', '', 'Irun', 'Irun', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(304, 0, 1, '2016-08-08 00:00:00', 'Castelldefels', '', '', '', 'Castelldefels', 'Castelldefels', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(305, 0, 1, '2016-08-08 00:00:00', 'Granollers', '', '', '', 'Granollers', 'Granollers', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(306, 0, 1, '2016-08-08 00:00:00', 'Motril', '', '', '', 'Motril', 'Motril', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(307, 0, 1, '2016-08-08 00:00:00', 'Arrecife', '', '', '', 'Arrecife', 'Arrecife', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(308, 0, 1, '2016-08-08 00:00:00', 'Valdemoro', '', '', '', 'Valdemoro', 'Valdemoro', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(309, 0, 1, '2016-08-08 00:00:00', 'Cerdanyola del VallÃ¨s', '', '', '', 'Cerdanyola del VallÃƒÂ¨s', 'Cerdanyola del VallÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(310, 0, 1, '2016-08-08 00:00:00', 'SÃ©govie', '', '', '', 'SÃƒÂ©govie', 'SÃ©govie', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(311, 0, 1, '2016-08-08 00:00:00', 'Ãvila', '', '', '', 'ÃƒÂvila', 'Ãvila', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(312, 0, 1, '2016-08-08 00:00:00', 'BenalmÃ¡dena', '', '', '', 'BenalmÃƒÂ¡dena', 'BenalmÃ¡dena', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(313, 0, 1, '2016-08-08 00:00:00', 'Torrelavega', '', '', '', 'Torrelavega', 'Torrelavega', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(314, 0, 1, '2016-08-08 00:00:00', 'MÃ©rida', '', '', '', 'MÃƒÂ©rida', 'MÃ©rida', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(315, 0, 1, '2016-08-08 00:00:00', 'Elda', '', '', '', 'Elda', 'Elda', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(316, 0, 1, '2016-08-08 00:00:00', 'Collado Villalba', '', '', '', 'Collado Villalba', 'Collado Villalba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(317, 0, 1, '2016-08-08 00:00:00', 'Cuenca', '', '', '', 'Cuenca', 'Cuenca', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(318, 0, 1, '2016-08-08 00:00:00', 'Aranjuez', '', '', '', 'Aranjuez', 'Aranjuez', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(319, 0, 1, '2016-08-08 00:00:00', 'Mollet del VallÃ¨s', '', '', '', 'Mollet del VallÃƒÂ¨s', 'Mollet del VallÃ¨s', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(320, 0, 1, '2016-08-08 00:00:00', 'San Vicente del Raspeig', '', '', '', 'San Vicente del Raspeig', 'San Vicente del Raspeig', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(321, 0, 1, '2016-08-08 00:00:00', 'Puertollano', '', '', '', 'Puertollano', 'Puertollano', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(322, 0, 1, '2016-08-08 00:00:00', 'San BartolomÃ© de Tirajana', '', '', '', 'San BartolomÃƒÂ© de Tirajana', 'San BartolomÃ© de Tirajana', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(323, 0, 1, '2016-08-08 00:00:00', 'Huesca', '', '', '', 'Huesca', 'Huesca', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(324, 0, 1, '2016-08-08 00:00:00', 'CalviÃ ', '', '', '', 'CalviÃƒÂ ', 'CalviÃ ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(325, 0, 1, '2016-08-08 00:00:00', 'Villarreal', '', '', '', 'Villarreal', 'Villarreal', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(326, 0, 1, '2016-08-08 00:00:00', 'Arganda del Rey', '', '', '', 'Arganda del Rey', 'Arganda del Rey', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(327, 0, 1, '2016-08-08 00:00:00', 'Siero', '', '', '', 'Siero', 'Siero', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(328, 1, 1, '2016-08-09 14:19:54', 'Utrera', '', '', '', 'Utrera', 'Utrera', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 203, 1, 0),
(329, 2, 1, '2016-08-08 00:00:00', 'Hammamet', '', '', '', 'Hammamet', 'Hammamet', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(330, 2, 1, '2016-08-08 00:00:00', 'Ouagadougou', '', '', '', 'Ouagadougou', 'Ouagadougou', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 233, 1, 0),
(503, 2, 1, '2016-08-08 00:00:00', 'Tripoli', '', '', '', 'Tripoli', 'Tripoli', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 125, 1, 0),
(504, 2, 1, '2016-08-08 00:00:00', 'Sabratha', '', '', '', 'Sabratha', 'Sabratha', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 125, 1, 0),
(505, 2, 1, '2016-08-08 00:00:00', 'Sabha', '', '', '', 'Sabha', 'Sabha', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 125, 1, 0),
(506, 2, 1, '2016-08-08 00:00:00', 'Bengasi', '', '', '', 'Bengasi', 'Bengasi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 125, 1, 0),
(507, 2, 1, '2016-08-08 00:00:00', 'Djerba', '', '', '', 'Djerba', 'Djerba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(508, 2, 1, '2016-08-08 00:00:00', 'Tabarka', '', '', '', 'Tabarka', 'Tabarka', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(509, 2, 1, '2016-08-08 00:00:00', 'Douz', '', '', '', 'Douz', 'Douz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 219, 1, 0),
(510, 2, 1, '2016-08-08 00:00:00', 'Giza', '', '', '', 'Giza', 'Giza', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(512, 2, 1, '2016-08-08 00:00:00', 'Tobrouk', '', '', '', 'Tobrouk', 'Tobrouk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 125, 1, 0),
(513, 2, 1, '2016-08-08 00:00:00', 'Al Medina', '', '', '', 'Al Medina', 'Al Medina', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(514, 2, 1, '2016-08-08 00:00:00', 'Makkah', '', '', '', 'Makkah', 'Makkah', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(515, 2, 1, '2016-08-08 00:00:00', 'Hail', '', '', '', 'Hail', 'Hail', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(516, 2, 1, '2016-08-08 00:00:00', 'Riyadh', '', '', '', 'Riyadh', 'Riyadh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(517, 2, 1, '2016-08-08 00:00:00', 'Taef', '', '', '', 'Taef', 'Taef', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(518, 0, 1, '2016-08-08 00:00:00', 'Al Khobar', '', '', '', 'Al Khobar', 'Al Khobar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(519, 0, 1, '2016-08-08 00:00:00', 'Djeddah', '', '', '', 'Djeddah', 'Djeddah', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 192, 1, 0),
(520, 2, 1, '2016-08-08 00:00:00', 'Al Kharga Valley', '', '', '', 'Al Kharga Valley', 'Al Kharga Valley', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(521, 2, 1, '2016-08-08 00:00:00', 'Hurghada', '', '', '', 'Hurghada', 'Hurghada', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(522, 2, 1, '2016-08-08 00:00:00', 'Luxor', '', '', '', 'Luxor', 'Luxor', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(523, 2, 1, '2016-08-08 00:00:00', 'Sharm el Sheikh - Dahab', '', '', '', 'Sharm el Sheikh - Dahab', 'Sharm el Sheikh - Dahab', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(524, 2, 1, '2016-08-08 00:00:00', 'Alexandria-Mediterranean Coast', '', '', '', 'Alexandrie-CÃƒÂ´te mÃƒÂ©diterranÃƒÂ©enne', 'Alexandrie-Mediterranean Coast', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(525, 2, 1, '2016-08-08 00:00:00', 'Ismailia-Port SaÃƒÂ¯d', '', '', '', 'Ismailia-Port SaÃƒÂ¯d', 'Ismailia-Port Said', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(526, 2, 1, '2016-08-08 00:00:00', 'Marsa Alam- Qusseir', '', '', '', 'Marsa Alam- Qusseir', 'Marsa Alam- Qusseir', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(527, 2, 1, '2016-08-08 00:00:00', 'Suez', '', '', '', 'Suez', 'Suez', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(528, 2, 1, '2016-08-08 00:00:00', 'Assouan', '', '', '', 'Assouan', 'Assouan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(529, 2, 1, '2016-08-08 00:00:00', 'Le Caire', '', '', '', 'Le Caire', 'Le Caire', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(530, 2, 1, '2016-08-08 00:00:00', 'Nile cruises', '', '', '', 'CroisiÃƒÂ¨res sur le Nil', 'Nile cruises', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(531, 2, 1, '2016-08-08 00:00:00', 'Taba', '', '', '', 'Taba', 'Taba', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 227, 1, 0),
(532, 0, 0, '0000-00-00 00:00:00', 'Accra', '', '', '', 'Accra', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(533, 0, 0, '0000-00-00 00:00:00', 'Kumasi', '', '', '', 'Kumasi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(534, 0, 0, '0000-00-00 00:00:00', 'Tamale', '', '', '', 'Tamale', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(535, 0, 0, '0000-00-00 00:00:00', 'Sekondi-Takoradi', '', '', '', 'Sekondi-Takoradi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(536, 0, 0, '0000-00-00 00:00:00', 'Sunyani', '', '', '', 'Sunyani', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(537, 0, 0, '0000-00-00 00:00:00', 'Cape Coast', '', '', '', 'Cape Coast', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(538, 0, 0, '0000-00-00 00:00:00', 'Obuasi', '', '', '', 'Obuasi', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(539, 0, 0, '0000-00-00 00:00:00', 'Teshie', '', '', '', 'Teshie', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(540, 0, 0, '0000-00-00 00:00:00', 'Tema', '', '', '', 'Tema', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(541, 0, 0, '0000-00-00 00:00:00', 'Koforidua', '', '', '', 'Koforidua', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 85, 1, 0),
(542, 0, 0, '0000-00-00 00:00:00', 'Sfax', '', '', '', 'Sfax', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 201, 1, 0),
(543, 0, 0, '0000-00-00 00:00:00', 'Sfax', '', '', '', 'Sfax', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `bookingroomdetails`
--
ALTER TABLE `bookingroomdetails`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `bookingrooms`
--
ALTER TABLE `bookingrooms`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `devises`
--
ALTER TABLE `devises`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `historyused`
--
ALTER TABLE `historyused`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`),
  ADD UNIQUE KEY `alpha2` (`alpha2`),
  ADD UNIQUE KEY `alpha3` (`alpha3`),
  ADD UNIQUE KEY `code_unique` (`code`);

--
-- Indexes for table `superworkers`
--
ALTER TABLE `superworkers`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id_ville`),
  ADD KEY `id_pays` (`id_pays`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookingroomdetails`
--
ALTER TABLE `bookingroomdetails`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookingrooms`
--
ALTER TABLE `bookingrooms`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2030;

--
-- AUTO_INCREMENT for table `devises`
--
ALTER TABLE `devises`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `historyused`
--
ALTER TABLE `historyused`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117879;

--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `superworkers`
--
ALTER TABLE `superworkers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `ville`
--
ALTER TABLE `ville`
  MODIFY `id_ville` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=544;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
