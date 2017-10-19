--
-- OpenCAD Database Scheme
-- Last Updated: 15 October 2017
-- Updated By: Phill Fernandes <pfernandes@winterhillsolutions.com>
--
-- --------------------------------------------------------
 
--
-- Database: `opencad`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE `active_users` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=busy/unavailable, 1=available, 2=dispatcher',
  `status_detail` int(11) NOT NULL COMMENT 'Paired to Statuses table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `bolos_persons`
--

CREATE TABLE `bolos_persons` (
  `id` int(11) NOT NULL COMMENT 'Unqiue ID of persons BOLO record.',
  `first_name` varchar(255) NOT NULL COMMENT 'First name of BOLO suspect.',
  `last_name` varchar(255) NOT NULL COMMENT 'Last name of BOLO suspect.',
  `gender` varchar(255) NOT NULL COMMENT 'Gender of BOLO suspect.',
  `physical_description` varchar(255) NOT NULL COMMENT 'Physical description of BOLO suspect.',
  `reason_wanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `last_seen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO suspect.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `bolos_vehicles`
--

CREATE TABLE `bolos_vehicles` (
  `id` int(11) NOT NULL COMMENT 'Unqiue ID of vehicle BOLO record.',
  `vehicle_make` varchar(255) NOT NULL COMMENT 'Make of BOLO vehicle.',
  `vehicle_model` varchar(255) NOT NULL COMMENT 'Model of BOLO vehicle.',
  `vehicle_plate` varchar(255) NOT NULL COMMENT 'License of BOLO vehicle.',
  `primary_color` varchar(255) NOT NULL COMMENT 'Primary color of BOLO vehicle.',
  `secondary_color` varchar(255) NOT NULL COMMENT 'Secondary color of BOLO vehicle.',
  `reason_wanted` varchar(255) NOT NULL COMMENT 'Reason BOLO suspect is wanted.',
  `last_seen` varchar(255) NOT NULL COMMENT 'Last observed location of BOLO vehicle.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `call_id` int(4) NOT NULL,
  `call_type` text NOT NULL,
  `call_primary` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text DEFAULT NULL,
  `call_street3` text DEFAULT NULL,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `calls_users`
--

CREATE TABLE `calls_users` (
  `call_id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `call_history`
--

CREATE TABLE `call_history` (
  `call_id` int(11) NOT NULL,
  `call_primary` text NOT NULL,
  `call_type` text NOT NULL,
  `call_street1` text NOT NULL,
  `call_street2` text DEFAULT NULL,
  `call_street3` text DEFAULT NULL,
  `call_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `citations`
--

CREATE TABLE `citations` (
  `id` int(11) NOT NULL,
  `citation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `citations`
--

INSERT INTO `citations` (`id`, `citation_name`) VALUES
(6, 'ABANDON VEH - D MIS.'),
(10, 'BLOCKING EMERG VEH - A MIS.'),
(27, 'DESTRUCTION OF PROPERTY - A MIS.'),
(26, 'DESTRUCTION OF PROPERTY - B MIS.'),
(11, 'DRIVING W/O LICENSE - D MIS.'),
(18, 'EXCESSIVE USE OF HORN - B MIS.'),
(17, 'EXCESSIVE USE OF HORN - C MIS.'),
(21, 'FAIL. NOTIFY CCP - B MIS.'),
(20, 'FAIL. NOTIFY CCP - C MIS.'),
(8, 'FAIL. YIELD FOR EMERG VEH - C MIS.'),
(7, 'FAIL. YIELD FOR EMERG VEH - D MIS.'),
(23, 'HARASSMENT - B MIS.'),
(22, 'HARASSMENT - C MIS.'),
(25, 'IMPEDING PEACE OFFICER - A MIS.'),
(24, 'IMPEDING PEACE OFFICER - B MIS.'),
(9, 'IMPEDING TRAFFIC - D MIS.'),
(16, 'LICENSE PLATE - C MIS.'),
(40, 'OTHER - A MIS.'),
(39, 'OTHER - B MIS.'),
(38, 'OTHER - C MIS.'),
(37, 'OTHER - D MIS.'),
(30, 'POSS. CNTRL SUB. - A MIS.'),
(29, 'POSS. CNTRL SUB. - B MIS.'),
(28, 'POSS. CNTRL SUB. - C MIS.'),
(32, 'POSS. ILLEGAL SUB. - A MIS.'),
(31, 'POSS. ILLEGAL SUB. - B MIS.'),
(34, 'PROSTITUTION / SOLICITATION - A MIS.'),
(33, 'PROSTITUTION / SOLICITATION - B MIS.'),
(36, 'PUBLIC INTOX. B MIS.'),
(35, 'PUBLIC INTOX. C MIS.'),
(13, 'RECKLESS DRIVING - C MIS.'),
(12, 'RECKLESS DRIVING - D MIS.'),
(5, 'RUNNING STOP SIGN - D MIS.'),
(3, 'SPEEDING - A. MIS'),
(2, 'SPEEDING - B. MIS'),
(1, 'SPEEDING - C. MIS'),
(0, 'SPEEDING - D. MIS'),
(4, 'U-TURN - D. MIS'),
(15, 'UNAUTHORIZED LIGHTING - B MIS.'),
(14, 'UNAUTHORIZED LIGHTING - C MIS.'),
(19, 'WINDOW TINT - C MIS.');

-- --------------------------------------------------------

--
-- Table structure for table `civilian_names`
--

CREATE TABLE `civilian_names` (
  `user_id` int(11) NOT NULL COMMENT 'Links to users table',
  `names_id` int(11) NOT NULL COMMENT 'Links to names table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) DEFAULT NULL,
  `color_group` varchar(255) DEFAULT NULL,
  `color_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_group`, `color_name`) VALUES
(1, 'Chrome', 'Chrome'),
(2, 'Classic', 'Black'),
(3, 'Classic', 'Carbon Black'),
(4, 'Classic', 'Graphite'),
(5, 'Classic', 'Anthracite Black'),
(6, 'Classic', 'Black Steel'),
(7, 'Classic', 'Dark Steel'),
(8, 'Classic', 'Silver'),
(9, 'Classic', 'Bluish Silver'),
(10, 'Classic', 'Rolled Steel'),
(11, 'Classic', 'Shadow Silver'),
(12, 'Classic', 'Midnigh Silver'),
(13, 'Classic', 'Cast Iron Silver'),
(14, 'Classic', 'Red'),
(15, 'Classic', 'Torino Red'),
(16, 'Classic', 'Forumula Red'),
(17, 'Classic', 'Lava Red'),
(18, 'Classic', 'Blaze Red'),
(19, 'Classic', 'Grace Red'),
(20, 'Classic', 'Garnet Red'),
(21, 'Classic', 'Sunset Red'),
(22, 'Classic', 'Cabernet Red'),
(23, 'Classic', 'Wine Red'),
(24, 'Classic', 'Candy Red'),
(25, 'Classic', 'Hot Pink'),
(26, 'Classic', 'Pfister Pink'),
(27, 'Classic', 'Salmon Pink'),
(28, 'Classic', 'Sunrise Orange'),
(29, 'Classic', 'Orange'),
(30, 'Classic', 'Bright Orange'),
(31, 'Classic', 'Gold'),
(32, 'Classic', 'Bronze'),
(33, 'Classic', 'Yellow'),
(34, 'Classic', 'Race Yellow'),
(35, 'Classic', 'Dew Yellow'),
(36, 'Classic', 'Dark Green'),
(37, 'Classic', 'Racing Green'),
(38, 'Classic', 'Sea Green'),
(39, 'Classic', 'Olive Green'),
(40, 'Classic', 'Bright Green'),
(41, 'Classic', 'Gasoline Green'),
(42, 'Classic', 'Lime Green'),
(43, 'Classic', 'Midnight Blue'),
(44, 'Classic', 'Galaxy Blue'),
(45, 'Classic', 'Dark Blue'),
(46, 'Classic', 'Saxon Blue'),
(47, 'Classic', 'Blue'),
(48, 'Classic', 'Mariner Blue'),
(49, 'Classic', 'Harbor Blue'),
(50, 'Classic', 'Diamond Blue'),
(51, 'Classic', 'Surf Blue'),
(52, 'Classic', 'Nautical Blue'),
(53, 'Classic', 'Racaing Blue'),
(54, 'Classic', 'Ultra Blue'),
(55, 'Classic', 'Light Blue'),
(56, 'Classic', 'Chocolate Brown'),
(57, 'Classic', 'Bison Brown'),
(58, 'Classic', 'Creek Brown'),
(59, 'Classic', 'Feltzer Brown'),
(60, 'Classic', 'Maple Brown'),
(61, 'Classic', 'Beechwood Brown'),
(62, 'Classic', 'Sienna Brown'),
(63, 'Classic', 'Saddle Brown'),
(64, 'Classic', 'Moss Brown'),
(65, 'Classic', 'Woodbeech Brown'),
(66, 'Classic', 'Straw Brown'),
(67, 'Classic', 'Sandy Brown'),
(68, 'Classic', 'Bleached Brown'),
(69, 'Classic', 'Schafter Purple'),
(70, 'Classic', 'Spinnaker Purple'),
(71, 'Classic', 'Midnight Purple'),
(72, 'Classic', 'Bright Purple'),
(73, 'Classic', 'Cream'),
(74, 'Classic', 'Ice White'),
(75, 'Classic', 'Frost White'),
(76, 'Matte', 'Black'),
(77, 'Matte', 'Gray'),
(78, 'Matte', 'Light Gray'),
(79, 'Matte', 'Ice White'),
(80, 'Matte', 'Blue'),
(81, 'Matte', 'Dark Blue'),
(82, 'Matte', 'Midnight Blue'),
(83, 'Matte', 'Midnight Purple'),
(84, 'Matte', 'Shafter Purple'),
(85, 'Matte', 'Red'),
(86, 'Matte', 'Dark REd'),
(87, 'Matte', 'Orange'),
(88, 'Matte', 'Yellow'),
(89, 'Matte', 'Lime Green'),
(90, 'Matte', 'Green'),
(91, 'Matte', 'Forest Green'),
(92, 'Matte', 'Foliage Green'),
(93, 'Matte', 'Olive Drag'),
(94, 'Matte', 'Dark Earch'),
(95, 'Matte', 'Desert Tan'),
(96, 'Metallic', 'Black'),
(97, 'Metallic', 'Carbon Black'),
(98, 'Metallic', 'Graphite'),
(99, 'Metallic', 'Anthracite Black'),
(100, 'Metallic', 'Black Steel'),
(101, 'Metallic', 'Dark Steel'),
(102, 'Metallic', 'Silver'),
(103, 'Metallic', 'Bluish Silver'),
(104, 'Metallic', 'Rolled Steel'),
(105, 'Metallic', 'Shadow Silver'),
(106, 'Metallic', 'Stone Silver'),
(107, 'Metallic', 'Midnight Silver'),
(108, 'Metallic', 'Cast Iron Silver'),
(109, 'Metallic', 'Red'),
(110, 'Metallic', 'Torino Red'),
(111, 'Metallic', 'Formula Red'),
(112, 'Metallic', 'Lava Red'),
(113, 'Metallic', 'Blaze REd'),
(114, 'Metallic', 'Grace REd'),
(115, 'Metallic', 'Garnet Red'),
(116, 'Metallic', 'Sunset Red'),
(117, 'Metallic', 'Cabernet REd'),
(118, 'Metallic', 'Wine REd'),
(119, 'Metallic', 'Candy Red'),
(120, 'Metallic', 'Hot Pink'),
(121, 'Metallic', 'Pfister Pink'),
(122, 'Metallic', 'salmon Pink'),
(123, 'Metallic', 'Sunrise Orange'),
(124, 'Metallic', 'Orange'),
(125, 'Metallic', 'Bright Orange'),
(126, 'Metallic', 'Gold Bronze'),
(127, 'Metallic', 'Yellow'),
(128, 'Metallic', 'Race Yellow'),
(129, 'Metallic', 'Dew Yellow'),
(130, 'Metallic', 'Dark Green'),
(131, 'Metallic', 'Racing Green'),
(132, 'Metallic', 'Sea Green'),
(133, 'Metallic', 'Olive Green'),
(134, 'Metallic', 'Bright Green'),
(135, 'Metallic', 'Gasoline Green'),
(136, 'Metallic', 'Lime Green'),
(137, 'Metallic', 'Midnight Blue'),
(138, 'Metallic', 'Galazy BLue'),
(139, 'Metallic', 'Dark Blue'),
(140, 'Metallic', 'Saxon Blue'),
(141, 'Metallic', 'Blue'),
(142, 'Metallic', 'Mariner Bue'),
(143, 'Metallic', 'Harbor Blue'),
(144, 'Metallic', 'Diamond BLue'),
(145, 'Metallic', 'Surf Blue'),
(146, 'Metallic', 'Nauical Blue'),
(147, 'Metallic', 'Racing BLue'),
(148, 'Metallic', 'Ultra BLue'),
(149, 'Metallic', 'Light BLue'),
(150, 'Metallic', 'Chocolate Brown'),
(151, 'Metallic', 'Bison Brown'),
(152, 'Metallic', 'Creek Brown'),
(153, 'Metallic', 'Feltzer Brown'),
(154, 'Metallic', 'Maple Brown'),
(155, 'Metallic', 'Beechwood Brown'),
(156, 'Metallic', 'Sienna Brown'),
(157, 'Metallic', 'Saddle Brown'),
(158, 'Metallic', 'Moss Brown'),
(159, 'Metallic', 'Woodbeech Brown'),
(160, 'Metallic', 'Straw Brown'),
(161, 'Metallic', 'Sandy BRown'),
(162, 'Metallic', 'Bleached Brown'),
(163, 'Metallic', 'Schafter Purple'),
(164, 'Metallic', 'Spinnaker Purple'),
(165, 'Metallic', 'Midnight Purple'),
(166, 'Metallic', 'Bright Purple'),
(167, 'Metallic', 'Cream'),
(168, 'Metallic', 'Ice White'),
(169, 'Metallic', 'Frost White'),
(170, 'Metals', 'Brushed STeel'),
(171, 'Metals', 'Brushed Black Steel'),
(172, 'Metals', 'Brushed Aluminium'),
(173, 'Metals', 'Pure Gold'),
(174, 'Metals', 'Brushed Gold'),
(175, 'Pearlescent', 'Black'),
(176, 'Pearlescent', 'Carbon Black'),
(177, 'Pearlescent', 'Graphite'),
(178, 'Pearlescent', 'Anthracite Black'),
(179, 'Pearlescent', 'Black Steel'),
(180, 'Pearlescent', 'Dark Steel'),
(181, 'Pearlescent', 'Silver'),
(182, 'Pearlescent', 'Bluish Silver'),
(183, 'Pearlescent', 'Rolled Steel'),
(184, 'Pearlescent', 'Shadow Silver'),
(185, 'Pearlescent', 'Stone Silver'),
(186, 'Pearlescent', 'Midnight Silver'),
(187, 'Pearlescent', 'Cast Iron Silver'),
(188, 'Pearlescent', 'Red'),
(189, 'Pearlescent', 'Torino Red'),
(190, 'Pearlescent', 'Formula Red'),
(191, 'Pearlescent', 'Lava Red'),
(192, 'Pearlescent', 'Blaze REd'),
(193, 'Pearlescent', 'Grace REd'),
(194, 'Pearlescent', 'Garnet Red'),
(195, 'Pearlescent', 'Sunset Red'),
(196, 'Pearlescent', 'Cabernet REd'),
(197, 'Pearlescent', 'Wine REd'),
(198, 'Pearlescent', 'Candy Red'),
(199, 'Pearlescent', 'Hot Pink'),
(200, 'Pearlescent', 'Pfister Pink'),
(201, 'Pearlescent', 'salmon Pink'),
(202, 'Pearlescent', 'Sunrise Orange'),
(203, 'Pearlescent', 'Orange'),
(204, 'Pearlescent', 'Bright Orange'),
(205, 'Pearlescent', 'Gold Bronze'),
(206, 'Pearlescent', 'Yellow'),
(207, 'Pearlescent', 'Race Yellow'),
(208, 'Pearlescent', 'Dew Yellow'),
(209, 'Pearlescent', 'Dark Green'),
(210, 'Pearlescent', 'Racing Green'),
(211, 'Pearlescent', 'Sea Green'),
(212, 'Pearlescent', 'Olive Green'),
(213, 'Pearlescent', 'Bright Green'),
(214, 'Pearlescent', 'Gasoline Green'),
(215, 'Pearlescent', 'Lime Green'),
(216, 'Pearlescent', 'Midnight Blue'),
(217, 'Pearlescent', 'Galazy BLue'),
(218, 'Pearlescent', 'Dark Blue'),
(219, 'Pearlescent', 'Saxon Blue'),
(220, 'Pearlescent', 'Blue'),
(221, 'Pearlescent', 'Mariner Bue'),
(222, 'Pearlescent', 'Harbor Blue'),
(223, 'Pearlescent', 'Diamond BLue'),
(224, 'Pearlescent', 'Surf Blue'),
(225, 'Pearlescent', 'Nauical Blue'),
(226, 'Pearlescent', 'Racing BLue'),
(227, 'Pearlescent', 'Ultra BLue'),
(228, 'Pearlescent', 'Light BLue'),
(229, 'Pearlescent', 'Chocolate Brown'),
(230, 'Pearlescent', 'Bison Brown'),
(231, 'Pearlescent', 'Creek Brown'),
(232, 'Pearlescent', 'Feltzer Brown'),
(233, 'Pearlescent', 'Maple Brown'),
(234, 'Pearlescent', 'Beechwood Brown'),
(235, 'Pearlescent', 'Sienna Brown'),
(236, 'Pearlescent', 'Saddle Brown'),
(237, 'Pearlescent', 'Moss Brown'),
(238, 'Pearlescent', 'Woodbeech Brown'),
(239, 'Pearlescent', 'Straw Brown'),
(240, 'Pearlescent', 'Sandy BRown'),
(241, 'Pearlescent', 'Bleached Brown'),
(242, 'Pearlescent', 'Schafter Purple'),
(243, 'Pearlescent', 'Spinnaker Purple'),
(244, 'Pearlescent', 'Midnight Purple'),
(245, 'Pearlescent', 'Bright Purple'),
(246, 'Pearlescent', 'Cream'),
(247, 'Pearlescent', 'Ice White'),
(248, 'Pearlescent', 'Frost White');


--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(0, 'Head Administrators'),
(1, 'Communications'),
(2, 'EMS'),
(3, 'Fire'),
(4, 'Highway'),
(5, 'Police'),
(6, 'Sheriff'),
(7, 'Civilian'),
(8, 'Admins'),
(9, 'State');

-- --------------------------------------------------------

--
-- Table structure for table `dispatchers`
--

CREATE TABLE `dispatchers` (
  `identifier` varchar(255) NOT NULL,
  `callsign` varchar(255) NOT NULL COMMENT 'Unit Callsign',
  `status` int(11) NOT NULL COMMENT 'Unit status, 0=offline, 1=online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` INT(11) NOT NULL,
  `genders` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `genders`) VALUES
(0, 'Agender'),
(1, 'Androgyne'),
(2, 'Androgynous'),
(3, 'Bigender'),
(4, 'Cis Female'),
(5, 'Cis Male'),
(6, 'Female'),
(7, 'Gender Fluid'),
(8, 'Gender Nonconforming'),
(9, 'Gender Questioning'),
(10, 'Gender Variant'),
(11, 'Genderqueer'),
(12, 'Intersex'),
(13, 'Male'),
(14, 'Neither'),
(15, 'Neutrois'),
(16, 'Non-binary'),
(17, 'Other'),
(18, 'Pangender'),
(19, 'Transgender Female'),
(20, 'Transgender Male'),
(21, 'Transgender Person'),
(22, 'Transsexual Female'),
(23, 'Transsexual Male'),
(24, 'Transsexual Person'),
(25, 'Two-Spirit');

-- --------------------------------------------------------

--
-- Table structure for table `incident_type`
--

CREATE TABLE `incident_type` (
  `code_id` varchar(255) NOT NULL DEFAULT '',
  `code_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incident_type`
--

INSERT INTO `incident_type` (`code_id`, `code_name`) VALUES
('68', 'Armed Robbery'),
('25', 'Domestic Dispute'),
('10', 'Fight in Progress'),
('49', 'Homicide'),
('55', 'Intoxicated Driver'),
('56', 'Intoxicated Person'),
('62', 'Kidnapping'),
('66', 'Reckless Driver'),
('13', 'Shots Fired'),
('16', 'Stolen Vehicle'),
('17', 'Suspicious Person'),
('11', 'Traffic Stop'),
('50', 'Vehicle Accident');

-- --------------------------------------------------------

--
-- Table structure for table `ncic_citations`
--

CREATE TABLE `ncic_citations` (
  `id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 = Pending, 1 = Approved/Active',
  `name_id` int(11) NOT NULL COMMENT 'Paired to ID of ncic_names table',
  `citation_name` varchar(255) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `issued_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_names`
--

CREATE TABLE `ncic_names` (
  `id` int(11) NOT NULL,
  `submittedByName` varchar(255) NOT NULL,
  `submittedById` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL COMMENT 'Date of birth',
  `address` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `race` text NOT NULL,
  `dl_status` set('Valid','Suspended','Expired') NOT NULL,
  `hair_color` text NOT NULL,
  `build` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_plates`
--

CREATE TABLE `ncic_plates` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `veh_plate` text NOT NULL,
  `veh_make` text NOT NULL,
  `veh_model` text NOT NULL,
  `veh_pcolor` text NOT NULL,
  `veh_scolor` text NOT NULL,
  `veh_insurance` set('VALID','EXPIRED') NOT NULL DEFAULT 'VALID',
  `flags` set('NONE','STOLEN','WANTED','SUSPENDED REGISTRATION','UC FLAG','HPIU FLAG') NOT NULL DEFAULT 'NONE',
  `veh_reg_state` text NOT NULL,
  `notes` text DEFAULT NULL COMMENT 'Any special flags visible to dispatchers',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_warrants`
--

CREATE TABLE `ncic_warrants` (
  `id` int(11) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `warrant_name` varchar(255) NOT NULL,
  `issuing_agency` varchar(255) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Key that pairs to the ncic_name id',
  `issued_date` date DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncic_weapons`
--

CREATE TABLE `ncic_weapons` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL COMMENT 'Links to ncic_names db for driver information',
  `serial` varchar(255) NOT NULL,
  `weapon_type` varchar(255) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `perm_id` int(11) NOT NULL,
  `perm_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(11) NOT NULL,
  `status_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `status_text`) VALUES
(1, '10-8 | Available'),
(2, '10-6 | Busy'),
(4, '10-5 | Meal Break'),
(5, 'Signal 11'),
(6, '10-7 | Unavailable'),
(7, '10-23 | Arrived on Scene'),
(8, '10-65 | Transporting Prisoner');

-- --------------------------------------------------------

--
-- Table structure for table `streets`
--

CREATE TABLE `streets` (
  `id` int(11) NOT NULL COMMENT 'Primary key for each street',
  `name` text NOT NULL COMMENT 'Street name',
  `county` text NOT NULL COMMENT 'County name'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `streets`
--

INSERT INTO `streets` (`id`, `name`, `county`) VALUES
(1, 'Abattoir Avenue', 'Los Santos County'),
(2, 'Abe Milton Parkway', 'Los Santos County'),
(3, 'Ace Jones Drive', 'Los Santos County'),
(4, 'Adam\'s Apple Boulevard', 'Los Santos County'),
(5, 'Aguja Street', 'Los Santos County'),
(6, 'Alta Place', 'Los Santos County'),
(7, 'Alta Street', 'Los Santos County'),
(8, 'Amarillo Vista', 'Los Santos County'),
(9, 'Amarillo Way', 'Los Santos County'),
(10, 'Americano Way', 'Los Santos County'),
(11, 'Atlee Street', 'Los Santos County'),
(12, 'Autopia Parkway', 'Los Santos County'),
(13, 'Banham Canyon Drive', 'Los Santos County'),
(14, 'Barbareno Road', 'Los Santos County'),
(15, 'Bay City Avenue', 'Los Santos County'),
(16, 'Bay City Incline', 'Los Santos County'),
(17, 'Baytree Canyon Road (City)', 'Los Santos County'),
(18, 'Boulevard Del Perro', 'Los Santos County'),
(19, 'Bridge Street', 'Los Santos County'),
(20, 'Brouge Avenue', 'Los Santos County'),
(21, 'Buccaneer Way', 'Los Santos County'),
(22, 'Buen Vino Road', 'Los Santos County'),
(23, 'Caesars Place', 'Los Santos County'),
(24, 'Calais Avenue', 'Los Santos County'),
(25, 'Capital Boulevard', 'Los Santos County'),
(26, 'Carcer Way', 'Los Santos County'),
(27, 'Carson Avenue', 'Los Santos County'),
(28, 'Chum Street', 'Los Santos County'),
(29, 'Chupacabra Street', 'Los Santos County'),
(30, 'Clinton Avenue', 'Los Santos County'),
(31, 'Cockingend Drive', 'Los Santos County'),
(32, 'Conquistador Street', 'Los Santos County'),
(33, 'Cortes Street', 'Los Santos County'),
(34, 'Cougar Avenue', 'Los Santos County'),
(35, 'Covenant Avenue', 'Los Santos County'),
(36, 'Cox Way', 'Los Santos County'),
(37, 'Crusade Road', 'Los Santos County'),
(38, 'Davis Avenue', 'Los Santos County'),
(39, 'Decker Street', 'Los Santos County'),
(40, 'Didion Drive', 'Los Santos County'),
(41, 'Dorset Drive', 'Los Santos County'),
(42, 'Dorset Place', 'Los Santos County'),
(43, 'Dry Dock Street', 'Los Santos County'),
(44, 'Dunstable Drive', 'Los Santos County'),
(45, 'Dunstable Lane', 'Los Santos County'),
(46, 'Dutch London Street', 'Los Santos County'),
(47, 'Eastbourne Way', 'Los Santos County'),
(48, 'East Galileo Avenue', 'Los Santos County'),
(49, 'East Mirror Drive', 'Los Santos County'),
(50, 'Eclipse Boulevard', 'Los Santos County'),
(51, 'Edwood Way', 'Los Santos County'),
(52, 'Elgin Avenue', 'Los Santos County'),
(53, 'El Burro Boulevard', 'Los Santos County'),
(54, 'El Rancho Boulevard', 'Los Santos County'),
(55, 'Equality Way', 'Los Santos County'),
(56, 'Exceptionalists Way', 'Los Santos County'),
(57, 'Fantastic Place', 'Los Santos County'),
(58, 'Fenwell Place', 'Los Santos County'),
(59, 'Forum Drive', 'Los Santos County'),
(60, 'Fudge Lane', 'Los Santos County'),
(61, 'Galileo Road', 'Los Santos County'),
(62, 'Gentry Lane', 'Los Santos County'),
(63, 'Ginger Street', 'Los Santos County'),
(64, 'Glory Way', 'Los Santos County'),
(65, 'Goma Street', 'Los Santos County'),
(66, 'Greenwich Parkway', 'Los Santos County'),
(67, 'Greenwich Place', 'Los Santos County'),
(68, 'Greenwich Way', 'Los Santos County'),
(69, 'Grove Street', 'Los Santos County'),
(70, 'Hanger Way', 'Los Santos County'),
(71, 'Hangman Avenue', 'Los Santos County'),
(72, 'Hardy Way', 'Los Santos County'),
(73, 'Hawick Avenue', 'Los Santos County'),
(74, 'Heritage Way', 'Los Santos County'),
(75, 'Hillcrest Avenue', 'Los Santos County'),
(76, 'Hillcrest Ridge Access Road', 'Los Santos County'),
(77, 'Imagination Court', 'Los Santos County'),
(78, 'Industry Passage', 'Los Santos County'),
(79, 'Ineseno Road', 'Los Santos County'),
(80, 'Integrity Way', 'Los Santos County'),
(81, 'Invention Court', 'Los Santos County'),
(82, 'Innocence Boulevard', 'Los Santos County'),
(83, 'Jamestown Street', 'Los Santos County'),
(84, 'Kimble Hill Drive', 'Los Santos County'),
(85, 'Kortz Drive', 'Los Santos County'),
(86, 'Labor Place', 'Los Santos County'),
(87, 'Laguna Place', 'Los Santos County'),
(88, 'Lake Vinewood Drive', 'Los Santos County'),
(89, 'Las Lagunas Boulevard', 'Los Santos County'),
(90, 'Liberty Street', 'Los Santos County'),
(91, 'Lindsay Circus', 'Los Santos County'),
(92, 'Little Bighorn Avenue', 'Los Santos County'),
(93, 'Low Power Street', 'Los Santos County'),
(94, 'Macdonald Street', 'Los Santos County'),
(95, 'Mad Wayne Thunder Drive', 'Los Santos County'),
(96, 'Magellan Avenue', 'Los Santos County'),
(97, 'Marathon Avenue', 'Los Santos County'),
(98, 'Marlowe Drive', 'Los Santos County'),
(99, 'Melanoma Street', 'Los Santos County'),
(100, 'Meteor Street', 'Los Santos County'),
(101, 'Milton Road', 'Los Santos County'),
(102, 'Mirror Park Boulevard', 'Los Santos County'),
(103, 'Mirror Place', 'Los Santos County'),
(104, 'Morningwood Boulevard', 'Los Santos County'),
(105, 'Mount Haan Drive', 'Los Santos County'),
(106, 'Mount Haan Road', 'Los Santos County'),
(107, 'Mount Vinewood Drive', 'Los Santos County'),
(108, 'Movie Star Way', 'Los Santos County'),
(109, 'Mutiny Road', 'Los Santos County'),
(110, 'New Empire Way', 'Los Santos County'),
(111, 'Nikola Avenue', 'Los Santos County'),
(112, 'Nikola Place', 'Los Santos County'),
(113, 'Normandy Drive', 'Los Santos County'),
(114, 'North Archer Avenue', 'Los Santos County'),
(115, 'North Conker Avenue', 'Los Santos County'),
(116, 'North Sheldon Avenue', 'Los Santos County'),
(117, 'North Rockford Drive', 'Los Santos County'),
(118, 'Occupation Avenue', 'Los Santos County'),
(119, 'Orchardville Avenue', 'Los Santos County'),
(120, 'Palomino Avenue', 'Los Santos County'),
(121, 'Peaceful Street', 'Los Santos County'),
(122, 'Perth Street', 'Los Santos County'),
(123, 'Picture Perfect Drive', 'Los Santos County'),
(124, 'Plaice Place', 'Los Santos County'),
(125, 'Playa Vista', 'Los Santos County'),
(126, 'Popular Street', 'Los Santos County'),
(127, 'Portola Drive', 'Los Santos County'),
(128, 'Power Street', 'Los Santos County'),
(129, 'Prosperity Street', 'Los Santos County'),
(130, 'Prosperity Street Promenade', 'Los Santos County'),
(131, 'Red Desert Avenue', 'Los Santos County'),
(132, 'Richman Street', 'Los Santos County'),
(133, 'Rockford Drive', 'Los Santos County'),
(134, 'Roy Lowenstein Boulevard', 'Los Santos County'),
(135, 'Rub Street', 'Los Santos County'),
(136, 'Sam Austin Drive', 'Los Santos County'),
(137, 'San Andreas Avenue', 'Los Santos County'),
(138, 'Sandcastle Way', 'Los Santos County'),
(139, 'San Vitus Boulevard', 'Los Santos County'),
(140, 'Senora Road', 'Los Santos County'),
(141, 'Shank Street', 'Los Santos County'),
(142, 'Signal Street', 'Los Santos County'),
(143, 'Sinner Street', 'Los Santos County'),
(144, 'Sinners Passage', 'Los Santos County'),
(145, 'South Arsenal Street', 'Los Santos County'),
(146, 'South Boulevard Del Perro', 'Los Santos County'),
(147, 'South Mo Milton Drive', 'Los Santos County'),
(148, 'South Rockford Drive', 'Los Santos County'),
(149, 'South Shambles Street', 'Los Santos County'),
(150, 'Spanish Avenue', 'Los Santos County'),
(151, 'Steele Way', 'Los Santos County'),
(152, 'Strangeways Drive', 'Los Santos County'),
(153, 'Strawberry Avenue', 'Los Santos County'),
(154, 'Supply Street', 'Los Santos County'),
(155, 'Sustancia Road', 'Los Santos County'),
(156, 'Swiss Street', 'Los Santos County'),
(157, 'Tackle Street', 'Los Santos County'),
(158, 'Tangerine Street', 'Los Santos County'),
(159, 'Tongva Drive', 'Los Santos County'),
(160, 'Tower Way', 'Los Santos County'),
(161, 'Tug Street', 'Los Santos County'),
(162, 'Utopia Gardens', 'Los Santos County'),
(163, 'Vespucci Boulevard', 'Los Santos County'),
(164, 'Vinewood Boulevard', 'Los Santos County'),
(165, 'Vinewood Park Drive', 'Los Santos County'),
(166, 'Vitus Street', 'Los Santos County'),
(167, 'Voodoo Place', 'Los Santos County'),
(168, 'West Eclipse Boulevard', 'Los Santos County'),
(169, 'West Galileo Avenue', 'Los Santos County'),
(170, 'West Mirror Drive', 'Los Santos County'),
(171, 'Whispymound Drive', 'Los Santos County'),
(172, 'Wild Oats Drive', 'Los Santos County'),
(173, 'York Street', 'Los Santos County'),
(174, 'Zancudo Barranca', 'LOS Santos'),
(175, 'Algonquin Boulevard', 'Blaine County'),
(176, 'Alhambra Drive', 'Blaine County'),
(177, 'Armadillo Avenue', 'Blaine County'),
(178, 'Baytree Canyon Road (County)', 'Blaine County'),
(179, 'Calafia Road', 'Blaine County'),
(180, 'Cascabel Avenue', 'Blaine County'),
(181, 'Cassidy Trail', 'Blaine County'),
(182, 'Cat-Claw Avenue', 'Blaine County'),
(183, 'Chianski Passage', 'Blaine County'),
(184, 'Cholla Road', 'Blaine County'),
(185, 'Cholla Springs Avenue', 'Blaine County'),
(186, 'Duluoz Avenue', 'Blaine County'),
(187, 'East Joshua Road', 'Blaine County'),
(188, 'Fort Zancudo Approach Road', 'Blaine County'),
(189, 'Galileo Road', 'Blaine County'),
(190, 'Grapeseed Avenue', 'Blaine County'),
(191, 'Grapeseed Main Street', 'Blaine County'),
(192, 'Joad Lane', 'Blaine County'),
(193, 'Joshua Road', 'Blaine County'),
(194, 'Lesbos Lane', 'Blaine County'),
(195, 'Lolita Avenue', 'Blaine County'),
(196, 'Marina Drive', 'Blaine County'),
(197, 'Meringue Lane', 'Blaine County'),
(198, 'Mount Haan Road', 'Blaine County'),
(199, 'Mountain View Drive', 'Blaine County'),
(200, 'Niland Avenue', 'Blaine County'),
(201, 'North Calafia Way', 'Blaine County'),
(202, 'Nowhere Road', 'Blaine County'),
(203, 'O\'Neil Way', 'Blaine County'),
(204, 'Paleto Boulevard', 'Blaine County'),
(205, 'Panorama Drive', 'Blaine County'),
(206, 'Procopio Drive', 'Blaine County'),
(207, 'Procopio Promenade', 'Blaine County'),
(208, 'Pyrite Avenue', 'Blaine County'),
(209, 'Raton Pass', 'Blaine County'),
(210, 'Route 68 Approach', 'Blaine County'),
(211, 'Seaview Road', 'Blaine County'),
(212, 'Senora Way', 'Blaine County'),
(213, 'Smoke Tree Road', 'Blaine County'),
(214, 'Union Road', 'Blaine County'),
(215, 'Zancudo Avenue', 'Blaine County'),
(216, 'Zancudo Road', 'Blaine County'),
(217, 'Zancudo Trail', 'Blaine County'),
(218, 'Interstate 1', 'State'),
(219, 'Interstate 2', 'State'),
(220, 'Interstate 4', 'State'),
(221, 'Interstate 5', 'State'),
(222, 'Route 1', 'State'),
(223, 'Route 11', 'State'),
(224, 'Route 13', 'State'),
(225, 'Route 14', 'State'),
(226, 'Route 15', 'State'),
(227, 'Route 16', 'State'),
(228, 'Route 17', 'State'),
(229, 'Route 18', 'State'),
(230, 'Route 19', 'State'),
(231, 'Route 20', 'State'),
(232, 'Route 22', 'State'),
(233, 'Route 23', 'State'),
(234, 'Route 68', 'State\r\n    ');

-- --------------------------------------------------------

--
-- Table structure for table `tones`
--

CREATE TABLE `tones` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` set('0','1') NOT NULL DEFAULT '0' COMMENT '0 = inactive, 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tones table. DO NOT ADD ROWS TO THIS TABLE' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `identifier` varchar(255) DEFAULT NULL,
  `password_reset` int(1) NOT NULL DEFAULT '0' COMMENT '1 means password reset required. 0 means it''s not.',
  `approved` int(1) NOT NULL DEFAULT '0' COMMENT 'Three main statuses: 0 means pending approval. 1 means has access. 2 means banned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User table' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `identifier`, `password_reset`, `approved`) VALUES
(21, 'Default Admin', 'admin@test.com', '$2y$10$xHvogGcqQs8jhTPbFEDHJO9KWu2FCLgJ5XGxH.hHMA0BY1brgCkSG', '1A-98', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments`
--

INSERT INTO `user_departments` (`user_id`, `department_id`) VALUES
(21, 0),
(21, 1),
(21, 2),
(21, 3),
(21, 4),
(21, 5),
(21, 6),
(21, 7),
(21, 8),
(21, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_departments_temp`
--

CREATE TABLE `user_departments_temp` (
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporary table - stores user departments for non-approved users' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_departments_temp`
--

INSERT INTO `user_departments_temp` (`user_id`, `department_id`) VALUES
(21, 7),
(21, 1),
(21, 5),
(24, 1),
(26, 7);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `Make` varchar(100) NOT NULL,
  `Model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `Make`, `Model`) VALUES
(1, 'Albany', 'Alpha'),
(2, 'Albany', 'Buccaneer'),
(3, 'Albany', 'Buccaneer Custom'),
(4, 'Albany', 'Cavalcade'),
(5, 'Albany', 'Cavalcade FXT'),
(6, 'Albany', 'Emperor'),
(7, 'Albany', 'Esperanto'),
(8, 'Albany', 'Fanken Stange'),
(9, 'Albany', 'Lurcher'),
(10, 'Albany', 'Manana'),
(11, 'Albany', 'Presidente'),
(12, 'Albany', 'Primo'),
(13, 'Albany', 'Primo Custom'),
(14, 'Albany', 'Police Road Crusiser'),
(15, 'Albany', 'Police Stinger'),
(16, 'Albany', 'Roman’s Taxi'),
(17, 'Albany', 'Romero'),
(18, 'Albany', 'Roosevelt'),
(19, 'Albany', 'Roosevelt Valor'),
(20, 'Albany', 'Stretch'),
(21, 'Albany', 'Virgo'),
(22, 'Albany', 'Washington'),
(23, 'Annis', 'Elergy Retro Custom'),
(24, 'Annis', 'Elergy RH8'),
(25, 'Annis', 'Pinacle'),
(26, 'Annis', 'RE-7B'),
(27, 'Benefactor', 'Dubsta'),
(28, 'Benefactor', 'Dubsta 6x6'),
(29, 'Benefactor', 'Feltzer'),
(30, 'Benefactor', 'Glendale'),
(31, 'Benefactor', 'Panto'),
(32, 'Benefactor', 'Schafter'),
(33, 'Benefactor', 'Schater v12'),
(34, 'Benefactor', 'Schafter v12 Armored'),
(35, 'Benefactor', 'Schafter LWB'),
(36, 'Benefactor', 'Schafter LWB Armored'),
(37, 'Benefactor', 'Schwartzer'),
(38, 'Benefactor', 'Serrano'),
(39, 'Benefactor', 'Stretch E'),
(40, 'Benefactor', 'Surano'),
(41, 'Benefactor', 'Stirling GT'),
(42, 'Benefactor', 'Turreted Limo'),
(43, 'Benefactor', 'XLS'),
(44, 'Benefactor', 'XLS Armored'),
(45, 'BF', 'Bifta'),
(46, 'BF', 'Dune Buggy'),
(47, 'BF', 'Dune FAV'),
(48, 'BF', 'Injection'),
(49, 'BF', 'Ramp Buggy'),
(50, 'BF', 'Raptor'),
(51, 'BF', 'Space Docker'),
(52, 'BF', 'Surfer'),
(53, 'Bollokan', 'Paririe'),
(54, 'Bravado', 'Banshee'),
(55, 'Bravado', 'Banshee 900R'),
(56, 'Bravado', 'Bison'),
(57, 'Bravado', 'Buffalo'),
(58, 'Bravado', 'Buffalo S'),
(59, 'Bravado', 'Duneloader'),
(60, 'Bravado', 'Feroci'),
(61, 'Bravado', 'FIB'),
(62, 'Bravado', 'Gantlet'),
(63, 'Bravado', 'Gresley'),
(64, 'Bravado', 'Half-track'),
(65, 'Bravado', 'Paradise'),
(66, 'Bravado', 'Police Cruiser'),
(67, 'Bravado', 'Rat-Loader'),
(68, 'Bravado', 'Rat Truck'),
(69, 'Bravado', 'Redwood Gauntlet'),
(70, 'Bravado', 'Rumpo'),
(71, 'Bravado', 'Rumpo Custom'),
(72, 'Bravado', 'Sprunk Buffalo'),
(73, 'Bravado', 'Verlierer'),
(74, 'Bravado', 'Youga'),
(75, 'Bravado', 'Youga Classic'),
(76, 'Brute', 'Airport Bus'),
(77, 'Brute', 'Alphamail'),
(78, 'Brute', 'Armored Boxbville'),
(79, 'Brute', 'Ambulance'),
(80, 'Brute', 'Boxville'),
(81, 'Brute', 'Bus'),
(82, 'Brute', 'Camper'),
(83, 'Brute', 'Dashound'),
(84, 'Brute', 'Enforcer'),
(85, 'Brute', 'Mr. Tasty'),
(86, 'Brute', 'Police Riot'),
(87, 'Brute', 'Police Stockade'),
(88, 'Brute', 'Pony'),
(89, 'Brute', 'Rental Shuttle Bus'),
(90, 'Brute', 'Stockade'),
(91, 'Brute', 'Taco Van'),
(92, 'Brute', 'Tour Bus'),
(93, 'Brute', 'Utility Truck'),
(94, 'Buckingham', 'Maverick'),
(95, 'Buckingham', 'Police Maverick'),
(96, 'Buckingham', 'Super Volito'),
(97, 'Buckingham', 'Super Volito Carbon'),
(98, 'Buckingham', 'Swift'),
(99, 'Buckingham', 'Swift Delux'),
(100, 'Buckingham', 'Volatus'),
(101, 'Buckingham', 'Valkyrie'),
(102, 'Buckingham', 'Valkyrie MOD.0'),
(103, 'Buckingham', 'Alpha-Z1'),
(104, 'Buckingham', 'Howard NX-25'),
(105, 'Buckingham', 'Vestra'),
(106, 'Buckingham', 'Shamal'),
(107, 'Buckingham', 'Luxor'),
(108, 'Buckingham', 'Luxor Deluxe'),
(109, 'Buckingham', 'Nimbus'),
(110, 'Buckingham', 'Miljet'),
(111, 'Buckingham', 'Pyro'),
(112, 'Buckingham', 'Tug'),
(113, 'Canis', 'Bodhi'),
(114, 'Canis', 'Crusader'),
(115, 'Canis', 'Mesa'),
(116, 'Canis', 'Kalahari'),
(117, 'Canis', 'Seminole'),
(118, 'Chariot', 'Romero Hearse'),
(119, 'Cheval', 'Fugitive'),
(120, 'Cheval', 'Marshall'),
(121, 'Cheval', 'Picador'),
(122, 'Cheval', 'Surge'),
(123, 'Classique', 'Salton'),
(124, 'Coil', 'Brawler'),
(125, 'Coil', 'Rocker Voltic'),
(126, 'Coil', 'Voltic'),
(127, 'Desclasse', 'Rhapsody'),
(128, 'Desclasse', 'Mamba'),
(129, 'Desclasse', 'Voodoo'),
(130, 'Desclasse', 'Voodoo Custom'),
(131, 'Desclasse', 'Tornado'),
(132, 'Desclasse', 'Tornado Custom'),
(133, 'Desclasse', 'Tornado Rat Rod'),
(134, 'Desclasse', 'Vigero'),
(135, 'Desclasse', 'Tampa'),
(136, 'Desclasse', 'Drift Tampa'),
(137, 'Desclasse', 'Stallion'),
(138, 'Desclasse', 'Burger Shot Stallion'),
(139, 'Desclasse', 'Sabre'),
(140, 'Desclasse', 'Sabre Turbo'),
(141, 'Desclasse', 'Sabre Turbo Custom'),
(142, 'Desclasse', 'Asea'),
(143, 'Desclasse', 'Premier'),
(144, 'Desclasse', 'Merit'),
(145, 'Desclasse', 'Taxi'),
(146, 'Desclasse', 'Police Patrol'),
(147, 'Desclasse', 'Racnher'),
(148, 'Desclasse', 'Racher XL'),
(149, 'Desclasse', 'Police Rancher'),
(150, 'Desclasse', 'Granger'),
(151, 'Desclasse', 'Lifeguard'),
(152, 'Desclasse', 'Park Ranger'),
(153, 'Desclasse', 'Sheriff SUV'),
(154, 'Desclasse', 'Moonbeam'),
(155, 'Desclasse', 'Moonbeam Custom'),
(156, 'Desclasse', 'Burrito'),
(157, 'Desclasse', 'Laundromat'),
(158, 'Desclasse', 'Gang Burrito'),
(159, 'Desclasse', 'Police Transporter'),
(160, 'Dewbauchee', 'Emeplar'),
(161, 'Dewbauchee', 'JB 700'),
(162, 'Dewbauchee', 'Massacro'),
(163, 'Dewbauchee', 'Massacro Racecar'),
(164, 'Dewbauchee', 'Rapid GT'),
(165, 'Dewbauchee', 'Rapid GT Classic'),
(166, 'Dewbauchee', 'Seven-70'),
(167, 'Dewbauchee', 'Specter'),
(168, 'Dewbauchee', 'Specter Custom'),
(169, 'Dewbauchee', 'Super GT'),
(170, 'Dewbauchee', 'Vagner'),
(171, 'Dinka', 'Akuma'),
(172, 'Dinka', 'Blista'),
(173, 'Dinka', 'Blista Compact'),
(174, 'Dinka', 'Chavos'),
(175, 'Dinka', 'Double-T'),
(176, 'Dinka', 'Double-T Custom'),
(177, 'Dinka', 'Enduro'),
(178, 'Dinka', 'Go Go Monkey Blista'),
(179, 'Dinka', 'Hakumai'),
(180, 'Dinka', 'Jester'),
(181, 'Dinka', 'Jester Racecar'),
(182, 'Dinka', 'Marquis'),
(183, 'Dinka', 'Perennial'),
(184, 'Dinka', 'Thrust'),
(185, 'Dinka', 'Vindicator'),
(186, 'DUDE', 'Cement Truck'),
(187, 'DUDE', 'Dozer'),
(188, 'DUDE', 'Dumper'),
(189, 'DUDE', 'Crane'),
(190, 'Dundreary', 'Amiral'),
(191, 'Dundreary', 'Landstalker'),
(192, 'Dundreary', 'Regina'),
(193, 'Dundreary', 'Stretch'),
(194, 'Dundreary', 'Virgo Classic'),
(195, 'Dundreary', 'Virgo Classic Custom'),
(196, 'Emperor', 'ETR1'),
(197, 'Emperor', 'Habanero'),
(198, 'Emperor', 'Lokus'),
(199, 'Enus', 'Cognoscenti'),
(200, 'Enus', 'Cognoscenti Armored'),
(201, 'Enus', 'Cognoscenti 55'),
(202, 'Enus', 'Cognoscenti 55 Armored'),
(203, 'Enus', 'Cagnoscenti Cabrio'),
(204, 'Enus', 'Huntley S'),
(205, 'Enus', 'Super Diamond'),
(206, 'Enus', 'Super Drop Diamond'),
(207, 'Enus', 'Windsor'),
(208, 'Enus', 'Windsor Drop'),
(209, 'Fathom', 'FQ 2'),
(210, 'Gallivanter', 'Baller 1st Gen'),
(211, 'Gallivanter', 'Baller 2nd Gen'),
(212, 'Gallivanter', 'Baller LE'),
(213, 'Gallivanter', 'Baller LE Armored'),
(214, 'Gallivanter', 'Ballar LE LWB'),
(215, 'Gallivanter', 'Baller LE LWB Armored'),
(216, 'Grotti', 'Blade'),
(217, 'Grotti', 'Brioso'),
(218, 'Grotti', 'Briso R/A'),
(219, 'Grotti', 'Carbonuzzare'),
(220, 'Grotti', 'Cheetah'),
(221, 'Grotti', 'Cheeta Classic'),
(222, 'Grotti', 'Tirosmo'),
(223, 'Grotti', 'X80 Pronto'),
(224, 'HVY', 'Airtug'),
(225, 'HVY', 'Ripley'),
(226, 'HVY', 'Forklift'),
(227, 'HVY', 'Dock Handler'),
(228, 'HVY', 'Crane'),
(229, 'HVY', 'Skylift'),
(230, 'HVY', 'Docktug'),
(231, 'HVY', ' Biff'),
(232, 'HVY', ' Biff-chassis Mixer'),
(233, 'HVY', 'Tipper-chassis Mixer'),
(234, 'HVY', 'Biff-chassis Mixwe'),
(235, 'HVY', 'Dozer'),
(236, 'HVY', 'Cutter'),
(237, 'HVY', 'Dump'),
(238, 'HVY', ' Insurgent'),
(239, 'HVY', ' Insurgent Pick-Up'),
(240, 'HVY', 'Insurgent Pick-Up Custom'),
(241, 'HVY', 'Barracks Semi'),
(242, 'HVY', ' Barracks'),
(243, 'HVY', 'APC'),
(244, 'Hijack', 'Khamelion'),
(245, 'Hijack', 'Ruston'),
(246, 'Imponte', 'DF8-90'),
(247, 'Imponte', 'Duke O\'Death'),
(248, 'Imponte', 'Duke'),
(249, 'Imponte', 'Phoenix'),
(250, 'Imponte', 'Ruiner'),
(251, 'Imponte', 'Ruiner 2000'),
(252, 'Invetero', 'Coquette'),
(253, 'Invetero', 'Coquette upgraded'),
(254, 'Invetero', 'Coquette BlackFin'),
(255, 'Invetero', 'Coquette Classic'),
(256, 'Jacksheepe', 'Lawn Mower'),
(257, 'JoBuilt', 'Hauler'),
(258, 'JoBuilt', 'Hauler Custom'),
(259, 'JoBuilt', 'Mammatus'),
(260, 'JoBuilt', 'P-996 Lazer'),
(261, 'JoBuilt', 'Phantom'),
(262, 'JoBuilt', 'Phantom Custom'),
(263, 'JoBuilt', 'Phantom Wedge'),
(264, 'JoBuilt', 'Rubble'),
(265, 'JoBuilt', 'Trashmaster'),
(266, 'JoBuilt', 'Velum'),
(267, 'JoBuilt', 'Velum 5-Seater'),
(268, 'Karin', 'Asterope'),
(269, 'Karin', 'BeeJay XL'),
(270, 'Karin', 'Dilettante'),
(271, 'Karin', 'Futo'),
(272, 'Karin', 'Intruder'),
(273, 'Karin', 'Kuruma'),
(274, 'Karin', 'Rebel'),
(275, 'Karin', 'Sultan'),
(276, 'Karin', 'Sultan RS'),
(277, 'Karin', 'Technical'),
(278, 'Karin', 'Technical Aqua'),
(279, 'Karin', 'Technical Custom'),
(280, 'Kraken', 'Kraken sub'),
(281, 'Lampadati', 'Casco'),
(282, 'Lampadati', 'Felon'),
(283, 'Lampadati', 'Felon GT'),
(284, 'Lampadati', 'Furore GT'),
(285, 'Lampadati', 'Pigalle'),
(286, 'Lampadati', 'Toro'),
(287, 'Lampadati', 'Troops Rallye'),
(288, 'Libery Chop Shop', 'Lycan'),
(289, 'Libery Chop Shop', 'Nightblade'),
(290, 'Liberty Chop Shop', 'Zombie'),
(291, 'Liberty City Cycles', 'Avarus'),
(292, 'Lampadati', 'Freeway'),
(293, 'Lampadati', 'Hexer'),
(294, 'Lampadati', 'Innovation'),
(295, 'Lampadati', 'Sanctus'),
(296, 'Lampadati', 'Zombis'),
(297, 'Maibatsu Corporation', 'Frogger'),
(298, 'Maibatsu Corporation', 'Manchez'),
(299, 'Maibatsu Corporation', 'Mute'),
(300, 'Maibatsu Corporation', 'Penumbra'),
(301, 'Maibatsu Corporation', 'Sanchez'),
(302, 'Maibatsu Corporation', 'Vincent'),
(303, 'Mammoth', 'Patriot'),
(304, 'Mammoth', 'NOOSE Patriot'),
(305, 'Mammoth', 'Dodo'),
(306, 'Mammoth', 'Mogul'),
(307, 'Mammoth', 'Tula'),
(308, 'MTL', 'Fire Truck'),
(309, 'MTL', 'Packer'),
(310, 'MTL', 'Flatbed'),
(311, 'MTL', 'Pounder'),
(312, 'MTL', 'Wastelander'),
(313, 'MTL', 'Dune'),
(314, 'MTL', 'Brickade'),
(315, 'Nagasaki', 'BF400'),
(316, 'Nagasaki', 'Chimera'),
(317, 'Nagasaki', 'Carbon RS'),
(318, 'Nagasaki', 'Shotaro'),
(319, 'Nagasaki', 'Blazer'),
(320, 'Nagasaki', 'Blazer Lifeguard'),
(321, 'Nagasaki', 'Hot Rod Blazer'),
(322, 'Nagasaki', 'Street Blazer'),
(323, 'Nagasaki', 'Auqa Blazer'),
(324, 'Nagasaki', 'Caddy'),
(325, 'Nagasaki', 'Havok'),
(326, 'Nagasaki', 'Buzzard'),
(327, 'Nagasaki', 'Buzzard Attack Chopper'),
(328, 'Nagasaki', 'Ultralight'),
(329, 'Nagasaki', 'Dinghy'),
(330, 'Obey', '9F'),
(331, 'Obey', '9F Cabrio'),
(332, 'Obey', 'Omnis'),
(333, 'Obey', 'Rocoto'),
(334, 'Obey', 'Tailgater'),
(335, 'Ocelot', 'Ardent'),
(336, 'Ocelot', 'F620'),
(337, 'Ocelot', 'Jackal'),
(338, 'Ocelot', 'Lynx'),
(339, 'Ocelot', 'Penatrator'),
(340, 'Ocelot', 'XA-21'),
(341, 'Overflod', 'Entity XF'),
(342, 'Pegassi', 'Bati 801'),
(343, 'Pegassi', 'Bati 801RR'),
(344, 'Pegassi', 'Esskey'),
(345, 'Pegassi', 'Faggio'),
(346, 'Pegassi', 'Faggio Mod'),
(347, 'Pegassi', 'Faggio Sport'),
(348, 'Pegassi', 'FCR 1000'),
(349, 'Pegassi', 'FCR 1000 Custom'),
(350, 'Pegassi', 'Infernus'),
(351, 'Pegassi', 'Infernus Classic'),
(352, 'Pegassi', 'Monroe'),
(353, 'Pegassi', 'Oppressor'),
(354, 'Pegassi', 'Osiris'),
(355, 'Pegassi', 'Reaper'),
(356, 'Pegassi', 'Ruffian'),
(357, 'Pegassi', 'Speeder'),
(358, 'Pegassi', 'Tempesta'),
(359, 'Pegassi', 'Torero'),
(360, 'Pegassi', 'Vacca'),
(361, 'Pegassi', 'Vortex'),
(362, 'Pfister', '811'),
(363, 'Pfister', 'Comet'),
(364, 'Pfister', 'Comet Retro Custom'),
(365, 'Principle', 'Diaboulus'),
(366, 'Principle', 'Diabolus Custom'),
(367, 'Principle', 'Lectro'),
(368, 'Principle', 'Nemesis'),
(369, 'Progen', 'GP1'),
(370, 'Progen', 'Itali GTB'),
(371, 'Progen', 'Itali GTB Custom'),
(372, 'Progen', 'T20'),
(373, 'Progen', 'Tyrus'),
(374, 'Schyster', 'Fusilade'),
(375, 'Schyster', 'PMP 600'),
(376, 'Schyster', 'Cabby'),
(377, 'Shitzu', 'Defiler'),
(378, 'Shitzu', 'Hakuchou'),
(379, 'Shitzu', 'Hakuchou Drag'),
(380, 'Shitzu', 'NRG 900'),
(381, 'Shitzu', 'Jetmax'),
(382, 'Shitzu', 'Squato'),
(383, 'Shitzu', 'Suntrap'),
(384, 'Shitzu', 'Tropic'),
(385, 'Shitzu', 'Vader'),
(386, 'Speedophile', 'Seashark'),
(387, 'Stanley', 'Tractor'),
(388, 'Stanley', 'Fieldmaster'),
(389, 'Steel Horse', 'Hexer'),
(390, 'Steel Horse', 'Zombie'),
(391, 'Tuffade', 'Adder'),
(392, 'Tuffade', 'Nero'),
(393, 'Tuffade', 'Nero Custom'),
(394, 'Tuffade', 'Z-Type'),
(395, 'Ubermacht', 'Oracle'),
(396, 'Ubermacht', 'Oracle XS'),
(397, 'Ubermacht', 'Rebla'),
(398, 'Ubermacht', 'Sentinial'),
(399, 'Ubermacht', 'Sentinel XS'),
(400, 'Ubermacht', 'Zion'),
(401, 'Ubermacht', 'Zion Cabrio'),
(402, 'Vapid', 'Fortune'),
(403, 'Vapid', 'Retinue'),
(404, 'Vapid', 'Uranus'),
(405, 'Vapid', 'Peyote'),
(406, 'Vapid', 'Chino'),
(407, 'Vapid', 'Blade'),
(408, 'Vapid', 'Dominator'),
(409, 'Vapid', 'Pibwasser Dominator'),
(410, 'Vapid', 'Hotknife'),
(411, 'Vapid', 'Bullet'),
(412, 'Vapid', 'FMJ'),
(413, 'Vapid', 'Sanier'),
(414, 'Vapid', 'Taxi'),
(415, 'Vapid', 'Police Cruiser'),
(416, 'Vapid', 'NOOSE Cruiser'),
(417, 'Vapid', 'Sheriff Cruiser'),
(418, 'Vapid', 'Unmarked Cruiser'),
(419, 'Vapid', 'Police Cruiser Interceptor'),
(420, 'Vapid', 'Huntley Sport'),
(421, 'Vapid', 'Radius'),
(422, 'Vapid', 'Slamvan'),
(423, 'Vapid', 'Slamvan Custom'),
(424, 'Vapid', 'Lost Slamvan'),
(425, 'Vapid', 'Minivan'),
(426, 'Vapid', 'Minivan Custom'),
(427, 'Vapid', 'Speedo'),
(428, 'Vapid', 'Bobcat'),
(429, 'Vapid', 'Bobcat XL'),
(430, 'Vapid', 'Contender'),
(431, 'Vapid', 'Sadler'),
(432, 'Vapid', 'Guardian'),
(433, 'Vapid', 'Sandking SWB'),
(434, 'Vapid', 'Sandking XL'),
(435, 'Vapid', 'Trophy Tuck'),
(436, 'Vapid', 'Desert Raid'),
(437, 'Vapid', 'The Liberator'),
(438, 'Vapid', 'Steed'),
(439, 'Vapid', 'Yankee'),
(440, 'Vapid', 'Benson'),
(441, 'Vapid', 'Scrap Truck'),
(442, 'Vapid', 'Towtruck'),
(443, 'Vapid', 'Prison Bus'),
(444, 'Vulcar', 'Ingo'),
(445, 'Vulcar', 'Warrener'),
(446, 'Weeny', 'Issi'),
(447, 'Western Company', 'Maverick'),
(448, 'Western Company', 'Hellitours Maverick'),
(449, 'Western Company', 'Police Maverick'),
(450, 'Western Company', 'Cargobo'),
(451, 'Western Company', 'Annihailator'),
(452, 'Western Company', 'Duster'),
(453, 'Western Company', 'Mallard'),
(454, 'Western Company', 'Seabreeze'),
(455, 'Western Company', 'Cuban 800'),
(456, 'Western Company', 'Rogue'),
(457, 'Western Company', 'Besra'),
(458, 'Western Motorcycle Company', 'Angel'),
(459, 'Western Motorcycle Company', 'Bagger'),
(460, 'Western Motorcycle Company', 'Cliffhanger'),
(461, 'Western Motorcycle Company', 'Daemon'),
(462, 'Western Motorcycle Company', 'Diaboulus'),
(463, 'Western Motorcycle Company', 'Gargoyle'),
(464, 'Western Motorcycle Company', 'Hellfury'),
(465, 'Western Motorcycle Company', 'Nightblade'),
(466, 'Western Motorcycle Company', 'Police Bike'),
(467, 'Western Motorcycle Company', 'Rat Bike'),
(468, 'Western Motorcycle Company', 'Revenant'),
(469, 'Western Motorcycle Company', 'Sovereign'),
(470, 'Western Motorcycle Company', 'Wayfarer'),
(471, 'Western Motorcycle Company', 'Wolfsbane'),
(472, 'Western Motorcycle Company', 'Zombie Bobber'),
(473, 'Western Motorcycle Company', 'Zombie Chopper'),
(474, 'Willard', 'Faction'),
(475, 'Willard', 'Faction Custom'),
(476, 'Willard', 'Marbelle'),
(477, 'Willard', 'Solair'),
(478, 'Willard', 'Willard'),
(479, 'Zirconium', 'Journey'),
(480, 'Zirconium', 'Stratum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`identifier`) USING BTREE,
  ADD UNIQUE KEY `callsign` (`callsign`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;
--
-- Indexes for table `bolos_persons`
--
ALTER TABLE `bolos_persons`
  ADD PRIMARY KEY (`id`) USING BTREE;
--
-- Indexes for table `bolos_persons`
--
ALTER TABLE `bolos_vehicles`
  ADD PRIMARY KEY (`id`) USING BTREE;
  
--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `calls_users`
--
ALTER TABLE `calls_users`
  ADD PRIMARY KEY (`call_id`,`identifier`) USING BTREE;

--
-- Indexes for table `call_history`
--
ALTER TABLE `call_history`
  ADD PRIMARY KEY (`call_id`) USING BTREE;

--
-- Indexes for table `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `citation_name` (`citation_name`) USING BTREE;

--
-- Indexes for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD PRIMARY KEY (`user_id`,`names_id`) USING BTREE,
  ADD UNIQUE KEY `names_id` (`names_id`) USING BTREE;

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`) USING BTREE;
  
--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`) USING BTREE;
  
--
-- Indexes for table `dispatchers`
--
ALTER TABLE `dispatchers`
  ADD PRIMARY KEY (`identifier`) USING BTREE,
  ADD UNIQUE KEY `callsign` (`callsign`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;
  
--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `incident_type`
--
ALTER TABLE `incident_type`
  ADD PRIMARY KEY (`code_id`) USING BTREE,
  ADD UNIQUE KEY `code_name` (`code_name`) USING BTREE;

--
-- Indexes for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ncic_names`
--
ALTER TABLE `ncic_names`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `first_name` (`first_name`,`last_name`) USING BTREE;

--
-- Indexes for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `veh_plate` (`veh_plate`(55)) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  ADD PRIMARY KEY (`id`) USING BTREE;
  
--
-- Indexes for table `ncic_weapons`
--
ALTER TABLE `ncic_weapons`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `serial` (`serial`(55)) USING BTREE,
  ADD KEY `name_id` (`name_id`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`perm_id`) USING BTREE;

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`) USING BTREE;

--
-- Indexes for table `streets`
--
ALTER TABLE `streets`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tones`
--
ALTER TABLE `tones`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `identifier` (`identifier`) USING BTREE;

--
-- Indexes for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD PRIMARY KEY (`user_id`,`department_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `department_id` (`department_id`) USING BTREE;

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `bolos_persons`
--
ALTER TABLE `bolos_persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `bolos_persons`
--
ALTER TABLE `bolos_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `call_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `ncic_citations`
--
ALTER TABLE `ncic_citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `ncic_names`
--
ALTER TABLE `ncic_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `ncic_warrants`
--
ALTER TABLE `ncic_warrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ncic_weapons`
--
ALTER TABLE `ncic_weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `streets`
--
ALTER TABLE `streets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key for each street', AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `civilian_names`
--
ALTER TABLE `civilian_names`
  ADD CONSTRAINT `Name ID` FOREIGN KEY (`names_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_plates`
--
ALTER TABLE `ncic_plates`
  ADD CONSTRAINT `Name Pair` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncic_weapons`
--
ALTER TABLE `ncic_weapons`
  ADD CONSTRAINT `Name Pair Weapon` FOREIGN KEY (`name_id`) REFERENCES `ncic_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- Constraints for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD CONSTRAINT `Department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
