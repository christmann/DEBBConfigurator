-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Erstellungszeit: 07. Mai 2013 um 15:00
-- Server Version: 5.6
-- PHP-Version: 5.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `box`
--

CREATE TABLE IF NOT EXISTS `box` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `slots` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_30E40EDA3DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `processor_id` int(11) DEFAULT NULL,
  `mainboard_id` int(11) DEFAULT NULL,
  `coolingdevice_id` int(11) DEFAULT NULL,
  `memory_id` int(11) DEFAULT NULL,
  `powersupply_id` int(11) DEFAULT NULL,
  `storage_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CB0F23F4460D9FD7` (`node_id`),
  KEY `IDX_CB0F23F437BAC19A` (`processor_id`),
  KEY `IDX_CB0F23F467EF1F11` (`mainboard_id`),
  KEY `IDX_CB0F23F4524B8BF0` (`coolingdevice_id`),
  KEY `IDX_CB0F23F4CCC80CB3` (`memory_id`),
  KEY `IDX_CB0F23F4889B163B` (`powersupply_id`),
  KEY `IDX_CB0F23F45CC5DB90` (`storage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=93 ;

--
-- Daten für Tabelle `component`
--

INSERT INTO `component` (`id`, `node_id`, `processor_id`, `mainboard_id`, `coolingdevice_id`, `memory_id`, `powersupply_id`, `storage_id`, `type`, `amount`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, 2, 1),
(7, 4, 4, NULL, NULL, NULL, NULL, NULL, 2, 1),
(9, 5, 5, NULL, NULL, NULL, NULL, NULL, 2, 1),
(11, 6, 6, NULL, NULL, NULL, NULL, NULL, 2, 1),
(13, 7, 7, NULL, NULL, NULL, NULL, NULL, 2, 1),
(14, 7, NULL, NULL, NULL, 7, NULL, NULL, 4, 1),
(15, 8, 8, NULL, NULL, NULL, NULL, NULL, 2, 1),
(16, 8, NULL, NULL, NULL, 8, NULL, NULL, 4, 1),
(20, 3, 2, NULL, NULL, NULL, NULL, NULL, 2, 1),
(23, 3, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(26, 1, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(28, 1, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(36, 8, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(37, 8, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(44, 6, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(46, 6, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(49, 5, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(51, 5, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(55, 10, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(58, 10, NULL, 4, NULL, NULL, NULL, NULL, 1, 1),
(59, 10, 10, NULL, NULL, NULL, NULL, NULL, 2, 1),
(61, 10, NULL, NULL, NULL, 7, NULL, NULL, 4, 1),
(62, 10, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(65, 4, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(66, 4, NULL, NULL, NULL, 10, NULL, NULL, 4, 2),
(67, 4, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(69, 1, NULL, NULL, NULL, 7, NULL, NULL, 4, 2),
(70, 5, NULL, NULL, NULL, 8, NULL, NULL, 4, 1),
(71, 6, NULL, NULL, NULL, 8, NULL, NULL, 4, 1),
(72, 3, NULL, NULL, NULL, 8, NULL, NULL, 4, 2),
(73, 6, NULL, NULL, 2, NULL, NULL, NULL, 3, 1),
(74, 5, NULL, NULL, 2, NULL, NULL, NULL, 3, 1),
(75, 1, NULL, NULL, 2, NULL, NULL, NULL, 3, 1),
(76, 10, NULL, NULL, 3, NULL, NULL, NULL, 3, 1),
(77, 3, NULL, NULL, 2, NULL, NULL, NULL, 3, 1),
(78, 4, NULL, NULL, 2, NULL, NULL, NULL, 3, 1),
(80, 8, NULL, NULL, 3, NULL, NULL, NULL, 3, 1),
(81, 7, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(82, 7, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0),
(84, 7, NULL, NULL, 3, NULL, NULL, NULL, 3, 1),
(85, 6, NULL, 5, NULL, NULL, NULL, NULL, 1, 1),
(86, 5, NULL, 5, NULL, NULL, NULL, NULL, 1, 1),
(87, 1, NULL, 6, NULL, NULL, NULL, NULL, 1, 1),
(88, 3, NULL, 7, NULL, NULL, NULL, NULL, 1, 1),
(89, 3, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0),
(90, 4, NULL, 7, NULL, NULL, NULL, NULL, 1, 1),
(91, 8, NULL, 8, NULL, NULL, NULL, NULL, 1, 1),
(92, 7, NULL, 8, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coolingdevice`
--

CREATE TABLE IF NOT EXISTS `coolingdevice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaxPower` decimal(10,0) DEFAULT NULL,
  `MaxCoolingCapacity` decimal(10,0) DEFAULT NULL,
  `MaxAirThroughput` decimal(10,0) DEFAULT NULL,
  `MaxWaterThroughput` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `coolingdevice`
--

INSERT INTO `coolingdevice` (`id`, `manufacturer`, `product`, `model`, `hostname`, `MaxPower`, `MaxCoolingCapacity`, `MaxAirThroughput`, `MaxWaterThroughput`) VALUES
(1, 'Scythe', 'KATANA', '3 SCKTN-3000A', NULL, NULL, NULL, NULL, NULL),
(2, 'COM-Express', 'Basic', 'Heatsink', NULL, NULL, NULL, NULL, NULL),
(3, 'COM-Express', 'Compact', 'Heatsink', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mimeType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `file`
--

INSERT INTO `file` (`id`, `name`, `path`, `mimeType`, `size`) VALUES
(1, 'conga-BM45-per-r_2fc52f0be9.png', '5114dcc47ec04.png', 'image/png', 51670),
(2, '09f0188f6a.jpg', '5114dd57354c7.jpeg', 'image/jpeg', 13519),
(3, '100226-woodpecker-x86-com-express-z510-top-651x650.jpg', '5114dda6a99fe.jpeg', 'image/jpeg', 82299),
(4, '100225-woodpecker-x86-com-express-z530-top-651x650.jpg', '5114ddc43858b.jpeg', 'image/jpeg', 81650),
(5, 'conga-baf_per_per_r_e05b258242.png', '5114ddeb07d4a.png', 'image/png', 51785),
(6, 'conga-baf_per_per_r_e05b258242.png', '5114de06539f1.png', 'image/png', 51785),
(7, '100225-woodpecker-x86-com-express-z530-top-651x650.jpg', '5114de85a296b.jpeg', 'image/jpeg', 81650),
(8, 'Unbenannt.JPG', '5115402f896e8.jpeg', 'image/jpeg', 23412),
(9, 'conga-cca.png', '5118d09d0b1aa.png', 'image/png', 59278),
(10, 'imageprocessing.php.jpg', '5118d583ad725.jpeg', 'image/jpeg', 16794),
(11, 'imageprocessing.php.jpg', '5118d5960f9d4.jpeg', 'image/jpeg', 16794),
(12, 'Penguins.jpg', '51190906ab574.jpeg', 'image/jpeg', 777835),
(13, 'empty.png', '511909315465d.png', 'image/png', 119),
(14, 'imageprocessing.php.jpg', '51190f0dbcec0.jpeg', 'image/jpeg', 16794),
(15, 'imageprocessing.php.jpg', '51190f22699c1.jpeg', 'image/jpeg', 16794),
(16, 'conga-BM45-rep.png', '511910ee7e987.png', 'image/png', 1576732),
(17, 'conga-BAF.jpg', '5119114125478.jpeg', 'image/jpeg', 67618),
(18, 'conga-BAF.jpg', '51191160e324e.jpeg', 'image/jpeg', 67618),
(19, 'conga-CCA-COM-Express-module.jpg', '51191288570ef.jpeg', 'image/jpeg', 51238);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mainboard`
--

CREATE TABLE IF NOT EXISTS `mainboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `socket` int(11) DEFAULT NULL,
  `connections` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `mainboard`
--

INSERT INTO `mainboard` (`id`, `manufacturer`, `product`, `model`, `hostname`, `description`, `socket`, `connections`) VALUES
(1, 'Intel', 'Desktop Board', 'DQ77CP', NULL, 'MKQ7710H.86A', 0, '- Processor\r\n- Memory\r\n- Chipset\r\n- Audio\r\n- LAN support\r\n- Peripheral interfaces\r\n- Expansion capabilities\r\n- Warranty'),
(2, 'Intel', 'Desktop Board', 'DB75EN', NULL, 'ENB7510H.86A mit Intel Fast-Boot-Technik', 0, '- Processor\r\n- Memory\r\n- Chipset\r\n- Audio\r\n- LAN support\r\n- Peripheral interfaces\r\n- Expansion capabilities\r\n- Warranty'),
(3, 'Intel', 'Desktop Board', 'DQ77MK', NULL, 'MKQ7710H.86A', 0, '- Processor\r\n- Memory\r\n- Chipset\r\n- Audio\r\n- LAN support\r\n- Peripheral interfaces\r\n- Expansion capabilities\r\n- Warranty'),
(4, 'Congatec', 'conga-CCA', 'COM-Express Type 2', NULL, NULL, 0, NULL),
(5, 'Congatec', 'conga-BAF', 'COM-Express Type 2', NULL, NULL, 0, '4 x SATA\r\n6 x PCI Express™\r\n8 x USB 2.0\r\n1 x EIDE (UDMA-66/100)\r\nPCI bus Rev. 2.3\r\nLPC bus\r\nI²C bus'),
(6, 'Congatec', 'conga-BM45', 'COM-Express Type 2', NULL, NULL, 0, '3 x SATA\r\n5 x PCI Express™\r\n1 x PEG\r\n8 x USB 2.0\r\n2 x Express Card®\r\n1 x EIDE (UDMA-66/100)\r\nPCI bus Rev. 2.3\r\nLPC bus\r\nI²C bus'),
(7, 'Kontron', 'COMe-bSC', 'COM-Express Type 2', NULL, NULL, 0, NULL),
(8, 'Toradex', 'Woodpecker', 'COM-Express Type 2', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `memory`
--

CREATE TABLE IF NOT EXISTS `memory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaxPower` double DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `memory`
--

INSERT INTO `memory` (`id`, `manufacturer`, `product`, `model`, `hostname`, `MaxPower`, `Capacity`) VALUES
(7, 'Kingston', 'ValueRAM', 'KVR800D2S6/2G', NULL, NULL, 2048),
(8, 'Kingston', 'ValueRAM', 'KVR800D2S6/4G', NULL, NULL, 4096),
(10, 'Samsung', 'SO-DIMM', 'GreenRAM', NULL, NULL, 8192);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `vrmlFile_id` int(11) DEFAULT NULL,
  `stlFile_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_254D477B3DA5256D` (`image_id`),
  KEY `IDX_254D477B64DE3070` (`vrmlFile_id`),
  KEY `IDX_254D477B15E5EE4E` (`stlFile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `node`
--

INSERT INTO `node` (`id`, `image_id`, `manufacturer`, `product`, `model`, `hostname`, `sizeX`, `sizeY`, `sizeZ`, `spaceLeft`, `spaceRight`, `spaceTop`, `spaceBottom`, `spaceFront`, `spaceBehind`, `vrmlFile_id`, `stlFile_id`, `type`) VALUES
(1, NULL, 'Congatec', 'conga-BM45', 'P8400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 'Kontron', 'COMe-bSC2 i7-2715QE ECC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 'Kontron', 'COMe-bSC2 i7-3615QE ECC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 'Congatec', 'conga-BAF', 'T56N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Congatec', 'conga-BAF', 'T40N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'Toradex', 'Woodpecker', 'Z530', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'Toradex', 'Woodpecker', 'Z510', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 'Congatec', 'conga-CCA', 'N2600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodegroup`
--

CREATE TABLE IF NOT EXISTS `nodegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `draft_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B47114EFE2F3C5D1` (`draft_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `nodegroup`
--

INSERT INTO `nodegroup` (`id`, `manufacturer`, `product`, `model`, `hostname`, `sizeX`, `sizeY`, `sizeZ`, `spaceLeft`, `spaceRight`, `spaceTop`, `spaceBottom`, `spaceFront`, `spaceBehind`, `draft_id`) VALUES
(1, 'Christmann', 'RECS 2.0 Sirius', '1 PNSC i7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Christmann', 'RECS 2.0 Sirius', '2 PSNC AMD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Christmann', 'RECS 2.0 Sirius', '3 PSNC Atom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodegroupdraft`
--

CREATE TABLE IF NOT EXISTS `nodegroupdraft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slots_x` int(11) NOT NULL,
  `slots_y` int(11) NOT NULL,
  `he_size` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_27D8408D3DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodegrouptorack`
--

CREATE TABLE IF NOT EXISTS `nodegrouptorack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodegroup_id` int(11) DEFAULT NULL,
  `rack_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64246BA32C147D48` (`nodegroup_id`),
  KEY `IDX_64246BA38E86A33E` (`rack_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Daten für Tabelle `nodegrouptorack`
--

INSERT INTO `nodegrouptorack` (`id`, `nodegroup_id`, `rack_id`, `field`) VALUES
(43, 1, 2, 41),
(44, 2, 2, 40),
(45, 3, 2, 39),
(46, NULL, 2, 38),
(48, NULL, 2, 36),
(49, NULL, 2, 35),
(50, NULL, 2, 34),
(51, NULL, 2, 33),
(52, NULL, 2, 32),
(53, NULL, 2, 31),
(54, NULL, 2, 30),
(55, NULL, 2, 29),
(56, NULL, 2, 28),
(57, NULL, 2, 27),
(58, NULL, 2, 26),
(59, NULL, 2, 25),
(60, NULL, 2, 24),
(61, NULL, 2, 23),
(62, NULL, 2, 22),
(63, NULL, 2, 21),
(64, NULL, 2, 20),
(65, NULL, 2, 19),
(66, NULL, 2, 18),
(67, NULL, 2, 17),
(68, NULL, 2, 16),
(69, NULL, 2, 15),
(70, NULL, 2, 14),
(71, NULL, 2, 13),
(72, NULL, 2, 12),
(73, NULL, 2, 11),
(74, NULL, 2, 10),
(75, NULL, 2, 9),
(76, NULL, 2, 8),
(77, NULL, 2, 7),
(78, NULL, 2, 6),
(79, NULL, 2, 5),
(80, NULL, 2, 4),
(81, NULL, 2, 3),
(82, NULL, 2, 2),
(83, NULL, 2, 1),
(84, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodetonodegroup`
--

CREATE TABLE IF NOT EXISTS `nodetonodegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `nodegroup_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F9B2EFE460D9FD7` (`node_id`),
  KEY `IDX_2F9B2EFE2C147D48` (`nodegroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Daten für Tabelle `nodetonodegroup`
--

INSERT INTO `nodetonodegroup` (`id`, `node_id`, `nodegroup_id`, `field`) VALUES
(1, 4, 1, 17),
(2, 4, 1, 16),
(3, 4, 1, 15),
(4, 4, 1, 14),
(5, 4, 1, 13),
(6, 4, 1, 12),
(7, 4, 1, 11),
(8, 4, 1, 10),
(9, 4, 1, 9),
(10, 4, 1, 8),
(11, 4, 1, 7),
(12, 4, 1, 6),
(13, 4, 1, 5),
(14, 4, 1, 4),
(15, 4, 1, 3),
(16, 4, 1, 2),
(17, 4, 1, 1),
(18, 4, 1, 0),
(19, 6, 2, 17),
(20, 6, 2, 16),
(21, 6, 2, 15),
(22, 6, 2, 14),
(23, 6, 2, 13),
(24, 6, 2, 12),
(25, 6, 2, 11),
(26, 6, 2, 10),
(27, 6, 2, 9),
(28, 6, 2, 8),
(29, 6, 2, 7),
(30, 6, 2, 6),
(31, 6, 2, 5),
(32, 6, 2, 4),
(33, 6, 2, 3),
(34, 6, 2, 2),
(35, 6, 2, 1),
(36, 6, 2, 0),
(37, 10, 3, 17),
(38, 7, 3, 16),
(39, 10, 3, 15),
(40, 7, 3, 14),
(41, 10, 3, 13),
(42, 7, 3, 12),
(43, 10, 3, 11),
(44, 7, 3, 10),
(45, 10, 3, 9),
(46, 10, 3, 8),
(47, 10, 3, 7),
(48, 10, 3, 6),
(49, 10, 3, 5),
(50, 10, 3, 4),
(51, 10, 3, 3),
(52, 10, 3, 2),
(53, 10, 3, 1),
(54, 10, 3, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `powersupply`
--

CREATE TABLE IF NOT EXISTS `powersupply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaxPower` double DEFAULT NULL,
  `TotalOutputPower` decimal(10,0) DEFAULT NULL,
  `Efficiency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `powersupply`
--

INSERT INTO `powersupply` (`id`, `manufacturer`, `product`, `model`, `hostname`, `MaxPower`, `TotalOutputPower`, `Efficiency`) VALUES
(1, 'Dell', '450-15400', '870W', NULL, 870, 870, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `processor`
--

CREATE TABLE IF NOT EXISTS `processor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cores` int(11) DEFAULT NULL,
  `max_frequency` int(11) DEFAULT NULL,
  `max_power` decimal(10,0) DEFAULT NULL,
  `max_clock_speed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `processor`
--

INSERT INTO `processor` (`id`, `manufacturer`, `product`, `model`, `hostname`, `cores`, `max_frequency`, `max_power`, `max_clock_speed`) VALUES
(1, 'Intel', 'Core 2 Duo P8400', 'P8400', NULL, 2, 2260, 25, 2267),
(2, 'Intel', 'Core i7', '2715QE', NULL, 4, 2100, 45, 3000),
(4, 'Intel', 'Core i7', '3615QE', NULL, 4, 3300, 45, 2300),
(5, 'AMD', 'Fusion G', 'T56N', NULL, 2, 1600, 18, 1600),
(6, 'AMD', 'Fusion G', 'T40N', NULL, 2, 1000, 9, 800),
(7, 'Intel', 'Atom', 'Z530', NULL, 1, 1600, 2, 1600),
(8, 'Intel', 'Atom', 'Z510', NULL, 1, 1600, 2, 1100),
(9, 'Intel', 'Atom', 'D510', NULL, 2, 1660, 13, 1600),
(10, 'Intel', 'Atom', 'N2600', NULL, 2, 1600, 3, 1600);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rack`
--

CREATE TABLE IF NOT EXISTS `rack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  `nodegroupsize` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `rack`
--

INSERT INTO `rack` (`id`, `manufacturer`, `product`, `model`, `hostname`, `sizeX`, `sizeY`, `sizeZ`, `spaceLeft`, `spaceRight`, `spaceTop`, `spaceBottom`, `spaceFront`, `spaceBehind`, `nodegroupsize`) VALUES
(2, 'Christmann', 'Testbed_Rack', 'PSNC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `racktoroom`
--

CREATE TABLE IF NOT EXISTS `racktoroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rack_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `field` int(11) DEFAULT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD329F678E86A33E` (`rack_id`),
  KEY `IDX_BD329F6754177093` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeX` double DEFAULT NULL,
  `sizeY` double DEFAULT NULL,
  `sizeZ` double DEFAULT NULL,
  `spaceLeft` double DEFAULT NULL,
  `spaceRight` double DEFAULT NULL,
  `spaceTop` double DEFAULT NULL,
  `spaceBottom` double DEFAULT NULL,
  `spaceFront` double DEFAULT NULL,
  `spaceBehind` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `storage`
--

CREATE TABLE IF NOT EXISTS `storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hostname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaxPower` double DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Interface` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `storage`
--

INSERT INTO `storage` (`id`, `manufacturer`, `product`, `model`, `hostname`, `MaxPower`, `Capacity`, `Interface`) VALUES
(1, 'Western Digital', 'Red 2TB Interne Festplatte', 'WD20EFRX', NULL, 600, 2097152, NULL);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `box`
--
ALTER TABLE `box`
  ADD CONSTRAINT `FK_30E40EDA3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`);

--
-- Constraints der Tabelle `component`
--
ALTER TABLE `component`
  ADD CONSTRAINT `FK_CB0F23F437BAC19A` FOREIGN KEY (`processor_id`) REFERENCES `processor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB0F23F4460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`),
  ADD CONSTRAINT `FK_CB0F23F4524B8BF0` FOREIGN KEY (`coolingdevice_id`) REFERENCES `coolingdevice` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB0F23F45CC5DB90` FOREIGN KEY (`storage_id`) REFERENCES `storage` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB0F23F467EF1F11` FOREIGN KEY (`mainboard_id`) REFERENCES `mainboard` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB0F23F4889B163B` FOREIGN KEY (`powersupply_id`) REFERENCES `powersupply` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CB0F23F4CCC80CB3` FOREIGN KEY (`memory_id`) REFERENCES `memory` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `node`
--
ALTER TABLE `node`
  ADD CONSTRAINT `FK_254D477B15E5EE4E` FOREIGN KEY (`stlFile_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `FK_254D477B3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `FK_254D477B64DE3070` FOREIGN KEY (`vrmlFile_id`) REFERENCES `file` (`id`);

--
-- Constraints der Tabelle `nodegroup`
--
ALTER TABLE `nodegroup`
  ADD CONSTRAINT `FK_B47114EFE2F3C5D1` FOREIGN KEY (`draft_id`) REFERENCES `nodegroupdraft` (`id`);

--
-- Constraints der Tabelle `nodegroupdraft`
--
ALTER TABLE `nodegroupdraft`
  ADD CONSTRAINT `FK_27D8408D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `file` (`id`);

--
-- Constraints der Tabelle `nodegrouptorack`
--
ALTER TABLE `nodegrouptorack`
  ADD CONSTRAINT `FK_64246BA32C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_64246BA38E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `nodetonodegroup`
--
ALTER TABLE `nodetonodegroup`
  ADD CONSTRAINT `FK_2F9B2EFE2C147D48` FOREIGN KEY (`nodegroup_id`) REFERENCES `nodegroup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2F9B2EFE460D9FD7` FOREIGN KEY (`node_id`) REFERENCES `node` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `racktoroom`
--
ALTER TABLE `racktoroom`
  ADD CONSTRAINT `FK_BD329F6754177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BD329F678E86A33E` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
